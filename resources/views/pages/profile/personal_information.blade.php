@extends('pages.profile.index')

@section('profile-content')
    <div class="intro-y box col-span-12 2xl:col-span-6">
        <div class="p-5">
            <form action="{{ route('profile.personal_info_update', $item->id) }}"
                method="post">
                @csrf
                @method('PUT')
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Name and Username</label>
                        <div class="sm:grid grid-cols-2 gap-1">
                            <div class="input-group">
                                <div class="input-group-text">Name</div>
                                <input name="name" type="text" value="{{ !empty($item) ? $item->name : '' }}"
                                       class="form-control" placeholder="Name">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <div class="input-group-text">Username</div>
                                <input name="username" type="text" value="{{ !empty($item) ? $item->username : '' }}"
                                       class="form-control" placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <input name="email" type="email" value="{{ !empty($item) ? $item->email : '' }}"
                                   class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
