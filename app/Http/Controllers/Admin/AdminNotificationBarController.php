<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationBar;
use App\Models\NotificationBarColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminNotificationBarController extends Controller
{
    /**
     * Display a listing of the notification bars.
     */
    public function index(Request $request)
    {
        $query = NotificationBar::with(['columns' => function ($q) {
            $q->where('is_active', true)->orderBy('column_order');
        }]);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhereHas('columns', function ($subQ) use ($searchTerm) {
                        $subQ->where('text_content', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'active':
                    $query->currentlyVisible();
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
                case 'scheduled':
                    $today = Carbon::today();
                    $query->where('is_active', true)
                        ->where('start_date', '>', $today);
                    break;
                case 'expired':
                    $today = Carbon::today();
                    $query->where('is_active', true)
                        ->where('end_date', '<', $today);
                    break;
            }
        }

        $perPage = $request->get('per_page', 10);
        $notificationBars = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('admin.notification-bars.index', compact('notificationBars'));
    }

    /**
     * Store a newly created notification bar.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'column_count' => 'required|integer|min:1|max:4',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'css_class' => 'nullable|string|max:255',
            'columns' => 'required|array|min:1',
            'columns.*.text_content' => 'required|string|max:500',
            'columns.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'columns.*.link_url' => 'nullable|url|max:255',
            'columns.*.link_target' => 'nullable|string|in:_self,_blank,_parent,_top',
            'columns.*.is_active' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            $notificationBar = NotificationBar::create([
                'name' => $request->name,
                'column_count' => $request->column_count,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->boolean('is_active', true),
                'css_class' => $request->css_class,
            ]);

            // Create columns
            foreach ($request->columns as $index => $columnData) {
                $imagePath = null;
                if (isset($columnData['image']) && $columnData['image']) {
                    $imagePath = $columnData['image']->store('notification-bars', 'public');
                }

                $notificationBar->columns()->create([
                    'column_order' => $index + 1,
                    'text_content' => $columnData['text_content'],
                    'image_path' => $imagePath,
                    'link_url' => $columnData['link_url'] ?? null,
                    'link_target' => $columnData['link_target'] ?? '_self',
                    'is_active' => isset($columnData['is_active']) ? (bool)$columnData['is_active'] : true,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.notification-bars.index')
                ->with('success', 'Notification bar created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to create notification bar: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified notification bar.
     */
    public function show(NotificationBar $notificationBar)
    {
        $notificationBar->load(['columns' => function ($q) {
            $q->orderBy('column_order');
        }]);

        return view('admin.notification-bars.show', compact('notificationBar'));
    }

    /**
     * Get notification bar data for editing (AJAX).
     */
    public function getEditData(NotificationBar $notificationBar)
    {
        $notificationBar->load(['columns' => function ($q) {
            $q->orderBy('column_order');
        }]);

        return response()->json([
            'success' => true,
            'notificationBar' => [
                'id' => $notificationBar->id,
                'name' => $notificationBar->name,
                'column_count' => $notificationBar->column_count,
                'start_date' => $notificationBar->start_date->format('Y-m-d'),
                'end_date' => $notificationBar->end_date->format('Y-m-d'),
                'is_active' => $notificationBar->is_active,
                'css_class' => $notificationBar->css_class,
                'columns' => $notificationBar->columns->map(function ($column) {
                    return [
                        'id' => $column->id,
                        'column_order' => $column->column_order,
                        'text_content' => $column->text_content,
                        'image_path' => $column->image_path,
                        'image_url' => $column->image_url,
                        'link_url' => $column->link_url,
                        'link_target' => $column->link_target,
                        'is_active' => $column->is_active,
                    ];
                })
            ]
        ]);
    }

    /**
     * Update the specified notification bar.
     */
    public function update(Request $request, NotificationBar $notificationBar)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'column_count' => 'required|integer|min:1|max:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'css_class' => 'nullable|string|max:255',
            'columns' => 'required|array|min:1',
            'columns.*.text_content' => 'required|string|max:500',
            'columns.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'columns.*.link_url' => 'nullable|url|max:255',
            'columns.*.link_target' => 'nullable|string|in:_self,_blank,_parent,_top',
            'columns.*.is_active' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            $notificationBar->update([
                'name' => $request->name,
                'column_count' => $request->column_count,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->boolean('is_active', true),
                'css_class' => $request->css_class,
            ]);

            // Delete existing columns and their images
            foreach ($notificationBar->columns as $column) {
                if ($column->image_path) {
                    Storage::disk('public')->delete($column->image_path);
                }
            }
            $notificationBar->columns()->delete();

            // Create new columns
            foreach ($request->columns as $index => $columnData) {
                $imagePath = null;
                if (isset($columnData['image']) && $columnData['image']) {
                    $imagePath = $columnData['image']->store('notification-bars', 'public');
                }

                $notificationBar->columns()->create([
                    'column_order' => $index + 1,
                    'text_content' => $columnData['text_content'],
                    'image_path' => $imagePath,
                    'link_url' => $columnData['link_url'] ?? null,
                    'link_target' => $columnData['link_target'] ?? '_self',
                    'is_active' => isset($columnData['is_active']) ? (bool)$columnData['is_active'] : true,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.notification-bars.index')
                ->with('success', 'Notification bar updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update notification bar: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified notification bar.
     */
    public function destroy(NotificationBar $notificationBar)
    {
        try {
            DB::beginTransaction();

            // Delete images
            foreach ($notificationBar->columns as $column) {
                if ($column->image_path) {
                    Storage::disk('public')->delete($column->image_path);
                }
            }

            // Delete the notification bar (columns will be deleted via cascade)
            $notificationBar->delete();

            DB::commit();

            return redirect()->route('admin.notification-bars.index')
                ->with('success', 'Notification bar deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to delete notification bar: ' . $e->getMessage());
        }
    }

    /**
     * Toggle notification bar status.
     */
    public function updateStatus(Request $request, NotificationBar $notificationBar)
    {
        $request->validate([
            'is_active' => 'required|in:0,1,true,false'
        ]);

        $notificationBar->update([
            'is_active' => $request->boolean('is_active')
        ]);

        $status = $request->boolean('is_active') ? 'activated' : 'deactivated';

        return response()->json([
            'success' => true,
            'message' => "Notification bar {$status} successfully.",
            'status' => $notificationBar->status
        ]);
    }
}