@extends('layouts.app')

@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Profile
        </h2>
    </div>
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5 lg:mt-0">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="avatar" class="rounded-full" src="{{ asset('dashboardAsset/dist/images/profile-13.jpg') }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ $item->name }}</div>
                        <div class="text-slate-500">
                            @foreach($item->roles as $role)
                                | {{ $role->name }} |
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center {{ request()->routeIs('profile.personal_info') ? 'text-primary font-medium': ''}}" href="{{ route('profile.personal_info', $item->id) }}">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Personal Information
                    </a>
                    <a class="flex items-center mt-5 {{ request()->routeIs('profile.reset_password') ? 'text-primary font-medium': ''}}" href="{{ route('profile.reset_password', $item->id) }}">
                        <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Form -->
                @yield('profile-content')
                <!-- END: Form -->
            </div>
        </div>
    </div>
@endsection
