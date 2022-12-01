@extends('pages.profile.index')

@section('profile-content')
    <div class="intro-y box col-span-12 2xl:col-span-6">
        <div class="p-5">
            <form
                    action="{{ route('profile.reset_password_update', $item->id) }}"
                    method="post">
                @csrf
                @if(!empty($item))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    @if(!empty($item))
                        <div class="mt-3">
                            <label class="form-label">Old Password</label>
                            <div class="input-group">
                                <input name="old_password" type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    @endif
                    <div class="mt-3">
                        <label class="form-label">{{ !empty($item) ? 'New ' : '' }}Password</label>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Confirm {{ !empty($item) ? 'New ' : '' }} Password</label>
                        <div class="input-group">
                            <input name="confirm_password" type="password" class="form-control"
                                   placeholder="Confirm Password">
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
