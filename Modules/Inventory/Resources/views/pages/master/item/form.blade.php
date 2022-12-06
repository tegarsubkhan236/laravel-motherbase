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
            <form action="{{ !empty($item) ? route('inventory.master.item.update', $item->id) : route('inventory.master.item.store')}}" method="post">
                @csrf
                @if(!empty($item))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Supplier and Item Name</label>
                        <div class="sm:grid grid-cols-2 gap-1">
                            <div class="input-group mt-2 sm:mt-0">
                                <label for="supplier" class="input-group-text">Supplier</label>
                                <select name="supplier" id="supplier" class="form-control tom-select">
                                    <option value="">-- Select Supplier --</option>
                                    @foreach($supplier as $x)
                                        <option value="{{ $x->id }}" {{ !empty($item) && in_array($x->toArray(), $item->inv_supplier->toArray()) ? 'selected' : '' }}>{{ $x->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <label for="name" class="input-group-text whitespace-nowrap">Item Name</label>
                                <input name="name" id="name" type="text" value="{{ !empty($item) ? $item->name : '' }}" class="form-control" placeholder="Item Name">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="description" class="input-group-text whitespace-nowrap">Description</label>
                        <input name="description" id="description" type="text" value="{{ !empty($item) ? $item->description : '' }}" class="form-control" placeholder="Description">
                    </div>
                    <div class="mt-3">
                        <label for="cost" class="input-group-text whitespace-nowrap">Cost</label>
                        <input name="cost" id="cost" type="number" value="{{ !empty($item) ? $item->cost : '' }}" class="form-control" placeholder="Cost">
                    </div>
                    <div class="mt-3">
                        <label for="status">Active Status</label>
                        <div class="form-switch mt-2">
                            <input type="checkbox" name="status" id="status" class="form-check-input" {{ !empty($item) && $item->status === \Modules\Inventory\Casts\ItemStatus::ACTIVE ? 'checked' : 'checked' }}>
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
