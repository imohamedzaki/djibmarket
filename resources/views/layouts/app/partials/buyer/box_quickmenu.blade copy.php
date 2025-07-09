<div class="section-box box-quickmenu">
    <div class="container d-flex gap-3">

        @include('layouts.app.partials.buyer.browse_category')
        <div class="box-inner-quickmenu scrollable-tabs-container">
            <div class="left-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="6"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </div>
            <ul>
                @foreach ($categories->whereNull('parent_id')->get() as $category)
                <li><a href="#">{{ $category->name }}</a></li>
                @endforeach
            </ul>
            <div class="right-arrow active">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="6"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </div>
    </div>
</div>