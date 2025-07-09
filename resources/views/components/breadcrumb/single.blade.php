@props(['title', 'type' => 'normal', 'link' => '#'])
@if ($type == 'normal')
    <li class="breadcrumb-item active">{{ $title }}</li>
@else
    <li class="breadcrumb-item"><a href="{{ $link }}">{{ $title }}</a></li>
@endif
