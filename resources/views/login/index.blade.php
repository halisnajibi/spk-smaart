<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('assets/dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Login - Kominfo - Aplikasi Pendukung Keputusan</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Kominfo" class="w-10" src="{{ asset('assets/dist/images/logo-kominfo.png') }}">
                        <span class="text-white text-lg ml-3">Komin<span class="font-medium">fo</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-32 -mt-16" src="{{ asset('assets/dist/images/login.svg') }}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                         Aplikasi
                            <br>
                            Pendukung Keputusan
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white">Dinas Komunikasi dan Informatika</div>
                        <div class="-intro-x mt-5 text-white">Hulu Sungai Selatan</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Login
                        </h2>
                        @if (session('loginError'))
                        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Login gagal!!Harap coba lagi. <i data-feather="x" class="w-4 h-4 ml-auto"></i> </div>
                        @endif
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Dinas Komunikasi dan Informatika</div>
                        <form action="/" method="POST" class="validate-form">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input input input--lg border border-gray-300 block  @error('username') error @enderror()" placeholder="Username" name="username" autocomplete="off">
                            @error('username')
                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                            @enderror
                            <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4  @error('password') error @enderror()" placeholder="Password" name="password">
                            @error('password')
                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                            {{-- <div class="flex items-center mr-auto">
                                <input type="checkbox" class="input border mr-2" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div> --}}
                            <a href="{{ route('lupa-password') }}">Lupa Password?</a> 
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3" type="submit">Login</button>
                        </div>
                    </form>
                        {{-- <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                            By signin up, you agree to our 
                            <br>
                            <a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy Policy</a> 
                        </div> --}}
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="{{asset('assets/dist/js/app.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>