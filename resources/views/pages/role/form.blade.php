@extends('layouts.app')

@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{ empty($role) ? 'Add New' : 'Edit' }} {{ $title }}
        </h2>
    </div>
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form
                action="{{ !empty($role) ? route('user_management.role.update', $role->id) : route('user_management.role.store')}}"
                method="post">
                @csrf
                @if(!empty($role))
                    @method('PUT')
                @endif
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group">
                            <input name="name" id="name" type="text" value="{{ !empty($role) ? $role->name : '' }}"
                                   class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Permission</label>
                        <div class="grid grid-cols-12 mt-5">
                            <!-- BEGIN: Data List -->
                            <div class="col-span-12 overflow-auto 2xl:overflow-visible">
                                <div class="accordion accordion-boxed">
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
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        </a>
                        @can('ms_create_role' || 'ms_edit_role')
                        <button type="submit" class="btn btn-primary w-24">{{ !empty($role) ? 'Update' : 'Save' }}</button>
                        @endcan
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script type="text/javascript">
        window.data = <?php echo json_encode( $data ) ?>;
        $(document).ready(function (){
            $.each(window.data, function (index, item) {
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
