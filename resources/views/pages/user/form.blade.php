@extends('layouts.app')

@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{ empty($item) ? 'Add New' : 'Edit' }} {{ $title }}
        </h2>
    </div>
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form action="{{ !empty($item) ? route('user_management.user.update', $item->id) : route('user_management.user.store')}}" method="post">
                @csrf
                @if(!empty($item))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Name and Username</label>
                        <div class="sm:grid grid-cols-2 gap-1">
                            <div class="input-group">
                                <label for="name" class="input-group-text">Name</label>
                                <input name="name" id="name" type="text" value="{{ !empty($item->name) ? $item->name : '' }}"
                                       class="form-control" placeholder="Name">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <label for="username" class="input-group-text">Username</label>
                                <input name="username" id="username" type="text"
                                       value="{{ !empty($item) ? $item->username : '' }}" class="form-control"
                                       placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input name="email" id="email" type="email" value="{{ !empty($item) ? $item->email : '' }}"
                                   class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">{{ !empty($item) ? 'New ' : '' }}Password</label>
                        <div class="input-group">
                            <input name="password" id="password" type="password" class="form-control"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="confirm_password" class="form-label">Confirm {{ !empty($item) ? 'New ' : '' }}
                            Password</label>
                        <div class="input-group">
                            <input name="confirm_password" id="confirm_password" type="password" class="form-control"
                                   placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role[]" id="role" class="tom-select w-full" multiple>
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ !empty($item) && in_array($role->toArray(), $item->roles->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="status">Active Status</label>
                        <div class="form-switch mt-2">
                            <input type="checkbox" name="status" id="status" class="form-check-input" {{ !empty($item) && $item->status === \App\Casts\UserStatus::ACTIVE ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        </a>
                        @can('ms_create_user' || 'ms_edit_user')
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                        @endcan
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@push('css')

@endpush

@push('js')
@endpush
