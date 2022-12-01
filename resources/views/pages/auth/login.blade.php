@extends('layouts.auth')

@section('content')
    <form action="{{ route('login.process') }}" method="post">
        @csrf
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Sign In
        </h2>
        @include('vendor.alert.basic')
        <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
            A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place
        </div>
        <div class="intro-x mt-8">
            <label>
                <input name="username" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Username">
            </label>
            <label>
                <input name="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
            </label>
        </div>
        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
            <div class="flex items-center mr-auto">
                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
            </div>
            <a href="">Forgot Password?</a>
        </div>
        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</button>
            </a>
        </div>
        <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
            By signin up, you agree to our
            <a class="text-primary dark:text-slate-200" href="">Terms and Conditions</a> &
            <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a>
        </div>
    </form>
@endsection
