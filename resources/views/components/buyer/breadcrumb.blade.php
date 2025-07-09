<style>
    /* Modern Buyer Breadcrumb Styles */
    .buyer-breadcrumb-section {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 0;
        margin-bottom: 0.5rem;
    }

    .buyer-breadcrumb {
        display: flex;
        align-items: center;
    }

    .buyer-breadcrumb-list {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0.5rem;
    }

    .buyer-breadcrumb-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .buyer-breadcrumb-link {
        color: #64748b;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease-in-out;
    }

    .buyer-breadcrumb-link:hover {
        color: #3b82f6;
        background-color: #e1f2fe;
        text-decoration: none;
    }

    .buyer-breadcrumb-current {
        color: #1e293b;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.25rem 0.5rem;
    }

    .buyer-breadcrumb-separator {
        width: 1rem;
        height: 1rem;
        color: #94a3b8;
        flex-shrink: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .buyer-breadcrumb-section {
            padding: 0.75rem 0;
        }

        .buyer-breadcrumb-link,
        .buyer-breadcrumb-current {
            font-size: 0.8125rem;
            padding: 0.1875rem 0.375rem;
        }

        .buyer-breadcrumb-separator {
            width: 0.875rem;
            height: 0.875rem;
        }
    }
</style>

@props(['items'])

<div class="buyer-breadcrumb-section">
    <div class="container">
        <nav class="buyer-breadcrumb" aria-label="Breadcrumb">
            <ol class="buyer-breadcrumb-list">
                @foreach ($items as $index => $item)
                    <li class="buyer-breadcrumb-item">
                        @if ($loop->last)
                            <span class="buyer-breadcrumb-current" aria-current="page">{{ $item['text'] }}</span>
                        @else
                            <a href="{{ $item['url'] }}" class="buyer-breadcrumb-link">{{ $item['text'] }}</a>
                            <svg class="buyer-breadcrumb-separator" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9.293 6.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11 9.293 7.707a1 1 0 010-1.414z" />
                            </svg>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
