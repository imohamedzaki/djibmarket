@props(['items' => []])

@if (!empty($items))
    <nav>
        <ul class="breadcrumb">
            @foreach ($items as $item)
                @if (!$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $item['url'] ?? '#' }}">{{ $item['text'] }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $item['text'] }}</li>
                @endif
            @endforeach
        </ul>
    </nav>
@endif
