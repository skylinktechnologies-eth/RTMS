<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Admin Templates & Dashboard UI Kits">
    <meta name="author" content="Bootstrap Gallery" />
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="../../../img/favicon.svg" />

    <!-- Title -->
    <title>Restaurant management system</title>

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
        /* Enhance visibility of placeholder text */
        ::placeholder {
            color: #6c757d;
            /* Bootstrap's default placeholder color */
            opacity: 1;
            /* Ensure placeholder is fully visible */
        }

        .card {
            background-color: #fff;
            /* Ensure card background is white */
            border: 1px solid rgba(0, 0, 0, .125);
            /* Bootstrap default card border */
        }

        .form-label {
            color: #070404
        }

        .row {
            margin-right: 10px;
            margin-left: 10px;
        }
    </style>

</head>

<body>
    <section class="vh-100" style="background-color:#6cac91">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-9">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <!-- Adjusted column classes for smaller screens -->
                            <div class="col-md-6 col-lg-5 d-flex justify-content-center align-items-center ">
                                <img src="th2.jpg" alt="login form" class="img-fluid h-80 mt-5 mb-3 "
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex justify-content-center align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="{{ route('login') }}" style="margin-top: -10%;">
                                        @csrf
                                        <div class=" text-center mb-3 pb-1">
                                            <!-- Centering the image horizontally -->
                                            <img src="rec_logo.png" class="navbar-brand-img h-200 rounded mt-5"
                                                alt="main_logo" style="background-color: #fafafa; height: 130px;">
                                            <h4>Reastaurant Table Management System</h4>
                                        </div>
                                        <div class="form-outline mb-2">
                                            <input class="form-control" type="email" id="email" name="email"
                                                :value="old('email')" required="" placeholder="Enter your email">

                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2 " />
                                        </div>
                                        <div class="form-outline mb-2">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter your password">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="pt-1 mb-4 justify-content-center">
                                            <button class="btn bg-primary btn-lg btn-block" type="submit"
                                                style="color:white">Login</button>
                                        </div>

                                    </form>
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    </section>


</body>

</html>
