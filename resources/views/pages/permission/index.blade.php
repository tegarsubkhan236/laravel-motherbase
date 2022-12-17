@extends('layouts.app')

@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        {{$title}} Data
    </h2>
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            @can('ms_create_permission')
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
                            <input name="search" value="{{ !empty(request()->has('search')) ? request()->get('search') : ''}}" type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                        </label>
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </form>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="accordion accordion-boxed box">
                @foreach($data as $key => $item)
                    <div class="accordion-item" id="pochita_accordion_item_{{ $item->id }}">
                        <div id="pochita_accordion_content_{{ $item->id }}" class="accordion-header">
                            <button class="accordion-button" type="button" data-tw-toggle="collapse"
                                    data-tw-target="#pochita_accordion_collapse_{{ $item->id }}"
                                    aria-expanded="true" id="pochita_accordion_item_button_{{ $item->id }}"
                                    aria-controls="pochita_accordion_collapse_{{ $item->id }}">
                                <label>
                                    <input name="permission[]" class="form-check-input checkAll_{{ $item->id }}"
                                           type="checkbox" id="pochita_accordion_item_checkbox_{{ $item->id }}"
                                           value="{{ $item->id }}" {{ !empty($role) && in_array($item->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                </label>
                                {{ $item->name }}
                                <div class="flex float-right">
                                    @can('ms_edit_permission')
                                        <a class="tooltip flex items-center text-warning mr-3" title="Edit {{ $title }}"
                                           href="{{ route('user_management.permission.edit', [$item->id]) }}">
                                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                        </a>
                                    @endcan
                                    @can('ms_delete_permission')
                                        <a class="tooltip flex items-center text-danger" title="Delete {{ $title }}" href="#"
                                           data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                        </a>
                                    @endcan
                                </div>
                            </button>
                        </div>
                        <div id="pochita_accordion_collapse_{{ $item->id }}"
                             class="accordion-collapse collapse show"
                             aria-labelledby="pochita_accordion_content_{{ $item->id }}"
                             data-tw-parent="#pochita_accordion">
                            <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                @if($item->children->count() > 0)
                                    <table class="table" id="pochita_accordion_table">
                                        <tbody id="pochita_accordion_table_body">
                                        @foreach($item->children as $child)
                                            <tr>
                                                <td>
                                                    <input name="permission[]"
                                                           id="permission_{{ $child->id }}"
                                                           class="form-check-input checkboxes_{{ $item->id }} checkboxes-child-{{ $item->id }}"
                                                           type="checkbox" value="{{ $child->id }}" {{ !empty($role) && in_array($child->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <label for="permission_{{ $child->id }}">
                                                                                <span class="bg-success text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-darkmode-800 dark:text-white">
                                                                                    {{$child->name}}
                                                                                </span>
                                                    </label>
                                                </td>
                                                <td class="table-report__action w-56">
                                                    <div class="flex justify-center items-center">
                                                        @can('ms_edit_permission')
                                                            <a class="tooltip flex items-center text-warning mr-3" title="Edit {{ $title }}"
                                                               href="{{ route('user_management.permission.edit', [$item->id]) }}">
                                                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                                            </a>
                                                        @endcan
                                                        @can('ms_delete_permission')
                                                            <a class="tooltip flex items-center text-danger" title="Delete {{ $title }}" href="#"
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
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $data->links('pagination::tailwind') }}
        </div>
        <!-- END: Pagination -->
    </div>
@endsection

@push('css')

@endpush

@push('js')
    <script type="text/javascript">
        window.data = @php echo json_encode( $data ) @endphp;
        $(document).ready(function (){
            $.each(window.data['data'], function (index, item) {
                $('.checkAll_'+item.id).on('click', function () {
                    if (this.checked) {
                        $(".checkboxes_"+item.id).prop("checked", true);
                    } else {
                        $(".checkboxes_"+item.id).prop("checked", false);
                    }
                });
                $(".checkboxes_"+item.id).on('click', function () {
                    if ($(".checkboxes_"+item.id).length === $('.checkboxes_'+item.id+':checked').length) {
                        $(".checkAll_"+item.id).prop("checked", true);
                    } else {
                        $(".checkAll_"+item.id).prop("checked", false);
                    }
                });
            })
        })
    </script>
@endpush
