@extends('layouts.app')

@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        {{$title}} Data
    </h2>
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            @can('ms_create_user')
                <a href="{{ route("$addRoute") }}">
                    <button class="btn btn-primary shadow-md mr-2">Add New {{ $title }}</button>
                </a>
            @endcan
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
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">ITEM NAME</th>
                    <th class="whitespace-nowrap">QUANTITY</th>
                    <th class="whitespace-nowrap">UNIT</th>
                    <th class="whitespace-nowrap">PRICE</th>
                    <th class="whitespace-nowrap">TOTAL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="intro-x">
                        <td>{{ $item->inv_item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->total }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="tooltip flex items-center text-warning mr-3" title="Edit {{ $title }}"
                                   href="{{ route('inventory.master.stock.edit', [$item->id]) }}">
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
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible pt-5 pb-5">
            <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Recent Activities
                    </h2>
                    <a href="" class="ml-auto text-primary truncate">Show More</a>
                </div>
                <div class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">Keanu Reeves</div>
                                <div class="text-xs text-slate-500 ml-auto">07:00 PM</div>
                            </div>
                            <div class="text-slate-500 mt-1">Has joined the team</div>
                        </div>
                    </div>
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">Kate Winslet</div>
                                <div class="text-xs text-slate-500 ml-auto">07:00 PM</div>
                            </div>
                            <div class="text-slate-500">
                                <div class="mt-1">Added 3 new photos</div>
                                <div class="flex mt-2">
                                    <div class="tooltip w-8 h-8 image-fit mr-1 zoom-in" title="Nike Air Max 270">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md border border-white" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                                    </div>
                                    <div class="tooltip w-8 h-8 image-fit mr-1 zoom-in" title="Dell XPS 13">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md border border-white" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                                    </div>
                                    <div class="tooltip w-8 h-8 image-fit mr-1 zoom-in" title="Dell XPS 13">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md border border-white" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-x text-slate-500 text-xs text-center my-4">12 November</div>
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">Brad Pitt</div>
                                <div class="text-xs text-slate-500 ml-auto">07:00 PM</div>
                            </div>
                            <div class="text-slate-500 mt-1">Has changed <a class="text-primary" href="">Samsung Q90 QLED TV</a> price and description</div>
                        </div>
                    </div>
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/profile-3.jpg') }}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">John Travolta</div>
                                <div class="text-xs text-slate-500 ml-auto">07:00 PM</div>
                            </div>
                            <div class="text-slate-500 mt-1">Has changed <a class="text-primary" href="">Nike Tanjun</a> description</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $data->links('pagination::tailwind') }}
        </div>
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete these records?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@push('css')

@endpush

@push('js')
    <script>

    </script>
@endpush
