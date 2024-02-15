<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Admin Templates & Dashboard UI Kits">
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="../../https://www.bootstrap.gallery/">
    <meta property="og:url" content="../../https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="../../../img/favicon.svg" />

    <!-- Title -->
    <title>Bootstrap Admin Dashboard - Dashboard</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="../../../fonts/style.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../../css/main.min.css">

    <!-- DateRange css -->
    <link rel="stylesheet" href="../../../vendor/daterange/daterange.css" />

    <!-- Chartist css -->
    <link rel="stylesheet" href="../../../vendor/chartist/css/chartist.min.css" />
    <link rel="stylesheet" href="../../../vendor/chartist/css/chartist-custom.css" />
    <!-- Data Tables -->
    <link rel="stylesheet" href="../../../vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="../../../vendor/datatables/dataTables.bs4-custom.css" />
    <link href="../../../vendor/datatables/buttons.bs.css" rel="stylesheet" />
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="../../../vendor/bs-select/bs-select.css" />
    <!-- jQcloud Keywords css -->
    <link rel="stylesheet" href="../../../vendor/jqcloud/jqcloud.css" />

    <style>
        /* Default styles for sidebar-menu without scrollbar */
        .slimScrollDiv {
            overflow: auto !important;
        }

        .sidebar-content {
            overflow-y: auto;
            height: 100%;
        }


        /* Styles for scrollbar on larger devices */
        @media screen and (min-width: 768px) {
            .sidebar-content {
                overflow-y: auto;
                /* Show scrollbar on larger devices */
                scrollbar-width: thin;
                scrollbar-color: #888 #eee;
            }

            /* For Chrome, Safari, and Opera */
            .sidebar-content::-webkit-scrollbar {
                width: 6px;
            }

            .sidebar-content::-webkit-scrollbar-thumb {
                background-color: #569c6b;
            }

            .sidebar-content::-webkit-scrollbar-track {
                background-color: #eee;
            }
        }
    </style>
    @livewireStyles
</head>

