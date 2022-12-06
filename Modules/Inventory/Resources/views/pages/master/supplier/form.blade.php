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
            <form action="{{ !empty($item) ? route('inventory.master.supplier.update', $item->id) : route('inventory.master.supplier.store')}}" method="post">
                @csrf
                @if(!empty($item))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Supplier and Contact Person</label>
                        <div class="sm:grid grid-cols-2 gap-1">
                            <div class="input-group">
                                <label for="name" class="input-group-text">Supplier</label>
                                <input name="name" id="name" type="text" value="{{ !empty($item->name) ? $item->name : '' }}"
                                       class="form-control" placeholder="Name">
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <label for="cperson" class="input-group-text whitespace-nowrap">Contact Person</label>
                                <input name="cperson" id="cperson" type="text"
                                       value="{{ !empty($item) ? $item->cperson : '' }}" class="form-control"
                                       placeholder="Contact Person">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group">
                            <input name="address" id="address" type="text" value="{{ !empty($item) ? $item->address : '' }}"
                                   class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="contact" class="form-label">Phone</label>
                        <div class="input-group">
                            <input name="contact" id="contact" type="text" value="{{ !empty($item) ? $item->contact : '' }}"
                                   class="form-control" placeholder="Contact">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="status">Active Status</label>
                        <div class="form-switch mt-2">
                            <input type="checkbox" name="status" id="status" class="form-check-input" {{ !empty($item) && $item->status === \Modules\Inventory\Casts\SupplierStatus::ACTIVE ? 'checked' : 'checked' }}>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">{{ !empty($item) ? 'Update' : 'Save' }}</button>
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
