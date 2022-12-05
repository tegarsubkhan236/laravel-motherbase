@extends('layouts.app')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{ $title }}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('blog.category.create') }}">
                <button class="btn btn-primary shadow-md mr-2">Add New {{ $title }}</button>
            </a>
        </div>
    </div>
    @include('vendor.alert.basic')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 overflow-auto 2xl:overflow-visible">
            <div class="accordion accordion-boxed">
                @foreach($data as $key => $item)
                    <div class="accordion-item">
                        <div id="pochita_accordion_content_{{ $item->slug }}"
                             class="accordion-header flex flex-col sm:flex-row items-center">
                            <button class="accordion-button flex item-center" type="button" data-tw-toggle="collapse"
                                    data-tw-target="#pochita_accordion_collapse_{{ $item->slug }}"
                                    aria-expanded="true"
                                    aria-controls="pochita_accordion_collapse_{{ $item->slug }}">
                                <b>{{ $item->title }}</b>
                            </button>
                            @can('blog_category_edit')
                                <a class="tooltip flex items-center text-warning" title="Edit {{ $title }}"
                                   href="{{ route('blog.category.edit', [$item->slug]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                </a>
                            @endcan
                            @can('blog_category_delete')
                                <a class="tooltip flex items-center text-danger" title="Delete {{ $title }}" href="#"
                                   data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                </a>
                            @endcan
                        </div>
                        <div id="pochita_accordion_collapse_{{ $item->slug }}"
                             class="accordion-collapse collapse show"
                             aria-labelledby="pochita_accordion_content_{{ $item->slug }}"
                             data-tw-parent="#pochita_accordion">
                            <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                @if($item->children->count() > 0)
                                    <table class="table table-report ">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($item->children as $child)
                                            <tr>
                                                <td>{{$child->title}}</td>
                                                <td>{{$child->slug}}</td>
                                                <td>
                                                    <div class="flex items-center">
                                                        @can('blog_category_edit')
                                                            <a class="tooltip flex items-center text-warning mr-3"
                                                               title="Edit {{ $title }}"
                                                               href="{{ route('blog.category.edit', [$child->slug]) }}">
                                                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                                            </a>
                                                        @endcan
                                                        @can('blog_category_delete')
                                                            <a class="tooltip flex items-center text-danger"
                                                               title="Delete {{ $title }}" href="#"
                                                               data-tw-toggle="modal"
                                                               data-tw-target="#delete-confirmation-modal">
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
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
@endpush
