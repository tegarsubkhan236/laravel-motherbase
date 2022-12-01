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
            <form
                action="{{ !empty($item) ? route('user_management.permission.update', $item->id) : route('user_management.permission.store')}}"
                method="post">
                @csrf
                @if(!empty($item))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    <div>
                        <label for="parent_id" class="form-label">Permission Parent</label>
                        <div class="input-group">
                            <select name="parent_id" id="parent_id" class="tom-select w-full">
                                <option value="">-- Select Parent --</option>
                                <option value="0" {{ !empty($item) && $item->parent_id == null ? 'selected' : '' }}> As Parent </option>
                                @foreach($parents as $parent)
                                    <option
                                        value="{{ $parent->id }}" {{ !empty($item) && $parent->id == $item->parent_id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="name" class="form-label">Permission Name</label>
                        <div class="input-group">
                            <input name="name" id="name" type="text" value="{{ !empty($item) ? $item->name : '' }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        </a>
                        @can('ms_create_permission' || 'ms_edit_permission')
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
