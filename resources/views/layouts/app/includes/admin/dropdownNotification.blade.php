<li class="dropdown notification-dropdown">
    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
        <div
            class="icon-status icon-status-{{ isset($unreadNotificationsCount) && $unreadNotificationsCount > 0 ? 'danger' : 'info' }}">
            <em class="icon ni ni-bell"></em>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
        <div class="dropdown-head">
            <span class="sub-title nk-dropdown-title">Notifications</span>
            @if (isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                <span class="badge bg-danger">{{ $unreadNotificationsCount }}</span>
            @endif
        </div>
        <div class="dropdown-body">
            <div class="nk-notification">
                {{-- Email Failure Notifications --}}
                @if (isset($emailNotifications) && $emailNotifications->count() > 0)
                    @foreach ($emailNotifications as $notification)
                        <div class="nk-notification-item dropdown-inner email-notification-item">
                            <div class="nk-notification-icon">
                                <em class="icon icon-circle bg-danger-dim ni ni-cross-circle"></em>
                            </div>
                            <div class="nk-notification-content">
                                <div class="nk-notification-text">
                                    Email failed to send to <span
                                        class="text-danger fw-bold">{{ Str::limit($notification->to_email, 20) }}</span>
                                </div>
                                <div class="nk-notification-meta">
                                    <span
                                        class="nk-notification-time">{{ $notification->queued_at->diffForHumans() }}</span>
                                    <span
                                        class="badge bg-light text-dark ms-2">{{ ucwords(str_replace('_', ' ', $notification->email_type)) }}</span>
                                </div>
                                @if ($notification->error_message)
                                    <div class="nk-notification-meta">
                                        <small
                                            class="text-muted">{{ Str::limit($notification->error_message, 50) }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- View All Failed Emails Link --}}
                    <div class="nk-notification-item dropdown-inner border-top pt-3">
                        <div class="nk-notification-content text-center">
                            <a href="{{ route('admin.emails.dashboard', ['status' => 'failed']) }}"
                                class="btn btn-sm btn-outline-danger">
                                <em class="icon ni ni-eye"></em>
                                View All Failed Emails
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Default notifications when no email failures --}}
                    <div class="nk-notification-item dropdown-inner">
                        <div class="nk-notification-icon">
                            <em class="icon icon-circle bg-success-dim ni ni-check-circle"></em>
                        </div>
                        <div class="nk-notification-content">
                            <div class="nk-notification-text">All emails are sending successfully</div>
                            <div class="nk-notification-time">System status normal</div>
                        </div>
                    </div>

                    {{-- Sample placeholder notifications --}}
                    <div class="nk-notification-item dropdown-inner">
                        <div class="nk-notification-icon">
                            <em class="icon icon-circle bg-info-dim ni ni-info"></em>
                        </div>
                        <div class="nk-notification-content">
                            <div class="nk-notification-text">Welcome to DjibMarket Admin Panel</div>
                            <div class="nk-notification-time">{{ now()->format('M d, Y') }}</div>
                        </div>
                    </div>
                @endif
            </div><!-- .nk-notification -->
        </div><!-- .nk-dropdown-body -->
        <div class="dropdown-foot center">
            <a href="{{ route('admin.emails.dashboard') }}">View Email Dashboard</a>
        </div>
    </div>
</li>

<style>
    .email-notification-item {
        border-left: 3px solid #e85347;
        background-color: #fdf2f2;
    }

    .email-notification-item:hover {
        background-color: #fcebeb;
    }

    .notification-dropdown .badge {
        font-size: 10px;
        min-width: 16px;
        height: 16px;
        padding: 2px 4px;
        border-radius: 8px;
    }

    .nk-notification-meta .badge {
        font-size: 9px;
        padding: 2px 6px;
    }

    .icon-status-danger .icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }
</style>
