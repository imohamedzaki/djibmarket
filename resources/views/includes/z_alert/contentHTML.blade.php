@if (session()->has('status'))
    @if (session()->get('type') == 'success')
        <div class="z_alert_wrapper z_alert_wrapper_success" data-trigger="trigger">
            <div class="z_alert_icon">
                <i class="ti ti-checkbox"></i>
            </div>
            <div class="z_alert_content">
                <h2>{{ ucfirst(session()->get('type')) }}</h2>
                <span>{{ session()->get('status') }}</span>
            </div>
        </div>
    @else
        <div class="z_alert_wrapper z_alert_wrapper_danger" data-trigger="trigger">
            <div class="z_alert_icon">
                <i class="ti ti-exclamation-circle"></i>
            </div>
            <div class="z_alert_content">
                <h2>{{ ucfirst(session()->get('type')) }}</h2>
                <span>{{ session()->get('status') }}</span>
            </div>
        </div>
    @endif
@endif
