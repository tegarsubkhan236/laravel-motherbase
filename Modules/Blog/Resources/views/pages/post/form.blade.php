@extends('layouts.app')

@section('content')
    <form action="{{ route('blog.post.store') }}" method="POST">
        @csrf
        @include('vendor.alert.basic')
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Add New Post
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <button type="button" class="btn box mr-2 flex items-center ml-auto sm:ml-0">
                    <i class="w-4 h-4 mr-2" data-lucide="eye"></i> Preview
                </button>
                <button type="submit" class="btn btn-primary shadow-md flex items-center">
                    Save <i class="w-4 h-4 ml-2" data-lucide="chevron-down"></i>
                </button>
            </div>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: Post Content -->
            <div class="intro-y col-span-12 lg:col-span-8">
                <label>
                    <input name="title" type="text" class="intro-y form-control py-3 px-4 box pr-10"
                           placeholder="Title">
                </label>
                <div class="post intro-y overflow-hidden box mt-5">
                    <ul class="post__tabs nav nav-tabs flex-col sm:flex-row bg-slate-200 dark:bg-darkmode-800"
                        role="tablist">
                        <li class="nav-item">
                            <button type="button" title="Fill in the article content" data-tw-toggle="tab" data-tw-target="#content"
                                    class="nav-link tooltip w-full sm:w-40 py-4 active" id="content-tab" role="tab"
                                    aria-controls="content" aria-selected="true">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Content
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" title="Adjust the meta title" data-tw-toggle="tab" data-tw-target="#meta-title"
                                    class="nav-link tooltip w-full sm:w-40 py-4" id="meta-title-tab" role="tab"
                                    aria-selected="false">
                                <i data-lucide="code" class="w-4 h-4 mr-2"></i> Meta Title
                            </button>
                        </li>
                    </ul>
                    <div class="post__content tab-content">
                        <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div
                                    class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                    <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Text Content
                                </div>
                                <div class="mt-5">
                                    <label for="editor">
                                        <textarea name="content" id="editor" cols="30" rows="10" class="editor">
                                            {{ old('content') }}
                                        </textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="meta-title" class="tab-pane p-5" role="tabpanel" aria-labelledby="meta-title-tab">
                            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                    <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Meta Title
                                </div>
                                <div class="mt-5">
                                    <label>
                                        <input name="meta_title" type="text" class="intro-y form-control py-3 px-4 box pr-10" placeholder="Meta Title">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Post Content -->
            <!-- BEGIN: Post Info -->
            <div class="col-span-12 lg:col-span-4">
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label" for="written_by">Written By</label>
                        <select name="written_by" data-placeholder="Select categories" class="tom-select w-full" id="written_by">
                            @hasrole('SUPER ADMIN')
                                @foreach($written_by as $item)
                                <option value="{{ $item->id }}">&#128102; {{ $item->name }}</option>
                                @endforeach
                            @else
                                <option value="{{ $written_by['id'] }}" selected>&#128102; {{ $written_by['name'] }}</option>
                            @endhasrole
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="created_at" class="form-label">Post Date</label>
                        <input name="created_at" type="text" class="datepicker form-control" id="created_at" data-single-mode="true">
                    </div>
                    <div class="mt-3">
                        <label for="categories" class="form-label">Categories</label>
                        <select name="categories[]" data-placeholder="Select categories" class="tom-select w-full" id="categories" multiple>
                            @foreach($categories as $category)
                                <optgroup label="{{ $category->title }}">
                                    @if($category->children->count() > 0)
                                        @foreach($category->children as $child)
                                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch flex flex-col items-start mt-3">
                        <label for="published" class="form-check-label ml-0 mb-2">Published</label>
                        <input name="published" id="published" class="form-check-input" type="checkbox" checked>
                    </div>
                </div>
            </div>
            <!-- END: Post Info -->
        </div>
    </form>
@endsection

@push('css')

@endpush

@push('js')
    <script src="{{ asset('dashboardAsset/dist/js/ckeditor-classic.js') }}"></script>
@endpush
