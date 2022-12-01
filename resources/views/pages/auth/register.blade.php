@extends('layouts.auth')

@section('content')
    <form action="{{ route('register.process') }}" method="post">
        @csrf
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Sign Up
        </h2>
        @include('vendor.alert.basic')

        <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
        <div class="intro-x mt-8">
            <input name="name" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Name">
            <input name="username" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Username">
            <input name="email" type="email" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email">
            <input name="password" type="password" class="intro-x login__input form-control py-3 px-4 block" placeholder="Password">
            <input name="password_confirm" type="password" class="intro-x login__input form-control py-3 px-4 block" placeholder="Password Confirmation">
        </div>
        <div class="intro-x flex items-center text-slate-600 dark:text-slate-500 mt-4 text-xs sm:text-sm">
            <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
            <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
            <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>.
        </div>
        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
            <a href="{{ route('login') }}">
                <button type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign in</button>
            </a>
        </div>
@endsection
