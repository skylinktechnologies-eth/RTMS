@extends('Frames.app')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Main</li>
    </ol>

    <ul class="app-actions">
        <li>
            <a href="#" id="reportrange">
                <span class="range-text"></span>
                <i class="icon-chevron-down"></i>
            </a>
        </li>
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
                <i class="icon-print"></i>
            </a>
        </li>
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="Download CSV">
                <i class="icon-cloud_download"></i>
            </a>
        </li>
    </ul>
</div>

<!-- Main container start -->
<div class="main-container">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-4 col-lg-6 col-sm-12 col-12">
            <div class="user-details h-320">
                <div class="user-thumb">
                    <img src="th.jpeg" alt="Admin Template" />
                </div>
              
                <button class="btn btn-lg btn-primary">Follow</button>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card h-320">
                <div class="card-body">
                    <div id="tasks"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-12 col-12">
            <div class="user-photos h-320">
                <h5>25K Downloads</h5>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card h-360">
                <div class="card-header">
                    <div class="card-title">Sales Comparison</div>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-lg-5 col-sm-12 col-12">
                            <div id="compare-sales"></div>
                            <div class="info-stats3 shade-one-a">
                                <i class="icon-turned_in"></i>
                                <h6>Q3 - Overall Sales</h6>
                                <h3>45,000</h3>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-12">
                            <div class="vs"></div>
                        </div>
                        <div class="col-lg-5 col-sm-12 col-12">
                            <div id="compare-expenses"></div>
                            <div class="info-stats3 shade-one-a">
                                <i class="icon-turned_in"></i>
                                <h6>Q4 - Overall Sales</h6>
                                <h3>37,000</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-8 col-sm-12 col-12">
            <div class="card h-320">
                <div class="card-header">
                    <div class="card-title">Top Keywords</div>
                </div>
                <div class="card-body d-flex">
                    <div id="my_favorite_latin_words" class="w-100"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card h-320">
                <div class="card-header">
                    <div class="card-title">Todo's</div>
                </div>
                <div class="card-body">
                    <div class="todo-container">
                        <ul class="todo-body">
                            <li class="todo-list">
                                <div class="todo-info">
                                    <span class="dot blue"></span>
                                    <p>Team Meeting</p>
                                    <p>Thursday at 3:30 PM</p>
                                </div>
                            </li>
                            <li class="todo-list done">
                                <div class="todo-info">
                                    <span class="dot orange"></span>
                                    <p>Make new page</p>
                                    <p>Wednesday at 10:30 AM</p>
                                </div>
                            </li>
                            <li class="todo-list done">
                                <div class="todo-info">
                                    <span class="dot yellow"></span>
                                    <p>Product launch</p>
                                    <p>Sunday at Baur Lac, Zurich</p>
                                </div>
                            </li>
                            <li class="todo-list done">
                                <div class="todo-info">
                                    <span class="dot green"></span>
                                    <p>Code Review</p>
                                    <p>Friday at 2:00PM</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card h-320">
                <div class="card-body">
                    <div id="mapAfrica" class="mt-3 chart-height-md"></div>
                    <div class="info-stats3 m-0">
                        <h6>Overall Sales in Africa</h6>
                        <h3>$97,000</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card h-320">
                <div class="card-header">
                    <div class="card-title">Statistics</div>
                </div>
                <div class="card-body">
                    <ul class="statistics">
                        <li>
                            <span class="stat-icon">
                                <i class="icon-eye1"></i>
                            </span>
                            A new ticket opened.
                        </li>
                        <li>
                            <span class="stat-icon">
                                <i class="icon-thumbs-up1"></i>
                            </span>
                            That's A great idea!
                        </li>
                        <li>
                            <span class="stat-icon">
                                <i class="icon-star2"></i>
                            </span>
                            Tell us what you think.
                        </li>
                        <li>
                            <span class="stat-icon">
                                <i class="icon-shopping-bag1"></i>
                            </span>
                            A new item sold.
                        </li>
                        <li>
                            <span class="stat-icon">
                                <i class="icon-check-circle"></i>
                            </span>
                            Design approved.
                        </li>
                        <li>
                            <span class="stat-icon">
                                <i class="icon-clipboard"></i>
                            </span>
                            Assigned new task to Zyan.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card h-320">
                <div class="card-header">
                    <div class="card-title">Top Pages Visited</div>
                </div>
                <div class="card-body">
                    <ul class="bookmarks">
                        <li>
                            <a href="#">Bootstrap admin template</a>
                        </li>
                        <li>
                            <a href="#">Images resources</a>
                        </li>
                        <li>
                            <a href="#">Best admin templates 2020</a>
                        </li>
                        <li>
                            <a href="#">Javascript libraries</a>
                        </li>
                        <li>
                            <a href="#">Angular widgets</a>
                        </li>
                        <li>
                            <a href="#">UX library</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

</div>
<!-- Main container end -->

   

@endsection
