@extends('layouts.app.admin')
@section('title', 'Dashboard')
@section('content')
    {{-- breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Home" type="first" link="{{ route('admin.dashboard') }}" />
        <x-breadcrumb.single title="Dashboard" />
    </x-breadcrumb.wrapper>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to Learning Management Dashboard.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                        data-bs-toggle="dropdown">
                                        <em class="d-none d-sm-inline icon ni ni-calender-date"></em>
                                        <span><span class="d-none d-md-inline">Last</span>
                                            30 Days</span>
                                        <em class="dd-indc icon ni ni-chevron-right"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 30
                                                        Days</span></a></li>
                                            <li><a href="#"><span>Last 6
                                                        Months</span></a></li>
                                            <li><a href="#"><span>Last 1
                                                        Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em
                                        class="icon ni ni-reports"></em><span>Reports</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-6">
                <div class="row g-gs">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Students Enrolement</h6>
                                        <p>In last 30 days enrolement of students</p>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Students Enrolement"></em>
                                    </div>
                                </div>
                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                        <div class="nk-sale-data">
                                            <span class="amount">5490 <span class="change down text-danger"><em
                                                        class="icon ni ni-arrow-long-down"></em>16.93%</span></span>
                                            <span class="sub-title">This Month</span>
                                        </div>
                                        <div class="nk-sale-data">
                                            <span class="amount">1480<span class="change up text-success"><em
                                                        class="icon ni ni-arrow-long-up"></em>4.26%</span></span>
                                            <span class="sub-title">This Week</span>
                                        </div>
                                    </div>
                                    <div class="nk-sales-ck sales-revenue">
                                        <canvas class="student-enrole" id="enrolement"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Sales</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount fw-normal">$9,495.20</div>
                                            <div class="info text-end">
                                                <span class="change up text-danger"><em
                                                        class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs.
                                                    last month</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="courseSells" id="totalSells"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">This week so far</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount fw-normal">$2,995.81</div>
                                            <div class="info text-end"><span class="change up text-danger"><em
                                                        class="icon ni ni-arrow-long-up"></em>7.13%</span><br><span>vs.
                                                    last week</span></div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="courseSells" id="weeklySells"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .col -->
            <div class="col-lg-6">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-4">
                            <div class="card-title">
                                <h6 class="title mb-1">Top Categories</h6>
                                <p>In last 15 days buy and sells overview.</p>
                            </div>
                            <div class="card-tools">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                        data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#" class="active"><span>15
                                                        Days</span></a></li>
                                            <li><a href="#"><span>30 Days</span></a>
                                            </li>
                                            <li><a href="#"><span>3 Months</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-title-group -->
                        <div class="d-flex">
                            <div class="h-250px mt-n2 flex-grow-1">
                                <canvas class="course-progress-chart" id="courseProgress"></canvas>
                            </div>
                            <ul class="flex-shrink-0 gy-2">
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#f98c45"></span>
                                    <span> Web Development</span>
                                </li>
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#9cabff"></span>
                                    <span> Mobile Application</span>
                                </li>
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#8feac5"></span>
                                    <span> Graphics Design</span>
                                </li>
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#6b79c8"></span>
                                    <span> Database</span>
                                </li>
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#79f1dc"></span>
                                    <span> Marketing</span>
                                </li>
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#FF65B6"></span>
                                    <span> Machine Learning</span>
                                </li>
                                <li class="align-center">
                                    <span class="dot dot-lg sq me-1" data-bg="#6A29FF"></span>
                                    <span> Data Science</span>
                                </li>
                            </ul>
                        </div><!-- .nk-coin-ovwg -->
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Top Courses</h6>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                        data-bs-toggle="dropdown">Weekly</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Daily</span></a>
                                            </li>
                                            <li><a href="#" class="active"><span>Weekly</span></a>
                                            </li>
                                            <li><a href="#"><span>Monthly</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nk-top-products">
                            <li class="item">
                                <div class="user-avatar sq bg-success-dim me-3">
                                    <span>UI/X</span>
                                </div>
                                <div class="info">
                                    <div class="title">UI/UX Design with Adobe XD</div>
                                    <div class="price">$85.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$2,125.00</div>
                                    <div class="count">25 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="user-avatar sq bg-warning-dim me-3">
                                    <span>AD</span>
                                </div>
                                <div class="info">
                                    <div class="title">Android App Development</div>
                                    <div class="price">$95.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$1,710.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="user-avatar sq bg-danger-dim me-3">
                                    <span>WD</span>
                                </div>
                                <div class="info">
                                    <div class="title">Wordpress Development</div>
                                    <div class="price">$70.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$1050.00</div>
                                    <div class="count">15 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="user-avatar sq bg-primary-dim me-3">
                                    <span>ML</span>
                                </div>
                                <div class="info">
                                    <div class="title">Machine Learning</div>
                                    <div class="price">$110.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$990.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="user-avatar sq bg-info-dim me-3">
                                    <span>RD</span>
                                </div>
                                <div class="info">
                                    <div class="title">Responsive Design</div>
                                    <div class="price">$80.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$960.00</div>
                                    <div class="count">12 Sold</div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card card-full">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Top Instructors</h6>
                                </div>
                                <div class="card-tools">
                                    <a href="html/lms/instructor-list.html" class="link">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner card-inner-md">
                            <div class="review-item d-flex justify-content-between">
                                <div class="user-card">
                                    <div class="user-avatar bg-primary-dim">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">Abu Bin Ishtiyak</span>
                                        <span class="sub-text">info@softnio.com</span>
                                    </div>
                                </div>
                                <div class="review-status">
                                    <ul class="review-stars d-flex">
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                    </ul>
                                    <div class="review-count">25 Reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner card-inner-md">
                            <div class="review-item d-flex justify-content-between">
                                <div class="user-card">
                                    <div class="user-avatar bg-info-dim">
                                        <span>AL</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">Ashley Lawson</span>
                                        <span class="sub-text">ashley@softnio.com</span>
                                    </div>
                                </div>
                                <div class="review-status">
                                    <ul class="review-stars d-flex">
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-half-fill text-warning"></em>
                                        </li>
                                    </ul>
                                    <div class="review-count">22 Reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner card-inner-md">
                            <div class="review-item d-flex justify-content-between">
                                <div class="user-card">
                                    <div class="user-avatar bg-warning-dim">
                                        <span>JM</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">Jane Montgomery</span>
                                        <span class="sub-text">jane84@example.com</span>
                                    </div>
                                </div>
                                <div class="review-status">
                                    <ul class="review-stars d-flex">
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-half-fill text-warning"></em>
                                        </li>
                                    </ul>
                                    <div class="review-count">19 Reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner card-inner-md">
                            <div class="review-item d-flex justify-content-between">
                                <div class="user-card">
                                    <div class="user-avatar bg-pink-dim">
                                        <span>LH</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">Larry Henry</span>
                                        <span class="sub-text">larry108@example.com</span>
                                    </div>
                                </div>
                                <div class="review-status">
                                    <ul class="review-stars d-flex">
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star-fill text-warning"></em>
                                        </li>
                                        <li><em class="icon ni ni-star text-warning"></em>
                                        </li>
                                    </ul>
                                    <div class="review-count">24 Reviews</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Support Requests</h6>
                            </div>
                            <div class="card-tools">
                                <a href="#" class="link">All Requests</a>
                            </div>
                        </div>
                    </div>
                    <ul class="nk-support">
                        <li class="nk-support-item">
                            <div class="user-avatar">
                                <img src="./images/avatar/a-sm.jpg" alt="">
                            </div>
                            <div class="nk-support-content">
                                <div class="title">
                                    <span>Vincent Lopez</span>
                                    <div class="status delivered">
                                        <em class="icon ni ni-check-circle-fill"></em>
                                    </div>
                                </div>
                                <p>Thanks for contact us with your issues...</p>
                                <span class="time">6 min ago</span>
                            </div>
                        </li>
                        <li class="nk-support-item">
                            <div class="user-avatar bg-purple-dim">
                                <span>DM</span>
                            </div>
                            <div class="nk-support-content ">
                                <div class="title">
                                    <span>Daniel Moore</span>
                                    <div class="status unread">
                                        <em class="icon ni ni-bullet-fill"></em>
                                    </div>
                                </div>
                                <p>Thanks for contact us with your issues...</p>
                                <span class="time">2 Hours ago</span>
                            </div>
                        </li>
                        <li class="nk-support-item">
                            <div class="user-avatar">
                                <img src="./images/avatar/b-sm.jpg" alt="">
                            </div>
                            <div class="nk-support-content">
                                <div class="title">
                                    <span>Larry Henry</span>
                                    <div class="status sent">
                                        <em class="icon ni ni-check-circle"></em>
                                    </div>
                                </div>
                                <p>Thanks for contact us with your issues...</p>
                                <span class="time">3 Hours ago</span>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-8">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Active Students</h6>
                                <p>How do your students visited in the time.</p>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Users of this month"></em>
                            </div>
                        </div>
                        <div class="analytic-au">
                            <div class="analytic-data-group analytic-au-group g-3">
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Monthly</div>
                                    <div class="amount">9.28K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.63%
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Weekly</div>
                                    <div class="amount">2.69K</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>1.92%
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Daily (Avg)</div>
                                    <div class="amount">0.94K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>3.45%
                                    </div>
                                </div>
                            </div>
                            <div class="analytic-au-ck">
                                <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                            </div>
                            <div class="chart-label-group">
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label">30 Jan, 2020</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card card-full overflow-hidden">
                    <div class="nk-ecwg nk-ecwg4 h-100">
                        <div class="card-inner flex-grow-1">
                            <div class="card-title-group mb-4">
                                <div class="card-title">
                                    <h6 class="title">Traffic Sources</h6>
                                </div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <a href="#"
                                            class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                            data-bs-toggle="dropdown">30 Days</a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>15
                                                            Days</span></a></li>
                                                <li><a href="#" class="active"><span>30
                                                            Days</span></a></li>
                                                <li><a href="#"><span>3
                                                            Months</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="data-group">
                                <div class="nk-ecwg4-ck">
                                    <canvas class="lms-doughnut-s1" id="trafficSources"></canvas>
                                </div>
                                <ul class="nk-ecwg4-legends">
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#9cabff"></span>
                                            <span>Organic Search</span>
                                        </div>
                                        <div class="amount amount-xs">4,305</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#ffa9ce"></span>
                                            <span>Referrals</span>
                                        </div>
                                        <div class="amount amount-xs">482</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#b8acff"></span>
                                            <span>Social Media</span>
                                        </div>
                                        <div class="amount amount-xs">859</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#f9db7b"></span>
                                            <span>Others</span>
                                        </div>
                                        <div class="amount amount-xs">138</div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="card-inner card-inner-md bg-light">
                            <div class="card-note">
                                <em class="icon ni ni-info-fill"></em>
                                <span>Traffic channels have beed generating the most
                                    traffics over past days.</span>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div>
    </div>
@endsection
