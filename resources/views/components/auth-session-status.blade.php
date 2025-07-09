@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success fw-bold']) }} style="color: #0c5a45;">
        {{ $status }}
    </div>
@endif
