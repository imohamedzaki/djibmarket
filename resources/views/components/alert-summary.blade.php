@props([
    'type' => 'danger', // Default type (e.g., success, danger, warning, info)
    'heading' => null, // Optional heading for the alert
    'messages' => [], // Array or Collection of messages
])

@php
    // Map type string to Bootstrap alert class
    $alertClassMap = [
        'success' => 'alert-success',
        'danger' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
        'error' => 'alert-danger', // Alias for danger
    ];
    // Get the class based on type, default to danger if type is unknown
    $alertClass = $alertClassMap[strtolower($type)] ?? 'alert-danger';

    // Ensure messages is a collection for easier handling
    $messageList = collect($messages);
@endphp

{{-- Only render if there are messages to display --}}
@if ($messageList->isNotEmpty())
    <div
        {{ $attributes->merge(['class' => "alert {$alertClass} alert-dismissible fade show mb-4", 'role' => 'alert']) }}>
        {{-- Display heading if provided --}}
        @if ($heading)
            <h6 class="alert-heading">{{ $heading }}</h6>
        @endif

        {{-- Display messages: Use a list for multiple, direct paragraph for single --}}
        @if ($messageList->count() > 1)
            <ul class="list-unstyled mb-0">
                @foreach ($messageList as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            </ul>
        @else
            <p class="mb-0">{!! $messageList->first() !!}</p>
        @endif

        {{-- Close button --}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
