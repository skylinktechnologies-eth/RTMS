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

        </ul>
    </div>

    <!-- Main container start -->
    <div class="main-container">

        <!-- Row start -->

        <div class="row gutters">
            <div class="col-xl-3 col-lg-6 col-sm-12 col-12">
                <div class="card" style="background-color: #ffffff;  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body"
                        style="background: linear-gradient(to right, #3498db, #ffffff); border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="icon-shopping-cart1"
                                    style="font-size: 50px; width: 50px; height: 50px; color: #74047a; margin-right: 10px;"></i>

                                <!-- You can add more decorative elements here, such as additional icons, text, or images -->
                            </div>
                            <div class="text-end">

                                <h4 class="mb-0" style="color: #34495e; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                                    Total Product</h4>
                                <h3 class="text-center" style="color: #34495e;">
                                    <span data-plugin="counterup"
                                        style="color: #2ecc71; font-size: 24px;">{{ $product }}</span>
                                </h3>

                            </div>



                        </div>
                    </div>
                </div>



            </div>
            <div class="col-xl-3 col-lg-6 col-sm-12 col-12">
                <div class="card" style="background-color: #ffffff;  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body"
                        style="background: linear-gradient(to right, #8d34db, #ffffff); border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="icon-rate_review"
                                    style="font-size: 50px; width: 50px; height: 50px; color: #017bd2; margin-right: 10px;"></i>

                                <!-- You can add more decorative elements here, such as additional icons, text, or images -->
                            </div>
                            <div class="text-end">

                                <h4 class="mb-0" style="color: #34495e; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                                    Total Orders</h4>
                                <h3 class="text-center" style="color: #34495e;">
                                    <span data-plugin="counterup"
                                        style="color: #2ecc71; font-size: 24px;">{{ $order }}</span>
                                </h3>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-12 col-12">
                <div class="card" style="background-color: #ffffff;  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body"
                        style="background: linear-gradient(to right, #db345b, #ffffff); border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="icon-local_atm"
                                    style="font-size: 50px; width: 50px; height: 50px; color: #04882b; margin-right: 10px;"></i>

                                <!-- You can add more decorative elements here, such as additional icons, text, or images -->
                            </div>
                            <div class="text-end">

                                <h4 class="mb-0" style="color: #34495e; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                                    Total Sales</h4>
                                <h3 class="text-center" style="color: #34495e;">
                                    <span data-plugin="counterup"
                                        style="color: #2ecc71; font-size: 24px;">{{ $sales->count() }}</span>
                                </h3>

                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-sm-12 col-12">
                <div class="card" style="background-color: #ffffff;  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body"
                        style="background: linear-gradient(to right, #34dbd0, #ffffff); border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="icon-dollar-sign"
                                    style="font-size: 50px; width: 50px; height: 50px; color: #e4620b; margin-right: 10px;"></i>

                                <!-- You can add more decorative elements here, such as additional icons, text, or images -->
                            </div>
                            <div class="text-end">

                                <h5 class="mb-0" style="color: #34495e; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                                    Collected Amount</h5>
                                <?php
                                $total = $sales->where('order.status', 'Close')->sum('sub_total');
                                ?>
                                <h3 class="text-center" style="color: #34495e;">
                                    <span data-plugin="counterup"
                                        style="color: #2ecc71; font-size: 24px;">{{ $total }}</span>
                                </h3>

                            </div>



                        </div>
                    </div>
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
    </div>
    <!-- Main container end -->
@endsection