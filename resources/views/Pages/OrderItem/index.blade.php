<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="../../fonts/style.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/main.min.css">

    <!-- DateRange css -->
    <link rel="stylesheet" href="../../vendor/daterange/daterange.css" />

    <!-- Chartist css -->
    <link rel="stylesheet" href="../../vendor/chartist/css/chartist.min.css" />
    <link rel="stylesheet" href="../../vendor/chartist/css/chartist-custom.css" />
    <!-- Data Tables -->
    <link rel="stylesheet" href="../../vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="../../vendor/datatables/dataTables.bs4-custom.css" />
    <link href="../../vendor/datatables/buttons.bs.css" rel="stylesheet" />
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="../../vendor/bs-select/bs-select.css" />
    <!-- jQcloud Keywords css -->
    <link rel="stylesheet" href="../../vendor/jqcloud/jqcloud.css" />
    {{-- @livewireStyles --}}
</head>

<body>
    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Sidebar wrapper start -->
		<nav id="sidebar" class="sidebar-wrapper">
			<!-- Sidebar brand start  -->
			<div class="sidebar-brand">
				<a href="index.html" class="logo">
					<img src="img/logo.svg" alt="Bootstrap Admin Dashboard" />
				</a>
				<a href="index.html" class="logo-sm">
					<img src="img/logo-sm.svg" alt="Bootstrap Admin Dashboard" />
				</a>
			</div>
			<!-- Sidebar brand end  -->

			<!-- Sidebar content start -->
			<div class="sidebar-content">

				<!-- sidebar menu start -->
				<div class="sidebar-menu">
					<ul>
						
						<li class=" ">
							<a href="/">
								<i class="icon-devices_other"></i>
								<span class="menu-text">Dashboards</span>
							</a>
							
						</li>
					
						<li class="sidebar-dropdown">
							<a href="#">
								<i class="icon-rate_review"></i>
								<span class="menu-text">Register</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="/table">Table</a>
									</li>
									<li>
										<a href="/category">Category</a>
									</li>
									<li>
										<a href="/menuItem">Product</a>
									</li>
								
								</ul>
							</div>
						</li>
						<li>
							<a href="/waitstaff">
								<i class="icon-add-user"></i>
								<span class="menu-text"> Waitstaff</span>
							</a>
						</li>
						<li>
							<a href="/reservation">
								<i class="icon-grid_on"></i>
								<span class="menu-text"> Reservation</span>
							</a>
						</li>
						<li>
							<a href="/orderItem  ">
								<i class="icon-layout"></i>
								<span class="menu-text"> Order  </span>
							</a>
						</li>
						
						<li>
							<a href="/kitchen  ">
								<i class="icon-add-user"></i>
								<span class="menu-text"> kitchen  </span>
							</a>
						</li>
						
						<li class="header-menu">Inventory</li>
						<li class="sidebar-dropdown">
							<a href="#">
								<i class="icon-edit1"></i>
								<span class="menu-text">Maintain</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="{{ route('location.index') }}"> Item Location</a>
									</li>
									<li>
										<a href="{{ route('itemCategory.index') }}"> Item Category</a>
									</li>
									<li>
										<a href="{{ route('supplyItem.index') }}"> Supply Item</a>
									</li>
									<li>
										<a href="{{ route('supplier.index') }}">Supplier</a>
									</li>
								
								</ul>
							</div>
						</li>
						<li>
							<a href="/purchase">
								<i class="icon-shopping-cart1"></i>
								<span class="menu-text"> Purchase</span>
							</a>
						</li>
						<li>
							<a href="/issuing">
								<i class="icon-documents"></i>
								<span class="menu-text">Issuing</span>
							</a>
						</li>
						
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
                                <span class="user-name">Zyan Ferris</span>
                                <span class="avatar">ZF<span class="status busy"></span></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                                <div class="header-profile-actions">
                                    <div class="header-user-profile">
                                        <div class="header-user">
                                            <img src="img/user.png" alt="Admin Template">
                                        </div>
                                        <h5>Zyan Ferris</h5>
                                        <p>Admin</p>
                                    </div>
                                    <a href="user-profile.html"><i class="icon-user1"></i> My Profile</a>
                                    <a href="account-settings.html"><i class="icon-settings1"></i> Account
                                        Settings</a>
                                    <a href="login.html"><i class="icon-log-out1"></i> Sign Out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Header actions end -->
                </div>
            </header>
            {{-- <livewire:component.interaction-livewire /> --}}

<h1>
    hello
</h1>
<h1>
    hello
</h1>

        </div>
    </div>

    {{-- @livewireScripts
	<script>
		// Refresh the page or Livewire component after 10 seconds
		setTimeout(function () {
			window.location.reload(); // or Livewire.reload() if you want to reload only the Livewire component
		}, 50000); // 10000 milliseconds = 10 seconds
	</script> --}}

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
    <script src="../../vendor/datatables/buttons.min.js"></script>
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
</body>

</html>
