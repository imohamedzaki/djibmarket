<div class="section-box box-quickmenu">
    <div class="container d-flex gap-3">
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
<style>
    .box-quickmenu {
        /* background-color: #f0f3f8; */
        /* background-color: #fff; */
        background-color: #8c9ec51a;
        padding: 10px 0px;
        border-top: 0px solid #d5dfe4;
        border-bottom: 1px solid #d5dfe4;
    }

    .box-quickmenu .box-inner-quickmenu {
        max-width: 100%;
        margin: auto;
    }

    .box-quickmenu .box-inner-quickmenu ul li {
        display: inline-block;
        position: relative;
        padding: 0px 30px 0px 0px;
    }

    .box-quickmenu .box-inner-quickmenu ul li a {
        display: block;
        font-size: 13px;
        line-height: 16px;
        color: #425a8b;
    }

    .box-quickmenu .box-inner-quickmenu ul li a:hover {
        color: #0ba9ed;
    }

    .box-quickmenu .box-inner-quickmenu ul li::before {
        content: "|";
        position: absolute;
        top: 3px;
        right: 15px;
        color: #425a8b;
        height: 20px;
        width: 1px;
    }

    .box-quickmenu .box-inner-quickmenu ul li:last-child::before {
        display: none;
    }
</style>
