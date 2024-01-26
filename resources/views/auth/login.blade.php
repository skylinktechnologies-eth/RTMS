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


    <!-- Main JS -->
    <script src="../../js/main.js"></script>
    <style>
        body {
            background-color: aqua;

        }

        .box {
            height: 410px;
            width: 900px;
            margin-top: 60px;
           margin-left: 60px;
         
            background-color: rgb(197, 207, 177);

        }
        .box .first{
            background-image: url(th.jpeg) ;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            
        }

        .account-pages {

            padding: 1rem 5rem;
        }
    </style>

</head>

<body>
    <div class="account-pages ">
        <div class="box col-sm-12 ">
            <div class="row d-flex justify-content-center">

                <div class="col-md-6 first">
                

                </div>
                <div class="col-md-6 second">

                    <div class="card-body" style="margin-top: 10%;margin-left:20px;margin-right:20px">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center ">
                                <h4>Login to RTMS</h4>
                            </div>
                           
                            <div class="mb-2 col-9 mt-5">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    :value="old('email')" required="" placeholder="Enter your email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 " />
                            </div>

                            <div class="mb-2 col-9">

                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Enter your password">

                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mb-3 col-9">
                                <div class="form-check">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid col-9 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Log In </button>
                            </div>

                        </form>

                        <div class="row mt-3 mb-0">
                            <div class="col-12 text-center">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                {{-- <p class="text-muted">Don't have an account? <a href="{{ route('register') }}"" class="text-primary fw-medium ms-1">Register</a></p> --}}
                            </div> <!-- end col -->
                        </div>
                    </div>







                </div>
            </div>

        </div>





    </div>
</body>

</html>
