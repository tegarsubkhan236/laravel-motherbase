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
            <form action="{{ !empty($item) ? route('inventory.master.stock.update', $item->id) : route('inventory.master.stock.store')}}" method="post">
                @csrf
                @if(!empty($item))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Item and Quantity</label>
                        <div class="sm:grid grid-cols-2 gap-1">
                            <div class="input-group mt-2 sm:mt-0">
                                <label for="item_id" class="input-group-text">Item</label>
                                <select name="item_id" id="item_id" class="form-control tom-select">
                                    <option value="">-- Select Item --</option>
                                    @foreach($items as $x)
                                        <option value="{{ $x->id }}" {{ !empty($item) && in_array($x->toArray(), $item->inv_item->toArray()) ? 'selected' : '' }}>{{ $x->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mt-2 sm:mt-0">
                                <label for="quantity" class="input-group-text whitespace-nowrap">Quantity</label>
                                <input name="quantity" id="quantity" type="text" value="{{ !empty($item) ? $item->quantity : '' }}" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="unit" class="input-group-text whitespace-nowrap">Unit</label>
                        <input name="unit" id="unit" type="text" value="{{ !empty($item) ? $item->unit : '' }}" class="form-control" placeholder="Unit">
                    </div>
                    <div class="mt-3">
                        <label for="price" class="input-group-text whitespace-nowrap">Price</label>
                        <input name="price" id="price" type="number" value="{{ !empty($item) ? $item->price : '' }}" class="form-control" placeholder="Price">
                    </div>
                    <div class="mt-3">
                        <label for="type">Type</label>
                        <div class="mt-2">
                            <div class="form-check mt-2">
                                <input id="type-in" class="form-check-input" type="radio" name="type" value={{ \Modules\Inventory\Casts\StockType::IN }}
                                    {{ !empty($item) && $item->type == \Modules\Inventory\Casts\StockType::IN ? 'checked' : ''}}>
                                <label class="form-check-label" for="type-in">In</label>
                            </div>
                            <div class="form-check mt-2">
                                <input id="radio-switch-2" class="form-check-input" type="radio" name="type" value={{ \Modules\Inventory\Casts\StockType::OUT }}
                                    {{ !empty($item) && $item->type == \Modules\Inventory\Casts\StockType::OUT ? 'checked' : ''}}>
                                <label class="form-check-label" for="radio-switch-2">Out</label>
                            </div>
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
