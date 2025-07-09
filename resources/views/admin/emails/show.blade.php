@extends('layouts.app.admin')

@section('title', 'Email Details #' . $emailLog->id)

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <!-- Header -->
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">
                                    Email Details
                                    <span
                                        class="badge {{ $emailLog->status === 'sent' ? 'bg-success' : ($emailLog->status === 'failed' ? 'bg-danger' : 'bg-warning') }} ms-2">
                                        {{ ucfirst($emailLog->status) }}
                                    </span>
                                </h3>
                                <div class="nk-block-des text-soft">
                                    <p>Email Log ID: <strong>#{{ $emailLog->id }}</strong></p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('admin.emails.dashboard') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Back to List</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Email Information Cards -->
                    <div class="row g-gs">
                        <!-- Basic Information -->
                        <div class="col-lg-8">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Email Information</h6>
                                        </div>
                                        <div class="card-tools">
                                            @if ($emailLog->status === 'failed')
                                                <a href="{{ route('admin.emails.retry', $emailLog) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <em class="icon ni ni-reload"></em>
                                                    <span>Retry Email</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">To Email</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-static">
                                                        <strong>{{ $emailLog->to_email }}</strong>
                                                        @if ($emailLog->to_name)
                                                            <br><span class="text-muted">{{ $emailLog->to_name }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Type</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-static">
                                                        <span class="badge bg-light text-dark">
                                                            {{ ucwords(str_replace('_', ' ', $emailLog->email_type)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Subject</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-static">
                                                        <strong>{{ $emailLog->subject }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timing Information -->
                            <div class="card card-bordered mt-4">
                                <div class="card-inner">
                                    <div class="card-title">
                                        <h6 class="title">Timing Information</h6>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Queued At</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-static">
                                                        <strong>{{ $emailLog->queued_at->format('M d, Y') }}</strong><br>
                                                        <span
                                                            class="text-muted">{{ $emailLog->queued_at->format('H:i:s') }}</span><br>
                                                        <small
                                                            class="text-info">{{ $emailLog->queued_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Sent At</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-static">
                                                        @if ($emailLog->sent_at)
                                                            <strong>{{ $emailLog->sent_at->format('M d, Y') }}</strong><br>
                                                            <span
                                                                class="text-muted">{{ $emailLog->sent_at->format('H:i:s') }}</span><br>
                                                            <small
                                                                class="text-success">{{ $emailLog->sent_at->diffForHumans() }}</small>
                                                        @else
                                                            <span class="text-muted">Not sent yet</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Processing Time</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-static">
                                                        @if ($emailLog->processing_time_human)
                                                            <strong
                                                                class="text-info">{{ $emailLog->processing_time_human }}</strong><br>
                                                            <small class="text-muted">{{ $emailLog->processing_time }}
                                                                seconds</small>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Information (if failed) -->
                            @if ($emailLog->status === 'failed' && $emailLog->error_message)
                                <div class="card card-bordered mt-4 border-danger">
                                    <div class="card-inner">
                                        <div class="card-title">
                                            <h6 class="title text-danger">
                                                <em class="icon ni ni-alert-circle"></em>
                                                Error Information
                                            </h6>
                                        </div>

                                        <div class="alert alert-danger">
                                            <h6>Failed At:</h6>
                                            <p class="mb-2">
                                                <strong>{{ $emailLog->failed_at->format('M d, Y H:i:s') }}</strong>
                                                <small
                                                    class="text-muted">({{ $emailLog->failed_at->diffForHumans() }})</small>
                                            </p>

                                            <h6>Error Message:</h6>
                                            <div class="code-block">
                                                <pre class="code-pre"><code>{{ $emailLog->error_message }}</code></pre>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <a href="{{ route('admin.emails.retry', $emailLog) }}" class="btn btn-danger">
                                                <em class="icon ni ni-reload"></em>
                                                <span>Retry This Email</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Metadata Information -->
                            @if ($emailLog->metadata && count($emailLog->metadata) > 0)
                                <div class="card card-bordered mt-4">
                                    <div class="card-inner">
                                        <div class="card-title">
                                            <h6 class="title">Additional Information</h6>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Key</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($emailLog->metadata as $key => $value)
                                                        <tr>
                                                            <td><strong>{{ ucwords(str_replace('_', ' ', $key)) }}</strong>
                                                            </td>
                                                            <td>
                                                                @if (is_array($value) || is_object($value))
                                                                    <code>{{ json_encode($value, JSON_PRETTY_PRINT) }}</code>
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Status Timeline -->
                        <div class="col-lg-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-title">
                                        <h6 class="title">Email Status Timeline</h6>
                                    </div>

                                    <div class="timeline">
                                        <!-- Queued -->
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-primary"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title">Email Queued</h6>
                                                <p class="timeline-text">
                                                    Email was added to the sending queue
                                                </p>
                                                <p class="timeline-time">
                                                    <em class="icon ni ni-clock"></em>
                                                    {{ $emailLog->queued_at->format('M d, Y H:i:s') }}
                                                </p>
                                            </div>
                                        </div>

                                        @if ($emailLog->sent_at)
                                            <!-- Sent -->
                                            <div class="timeline-item">
                                                <div class="timeline-marker bg-success"></div>
                                                <div class="timeline-content">
                                                    <h6 class="timeline-title">Email Sent Successfully</h6>
                                                    <p class="timeline-text">
                                                        Email was delivered to the mail server
                                                    </p>
                                                    <p class="timeline-time">
                                                        <em class="icon ni ni-check-circle"></em>
                                                        {{ $emailLog->sent_at->format('M d, Y H:i:s') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @elseif($emailLog->failed_at)
                                            <!-- Failed -->
                                            <div class="timeline-item">
                                                <div class="timeline-marker bg-danger"></div>
                                                <div class="timeline-content">
                                                    <h6 class="timeline-title">Email Failed</h6>
                                                    <p class="timeline-text">
                                                        Email delivery failed
                                                    </p>
                                                    <p class="timeline-time">
                                                        <em class="icon ni ni-cross-circle"></em>
                                                        {{ $emailLog->failed_at->format('M d, Y H:i:s') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Processing -->
                                            <div class="timeline-item">
                                                <div class="timeline-marker bg-warning"></div>
                                                <div class="timeline-content">
                                                    <h6 class="timeline-title">Processing</h6>
                                                    <p class="timeline-text">
                                                        Email is being processed by the queue worker
                                                    </p>
                                                    <p class="timeline-time">
                                                        <em class="icon ni ni-loader"></em>
                                                        In progress...
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="card card-bordered mt-4">
                                <div class="card-inner">
                                    <div class="card-title">
                                        <h6 class="title">Quick Actions</h6>
                                    </div>

                                    <div class="d-grid gap-2">
                                        @if ($emailLog->status === 'failed')
                                            <a href="{{ route('admin.emails.retry', $emailLog) }}"
                                                class="btn btn-primary">
                                                <em class="icon ni ni-reload"></em>
                                                <span>Retry Email</span>
                                            </a>
                                        @endif

                                        @if ($emailLog->status === 'queued')
                                            <form method="POST" action="{{ route('admin.emails.bulk-action') }}"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="action" value="mark_sent">
                                                <input type="hidden" name="email_ids[]" value="{{ $emailLog->id }}">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <em class="icon ni ni-check"></em>
                                                    <span>Mark as Sent</span>
                                                </button>
                                            </form>
                                        @endif

                                        <button class="btn btn-outline-primary" onclick="window.print()">
                                            <em class="icon ni ni-printer"></em>
                                            <span>Print Details</span>
                                        </button>

                                        <a href="{{ route('admin.emails.dashboard', ['email' => $emailLog->to_email]) }}"
                                            class="btn btn-outline-info">
                                            <em class="icon ni ni-search"></em>
                                            <span>View All Emails to This Address</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Related Statistics -->
                            <div class="card card-bordered mt-4">
                                <div class="card-inner">
                                    <div class="card-title">
                                        <h6 class="title">Related Statistics</h6>
                                    </div>

                                    @php
                                        $relatedStats = [
                                            'total_to_email' => \App\Models\EmailLog::where(
                                                'to_email',
                                                $emailLog->to_email,
                                            )->count(),
                                            'sent_to_email' => \App\Models\EmailLog::where(
                                                'to_email',
                                                $emailLog->to_email,
                                            )
                                                ->where('status', 'sent')
                                                ->count(),
                                            'failed_to_email' => \App\Models\EmailLog::where(
                                                'to_email',
                                                $emailLog->to_email,
                                            )
                                                ->where('status', 'failed')
                                                ->count(),
                                            'total_type' => \App\Models\EmailLog::where(
                                                'email_type',
                                                $emailLog->email_type,
                                            )->count(),
                                            'today_type' => \App\Models\EmailLog::where(
                                                'email_type',
                                                $emailLog->email_type,
                                            )
                                                ->whereDate('created_at', today())
                                                ->count(),
                                        ];
                                    @endphp

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total emails to this address</span>
                                            <strong>{{ $relatedStats['total_to_email'] }}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Sent to this address</span>
                                            <strong class="text-success">{{ $relatedStats['sent_to_email'] }}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Failed to this address</span>
                                            <strong class="text-danger">{{ $relatedStats['failed_to_email'] }}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total {{ ucwords(str_replace('_', ' ', $emailLog->email_type)) }}
                                                emails</span>
                                            <strong>{{ $relatedStats['total_type'] }}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>{{ ucwords(str_replace('_', ' ', $emailLog->email_type)) }} today</span>
                                            <strong>{{ $relatedStats['today_type'] }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Timeline Styles */
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e3e7fe;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-marker {
            position: absolute;
            left: -1rem;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #e3e7fe;
        }

        .timeline-content {
            margin-left: 1rem;
        }

        .timeline-title {
            margin: 0 0 0.25rem 0;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .timeline-text {
            margin: 0 0 0.25rem 0;
            font-size: 0.8rem;
            color: #8094ae;
        }

        .timeline-time {
            margin: 0;
            font-size: 0.75rem;
            color: #8094ae;
        }

        .timeline-time em {
            margin-right: 0.25rem;
        }

        /* Code block styling */
        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 0.375rem;
            padding: 1rem;
            margin: 0.5rem 0;
        }

        .code-pre {
            margin: 0;
            background: none;
            border: none;
            padding: 0;
            font-size: 0.875rem;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /* Print styles */
        @media print {

            .nk-block-head-content .btn,
            .card-tools,
            .btn {
                display: none !important;
            }

            .timeline-marker {
                box-shadow: none;
                border: 2px solid #000;
            }
        }
    </style>
@endsection
