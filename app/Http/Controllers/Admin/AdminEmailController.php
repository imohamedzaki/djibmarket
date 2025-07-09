<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use App\Services\EmailTrackingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminEmailController extends Controller
{
    /**
     * Display email dashboard
     */
    public function dashboard(Request $request)
    {
        // Get filter parameters
        $filters = [
            'type' => $request->get('type'),
            'status' => $request->get('status'),
            'email' => $request->get('email'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        // Remove null filters
        $filters = array_filter($filters);

        // Get recent emails with filters
        $emails = EmailTrackingService::getRecentEmails(50, $filters);

        // Get statistics for different periods
        $stats = [
            'today' => EmailTrackingService::getStatistics(1),
            'week' => EmailTrackingService::getStatistics(7),
            'month' => EmailTrackingService::getStatistics(30),
        ];

        // Get email types for filter dropdown
        $emailTypes = EmailLog::distinct('email_type')->pluck('email_type');

        // Get failed emails count for alerts
        $failedToday = EmailLog::where('status', 'failed')
            ->whereDate('created_at', today())
            ->count();

        $queuedCount = EmailLog::where('status', 'queued')->count();

        return view('admin.emails.dashboard', compact(
            'emails',
            'stats',
            'emailTypes',
            'filters',
            'failedToday',
            'queuedCount'
        ));
    }

    /**
     * Get email statistics as JSON for AJAX
     */
    public function getStats(Request $request)
    {
        $days = $request->get('days', 30);
        $stats = EmailTrackingService::getStatistics($days);

        return response()->json($stats);
    }

    /**
     * Get email details
     */
    public function show(EmailLog $emailLog)
    {
        $emailLog->load([]);

        return view('admin.emails.show', compact('emailLog'));
    }

    /**
     * Get real-time data for dashboard refresh
     */
    public function realTimeData()
    {
        $data = [
            'queued_count' => EmailLog::where('status', 'queued')->count(),
            'failed_today' => EmailLog::where('status', 'failed')
                ->whereDate('created_at', today())
                ->count(),
            'sent_today' => EmailLog::where('status', 'sent')
                ->whereDate('sent_at', today())
                ->count(),
            'total_today' => EmailLog::whereDate('created_at', today())->count(),
            'recent_failures' => EmailLog::where('status', 'failed')
                ->where('created_at', '>=', now()->subHours(1))
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(['id', 'to_email', 'email_type', 'error_message', 'created_at'])
        ];

        return response()->json($data);
    }

    /**
     * Retry failed email
     */
    public function retry(EmailLog $emailLog)
    {
        if ($emailLog->status !== 'failed') {
            return back()->with('error', 'Only failed emails can be retried.');
        }

        // Reset status to queued
        $emailLog->update([
            'status' => 'queued',
            'failed_at' => null,
            'error_message' => null
        ]);

        // Re-dispatch the job if possible
        // Note: This would require recreating the mailable, which is complex
        // For now, just mark as queued for manual handling

        return back()->with('success', 'Email marked for retry. Please manually re-send if needed.');
    }

    /**
     * Bulk actions for emails
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,retry,mark_sent',
            'email_ids' => 'required|array',
            'email_ids.*' => 'exists:email_logs,id'
        ]);

        $emailIds = $request->email_ids;
        $action = $request->action;

        switch ($action) {
            case 'delete':
                EmailLog::whereIn('id', $emailIds)->delete();
                $message = 'Selected emails deleted successfully.';
                break;

            case 'retry':
                EmailLog::whereIn('id', $emailIds)
                    ->where('status', 'failed')
                    ->update([
                        'status' => 'queued',
                        'failed_at' => null,
                        'error_message' => null
                    ]);
                $message = 'Selected failed emails marked for retry.';
                break;

            case 'mark_sent':
                EmailLog::whereIn('id', $emailIds)
                    ->where('status', 'queued')
                    ->update([
                        'status' => 'sent',
                        'sent_at' => now()
                    ]);
                $message = 'Selected emails marked as sent.';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Export email logs
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');

        $emails = EmailLog::when($request->date_from, function ($query, $date) {
            return $query->where('created_at', '>=', $date);
        })
            ->when($request->date_to, function ($query, $date) {
                return $query->where('created_at', '<=', $date);
            })
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->type, function ($query, $type) {
                return $query->where('email_type', $type);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if ($format === 'csv') {
            return $this->exportCsv($emails);
        }

        // Could add JSON, Excel exports here
        return back()->with('error', 'Unsupported export format.');
    }

    /**
     * Export as CSV
     */
    private function exportCsv($emails)
    {
        $filename = 'email_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($emails) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'ID',
                'To Email',
                'Subject',
                'Type',
                'Status',
                'Queued At',
                'Sent At',
                'Failed At',
                'Processing Time (seconds)',
                'Error Message'
            ]);

            // CSV Data
            foreach ($emails as $email) {
                fputcsv($file, [
                    $email->id,
                    $email->to_email,
                    $email->subject,
                    $email->email_type,
                    $email->status,
                    $email->queued_at?->format('Y-m-d H:i:s'),
                    $email->sent_at?->format('Y-m-d H:i:s'),
                    $email->failed_at?->format('Y-m-d H:i:s'),
                    $email->processing_time,
                    $email->error_message
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Clear old email logs
     */
    public function clearOld(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:365'
        ]);

        $days = $request->days;
        $cutoffDate = now()->subDays($days);

        $deletedCount = EmailLog::where('created_at', '<', $cutoffDate)->delete();

        return back()->with('success', "Deleted {$deletedCount} email logs older than {$days} days.");
    }
}
