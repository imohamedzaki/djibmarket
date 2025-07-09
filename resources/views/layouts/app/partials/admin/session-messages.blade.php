{{-- Success Messages --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="alert-text">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Error Messages --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-text">{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-text">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Warning Messages --}}
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <div class="alert-text">{{ session('warning') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Info Messages --}}
@if (session('info'))
    <div class="alert alert-info alert-dismissible" role="alert">
        <div class="alert-text">{{ session('info') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
