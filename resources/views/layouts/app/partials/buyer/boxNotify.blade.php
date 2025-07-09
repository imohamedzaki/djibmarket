@php
    // Get the currently visible notification bar
    $notificationBar = \App\Models\NotificationBar::currentlyVisible()
        ->with([
            'activeColumns' => function ($query) {
                $query->orderBy('column_order');
            },
        ])
        ->first();
@endphp

@if ($notificationBar && $notificationBar->activeColumns->count() > 0)
    <div class="box-notify{{ $notificationBar->css_class ? ' ' . $notificationBar->css_class : '' }}">
        <div class="container position-relative">
            <div class="row">
                @foreach ($notificationBar->activeColumns->take($notificationBar->column_count) as $column)
                    @php
                        $colClass = 'col-lg-' . 12 / $notificationBar->column_count;
                    @endphp
                    <div class="{{ $colClass }}">
                        @if ($column->hasLink())
                            <a href="{{ $column->link_url }}" target="{{ $column->link_target }}" class="notify-link">
                        @endif

                        @if ($column->hasImage())
                            <img src="{{ $column->image_url }}" alt="Notification" class="notify-image me-2"
                                style="height: 20px; width: auto;">
                        @endif

                        <span class="notify-text color-white">{{ $column->text_content }}</span>

                        @if ($column->hasLink())
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
            <a class="btn btn-close"></a>
        </div>
    </div>
@endif