<body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">
        @php

            $roleList = auth()->user()->can('role-list');
            $userList = auth()->user()->can('user-list');
            $waitstaffList = auth()->user()->can('waitstaff-list');
            $tableList = auth()->user()->can('table-list');
            $supplierList = auth()->user()->can('supplier-list');
            $reservationList = auth()->user()->can('reservation-list');
            $supplyItemList = auth()->user()->can('supplyItem-list');
            $reportList = auth()->user()->can('report-manage');
            $purchaseList = auth()->user()->can('purchase-list');
            $orderList = auth()->user()->can('order-list');
            $menuItemList = auth()->user()->can('menuItem-list');
            $locationList = auth()->user()->can('location-list');
            $supplyItemCategoryList = auth()->user()->can('supplyItemCategory-list');
            $issuingList = auth()->user()->can('issuing-list');
            $menuCategoryList = auth()->user()->can('menuCategory-list');
            $kitchenList = auth()->user()->can('kitchen-list');
        @endphp

        <!-- Sidebar wrapper start -->
        <nav id="sidebar" class="sidebar-wrapper">
            <!-- Sidebar brand start  -->
            <div class="sidebar-brand">

                <a href="/" class="logo" style="padding:5px">
                    <span class="logo-lg">
                        <img src="rectangle_logo.png" style="border-radius: 50%" height="45px" alt="">
                        <span class="logo-lg-" style="color: white">Restaurant</span>
                    </span>
                </a>

                <a href="/" class="logo-sm">
                    <img src="rectangle_logo.png" alt="Bootstrap Admin Dashboard" style="border-radius: 50%"
                        height="45px" />
                </a>
            </div>
            <!-- Sidebar brand end  -->

            <!-- Sidebar content start -->
            <div class="sidebar-content">


                <!-- sidebar menu start -->
                <div class="sidebar-menu" style="">
                    <ul>

                        <li class=" ">
                            <a href="/">
                                <i class="icon-devices_other"></i>
                                <span class="menu-text">Dashboards</span>
                            </a>

                        </li>
                        @if ($userList || $roleList || Auth::user()->hasRole('Admin'))
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="icon-rate_review"></i>
                                    <span class="menu-text">User Managment</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        @can('user-list')
                                            <li>
                                                <a href="/users">User</a>
                                            </li>
                                        @endcan
                                        @can('role-list')
                                            <li>
                                                <a href="/roles">Role</a>
                                            </li>
                                        @endcan

                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if ($menuCategoryList || $tableList || $menuItemList)
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="icon-rate_review"></i>
                                    <span class="menu-text">Register</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        @can('menuCategory-list')
                                            <li>
                                                <a href="/category">Category</a>
                                            </li>
                                        @endcan
                                        @can('table-list')
                                            <li>
                                                <a href="/table">Table</a>
                                            </li>
                                        @endcan
                                        @can('menuItem-list')
                                            <li>
                                                <a href="/menuItem">Product</a>
                                            </li>
                                        @endcan

                                    </ul>
                                </div>
                            </li>
                        @endif
                        @can('waitstaff-list')
                            <li>
                                <a href="/waitstaff">
                                    <i class="icon-add-user"></i>
                                    <span class="menu-text"> Waitstaff</span>
                                </a>
                            </li>
                        @endcan


                        @can('reservation-list')
                            <li>
                                <a href="/reservation">
                                    <i class="icon-grid_on"></i>
                                    <span class="menu-text"> Reservation</span>
                                </a>
                            </li>
                        @endcan

                        @can('order-list')
                            <li>
                                <a href="/orderItem  ">
                                    <i class="icon-layout"></i>
                                    <span class="menu-text"> Order </span>
                                </a>
                            </li>
                        @endcan

                        @can('kitchen-list')
                            <li>
                                <a href="/kitchen  ">
                                    <i class="icon-add-user"></i>
                                    <span class="menu-text"> kitchen </span>
                                </a>
                            </li>
                        @endcan


                        <li class="header-menu">Inventory</li>
                        @if ($locationList || $supplyItemCategoryList || $supplyItemList || $supplierList)
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="icon-edit1"></i>
                                    <span class="menu-text">Maintain</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        @can('location-list')
                                            <li>
                                                <a href="{{ route('location.index') }}"> Item Location</a>
                                            </li>
                                        @endcan
                                        @can('supplyItemCategory-list')
                                            <li>
                                                <a href="{{ route('itemCategory.index') }}"> Item Category</a>
                                            </li>
                                        @endcan
                                        @can('supplyItem-list')
                                            <li>
                                                <a href="{{ route('supplyItem.index') }}"> Supply Item</a>
                                            </li>
                                        @endcan
                                        @can('supplier-list')
                                            <li>
                                                <a href="{{ route('supplier.index') }}">Supplier</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @can('purchase-list')
                            <li>
                                <a href="/purchase">
                                    <i class="icon-shopping-cart1"></i>
                                    <span class="menu-text"> Purchase</span>
                                </a>
                            </li>
                        @endcan

                        @can('issuing-list')
                            <li>
                                <a href="/issuing">
                                    <i class="icon-documents"></i>
                                    <span class="menu-text">Issuing</span>
                                </a>
                            </li>
                        @endcan

                        @if ($reportList)
                            <li class="header-menu">Reports</li>
                            @can('report-manage')
                                <li>
                                    <a href="/report  ">
                                        <i class="icon-add-user"></i>
                                        <span class="menu-text"> Report </span>
                                    </a>
                                </li>
                            @endcan
                        @endif
                    </ul>
                </div>
                <!-- sidebar menu end -->

            </div>
            <!-- Sidebar content end -->
        </nav>
        <!-- Sidebar wrapper end -->

        <!-- Page content start  -->
        <div class="page-content">

            <!-- Header start -->
            <header class="header">
                <div class="toggle-btns">
                    <a id="toggle-sidebar" href="#">
                        <i class="icon-list"></i>
                    </a>
                    <a id="pin-sidebar" href="#">
                        <i class="icon-list"></i>
                    </a>
                </div>
                <div class="header-items">
                    <!-- Custom search start -->

                    <!-- Custom search end -->

                    <!-- Header actions start -->
                    <ul class="header-actions">

                        <li class="dropdown">
                            <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                                <i class="icon-bell"></i>
                                <span class="count-label">8</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                                <div class="dropdown-menu-header">
                                    Notifications (40)
                                </div>
                                <ul class="header-notifications">
                                    <li>
                                        <a href="#">
                                            <div class="user-img away">
                                                <img src="img/user10.png" alt="Bootstrap Admin Panel">
                                            </div>
                                            <div class="details">
                                                <div class="user-title">Abbott</div>
                                                <div class="noti-details">Membership has been ended.</div>
                                                <div class="noti-date">Today, 07:30 pm</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-img busy">
                                                <img src="img/user10.png" alt="Admin Panel">
                                            </div>
                                            <div class="details">
                                                <div class="user-title">Braxten</div>
                                                <div class="noti-details">Approved new design.</div>
                                                <div class="noti-date">Today, 12:00 am</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-img online">
                                                <img src="img/user6.png" alt="Admin Template">
                                            </div>
                                            <div class="details">
                                                <div class="user-title">Larkyn</div>
                                                <div class="noti-details">Check out every table in detail.</div>
                                                <div class="noti-date">Today, 04:00 pm</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown"
                                aria-haspopup="true">
                                <span class="user-name"> {{ Auth::user()->name }}</span>
                                <span class="avatar">ZF<span class="status busy"></span></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                                <div class="header-profile-actions">

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
																this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Header actions end -->
                </div>
            </header>
            <!-- Header end -->

            <!-- Main container start -->
            @yield('content')
            <!-- Main container end -->

        </div>
        <!-- Page content end -->

    </div>


    @livewireScripts

    <!-- Page wrapper end -->

    <!--**************************
   **************************
    **************************
       Required JavaScript Files
    **************************
   **************************
  **************************-->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/moment.js"></script>


    <!-- *************
   ************ Vendor Js Files *************
  ************* -->
    <!-- Slimscroll JS -->
    <script src="../../vendor/slimscroll/slimscroll.min.js"></script>
    <script src="../../vendor/slimscroll/custom-scrollbar.js"></script>

    <!-- Daterange -->
    <script src="../../vendor/daterange/daterange.js"></script>
    <script src="../../vendor/daterange/custom-daterange.js"></script>

    <!-- Data Tables -->
    <script src="../../vendor/datatables/dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Data tables -->
    <script src="../../vendor/datatables/custom/custom-datatables.js"></script>
    <script src="../../vendor/datatables/custom/fixedHeader.js"></script>

    <!-- Download / CSV / Copy / Print -->
    <script src="../../../vendor/datatables/buttons.min.js"></script>
    <script src="../../vendor/datatables/jszip.min.js"></script>
    <script src="../../vendor/datatables/pdfmake.min.js"></script>
    <script src="../../vendor/datatables/vfs_fonts.js"></script>
    <script src="../../vendor/datatables/html5.min.js"></script>
    <script src="../../vendor/datatables/buttons.print.min.js"></script>
    <!-- Chartist JS -->
    <script src="../../vendor/chartist/js/chartist.min.js"></script>
    <script src="../../vendor/chartist/js/chartist-tooltip.js"></script>
    <script src="../../vendor/chartist/js/custom/threshold/threshold.js"></script>
    <script src="../../vendor/chartist/js/custom/bar/bar-chart-orders.js"></script>

    <!-- jVector Maps -->
    <script src="../../vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../../vendor/jvectormap/world-mill-en.js"></script>
    <script src="../../vendor/jvectormap/gdp-data.js"></script>
    <script src="../../vendor/jvectormap/custom/world-map-markers2.js"></script>

    <!-- Rating JS -->
    <script src="../../vendor/rating/raty.js"></script>
    <script src="../../vendor/rating/raty-custom.js"></script>
    <!-- Bootstrap Select JS -->
    <script src="../../vendor/bs-select/bs-select.min.js"></script>

    <!-- Apex Charts -->
    <script src="../../vendor/apex/apexcharts.min.js"></script>
    <script src="../../vendor/apex/quick-dashboard/tasks.js"></script>
    <script src="../../vendor/apex/quick-dashboard/compare-sales.js"></script>
    <script src="../../vendor/apex/quick-dashboard/compare-sales1.js"></script>

    <!-- jQcloud Keywords -->
    <script src="../../vendor/jqcloud/jqcloud-1.0.4.min.js"></script>
    <script src="../../vendor/jqcloud/custom-jqcloud.js"></script>

    <!-- jVector Maps -->
    <script src="../../vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../../vendor/jvectormap/gdp-data.js"></script>
    <script src="../../vendor/jvectormap/africa-mill.js"></script>

    <!-- Custom JVector Maps -->
    <script src="../../vendor/jvectormap/custom/map-africa1.js"></script>



    <!-- Main JS -->
    <script src="../../js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the current URL path
            var currentPath = window.location.pathname;

            // Select the menu items and iterate through them
            var menuItems = document.querySelectorAll('.sidebar-menu a');
            menuItems.forEach(function(item) {
                // Check if the item's href matches the current URL
                if (item.getAttribute('href') === currentPath) {
                    // Add the "active" class to the parent <li> element
                    item.closest('li').classList.add('active');
                }
            });
        });
    </script>

    <script>
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 5000);
    </script>
    <script>
        setTimeout(function() {
            document.getElementById('danger-alert').style.display = 'none';
        }, 5000);
    </script>
    <script>
        setTimeout(function() {
            document.getElementById('warning-alert').style.display = 'none';
        }, 5000);
    </script>

</body>

</html>
