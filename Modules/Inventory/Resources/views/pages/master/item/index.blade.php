@extends('layouts.app')

@section('content')
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data Search -->
        <div class="col-span-12 xl:col-span-3">
            <form action="#" method="post">
                @csrf
                <div class="intro-y box p-5">
                    <h2 class="text-lg font-medium text-center">
                        {{$title}} Data
                    </h2>
                    <div class="mt-3">
                        <label for="supplier" class="whitespace-nowrap">Supplier</label>
                        <select name="supplier" id="supplier" class="form-control tom-select">
                            <option value="">-- Select Supplier --</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="whitespace-nowrap">Item</label>
                        <input name="name" id="name" type="text" value="" class="form-control" placeholder="Item">
                    </div>
                    <div class="mt-3">
                        <label for="description" class="whitespace-nowrap">Description</label>
                        <input name="description" id="description" type="text" value="" class="form-control" placeholder="Description">
                    </div>
                    <div class="mt-3">
                        <label for="cost" class="whitespace-nowrap">Cost</label>
                        <input name="cost" id="cost" type="number" value="" class="form-control" placeholder="Cost">
                    </div>
                    <div class="mt-3">
                        <label for="status">Active Status</label>
                        <div class="form-switch mt-2">
                            <input type="checkbox" name="status" id="status" class="form-check-input">
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Reset</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- END: Data Search -->
        <!-- BEGIN: Data List -->
        <div class="col-span-12 xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 flex flex-wrap sm:flex-nowrap items-center">
                    <a href="{{ route("$addRoute") }}">
                        <button class="btn btn-primary shadow-md mr-2">Add New {{ $title }}</button>
                    </a>
                    <div class="hidden md:block mx-auto text-slate-500"></div>
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <form action="{{ route($searchRoute) }}" method="GET">
                            @csrf
                            <div class="w-56 relative text-slate-500">
                                <label>
                                    <input name="search"
                                           value="{{ !empty(request()->has('search')) ? request()->get('search') : ''}}"
                                           type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                                </label>
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-span-12 mt-5 overflow-auto lg:overflow-visible">
                    <table class="intro-y table table-report table-hover">
                    <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">SUPPLIER</th>
                        <th class="whitespace-nowrap">ITEM NAME</th>
                        <th class="whitespace-nowrap">COST</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="whitespace-nowrap">DESCRIPTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr class="intro-x">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->inv_supplier->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->cost }}</td>
                            <td class="w-40">
                                <div
                                    class="flex items-center justify-center {{ $item->status == \Modules\Inventory\Casts\itemStatus::ACTIVE ? "text-success" : "text-danger"}}">
                                    <i data-lucide="{{ $item->status == \Modules\Inventory\Casts\itemStatus::ACTIVE ? "check-square" : "square"}}"
                                       class="w-4 h-4 mr-2"></i>
                                    {{\Modules\Inventory\Casts\itemStatus::lang($item->status)}}
                                </div>
                            </td>
                            <td>{{ $item->description }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="tooltip flex items-center text-warning mr-3" title="Edit {{ $title }}"
                                       href="{{ route('inventory.master.item.edit', [$item->id]) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="tooltip flex items-center text-danger" title="Delete {{ $title }}"
                                       href="#"
                                       data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $data->links('pagination::tailwind') }}
        </div>
        <!-- END: Pagination -->
    </div>
@endsection

@push('css')

@endpush

@push('js')
    <script>

    </script>
@endpush
