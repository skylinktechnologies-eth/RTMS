
<!DOCTYPE html>
<html lang="en" data-topbar-color="brand">

<!-- Mirrored from coderthemes.com/wb/minton/layouts/default/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Jul 2023 13:48:46 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Log In | Rtms- Admin & Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="../../../img/favicon.svg" />

 
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="../../../fonts/style.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../../css/main.min.css">
    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>
    <style>
        body {
            background-image: url(bac.png);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .box {
            height: 800px;

            background-image: url(card.png);
            background-position: center;
            background-size: cover;
            padding: 1rem 0;

            @media (max-width: 768px) {

                background: transparent;
            }

        }

        .account-pages {
            margin-top: 30px;
            padding: 0 4rem;

            @media (max-width: 1024px) {
                padding: 0 2rem;
            }

            @media (max-width: 768px) {
                padding: 0 2rem;
                margin-top: 50px;
            }

        }

        .card-img {

            height: 400px;
            width: 500px;
            background-image: url(login-amico.png);
            background-size: cover;
            background-position: center;

            @media (max-width: 768px) {
                display: none;
            }

        }
    </style>

</head>

<body>
    <div class="account-pages ">
        <div class="box col-sm-12 ">
            <div class="row d-flex justify-content-center">
                
                <div class="col-md-6">


                </div>
                <div class="col-md-6 ">
                    
                    <div class="card-body" style="margin-top: 40%;margin-left:20px">
                        
                        <form method="POST" action="{{ route('login') }}" style="margin-top: -10%;">
                            @csrf
                            <div class="mb-2 col-9">
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

                        <div class="row mt-3">
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


<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
