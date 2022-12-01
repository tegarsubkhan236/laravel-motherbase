@php use App\Casts\UserStatus; @endphp
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
                    <th class="whitespace-nowrap">IMAGES</th>
                    <th class="whitespace-nowrap">NAME</th>
                    <th class="text-center whitespace-nowrap">EMAIL</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="whitespace-nowrap">Roles</th>
                    <th class="whitespace-nowrap">Permissions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#" class="tooltip rounded-full"
                                         src="{{ asset('dashboardAsset/dist/images/preview-11.jpg') }}"
                                         title="Uploaded at 12 October 2020">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $item->name }}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $item->username }}</div>
                        </td>
                        <td class="text-center">{{ $item->email }}</td>
                        <td class="w-40">
                            <div
                                class="flex items-center justify-center {{ $item->status == UserStatus::ACTIVE ? "text-success" : "text-danger"}}">
                                <i data-lucide="{{ $item->status == UserStatus::ACTIVE ? "check-square" : "square"}}"
                                   class="w-4 h-4 mr-2"></i>
                                {{ UserStatus::lang($item->status) }}
                            </div>
                        </td>
                        <td>
                            @foreach($item->roles as $role)
                                <span
                                    class="bg-primary text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-darkmode-800 dark:text-white"
                                    style="white-space: nowrap">
                                    {{$role->name}}
                                </span><p class="mb-1"></p>
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->permissions as $permission)
                                <span
                                    class="bg-primary text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-darkmode-800 dark:text-white">
                                    {{$permission->name}}
                                </span><br>
                            @endforeach
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('ms_edit_user')
                                    <a class="tooltip flex items-center text-warning mr-3" title="Edit {{ $title }}"
                                       href="{{ route('user_management.user.edit', [$item->id]) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                @endcan
                                @can('ms_delete_user')
                                    <a class="tooltip flex items-center text-danger" title="Delete {{ $title }}"
                                       href="#"
                                       data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
