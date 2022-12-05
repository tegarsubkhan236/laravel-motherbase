@extends('layouts.app')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{ $title }}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('blog.post.create') }}">
                <button class="btn btn-primary shadow-md mr-2">Add New Post</button>
            </a>
        </div>
    </div>
    @include('vendor.alert.basic')
    <div class="intro-y grid grid-cols-12 gap-6 mt-5">
        @forelse($data as $item)
            <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                    <div class="w-10 h-10 flex-none image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboardAsset/dist/images/profile-1.jpg') }}">
                    </div>
                    <div class="ml-3 mr-auto">
                        <a href="" class="font-medium">{{ $item->user->name }}</a>
                        <div class="flex-col text-slate-500 truncate text-xs mt-0.5">
                            <a class="text-primary inline-block tooltip truncate" title="Another Category = @php foreach ($item->blog_post_categories as $category) echo "$category->title | " @endphp" href="">
                                {{ $item->blog_post_categories[0]->title }}
                            </a>

                            <span class="mx-1">•</span> {{ \Carbon\Carbon::parse($item->updatedAt)->diffForHumans() }}
                        </div>
                    </div>
                    <div class="dropdown ml-3">
                        <a href="#" class="dropdown-toggle w-5 h-5 text-slate-500" aria-expanded="false"
                           data-tw-toggle="dropdown"> <i data-lucide="more-vertical" class="w-4 h-4"></i> </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit Post
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="trash" class="w-4 h-4 mr-2"></i>Delete Post
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <div class="h-40 2xl:h-56 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{ asset('dashboardAsset/dist/images/preview-12.jpg') }}">
                    </div>
                    <a href="" class="block font-medium text-base mt-5">{{$item->title}}</a>
                    <div class="text-slate-600 dark:text-slate-500 mt-2">
                        {!! Str::limit($item->content, 200, ' ...') !!}
                    </div>
                </div>
                <div class="flex items-center px-5 py-3 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a href=""
                       class="intro-x w-8 h-8 flex items-center justify-center rounded-full border border-slate-300 dark:border-darkmode-400 dark:bg-darkmode-300 dark:text-slate-300 text-slate-500 mr-2 tooltip"
                       title="Bookmark"> <i data-lucide="bookmark" class="w-3 h-3"></i> </a>
                    <div class="intro-x flex mr-2">
                        <div class="intro-x w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full border border-white zoom-in tooltip"
                                 src="{{ asset('dashboardAsset/dist/images/profile-1.jpg') }}" title="Arnold Schwarzenegger">
                        </div>
                        <div class="intro-x w-8 h-8 image-fit -ml-4">
                            <img alt="Midone - HTML Admin Template" class="rounded-full border border-white zoom-in tooltip"
                                 src="{{ asset('dashboardAsset/dist/images/profile-12.jpg') }}" title="Nicolas Cage">
                        </div>
                        <div class="intro-x w-8 h-8 image-fit -ml-4">
                            <img alt="Midone - HTML Admin Template" class="rounded-full border border-white zoom-in tooltip"
                                 src="{{ asset('dashboardAsset/dist/images/profile-4.jpg') }}" title="Catherine Zeta-Jones">
                        </div>
                    </div>
                    <a href=""
                       class="intro-x w-8 h-8 flex items-center justify-center rounded-full text-primary bg-primary/10 dark:bg-darkmode-300 dark:text-slate-300 ml-auto tooltip"
                       title="Share"> <i data-lucide="share-2" class="w-3 h-3"></i> </a>
                    <a href=""
                       class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white ml-2 tooltip"
                       title="Download PDF"> <i data-lucide="share" class="w-3 h-3"></i> </a>
                </div>
                <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="w-full flex text-slate-500 text-xs sm:text-sm">
                        <div class="mr-2"> Comments: <span class="font-medium">21</span></div>
                        <div class="mr-2"> Views: <span class="font-medium">106k</span></div>
                        <div class="ml-auto"> Likes: <span class="font-medium">41k</span></div>
                    </div>
                    <div class="w-full flex items-center mt-3">
                        <div class="w-8 h-8 flex-none image-fit mr-3">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboardAsset/dist/images/profile-1.jpg') }}">
                        </div>
                        <div class="flex-1 relative text-slate-600">
                            <label>
                                <input type="text"
                                       class="form-control form-control-rounded border-transparent bg-slate-100 pr-10"
                                       placeholder="Post a comment...">
                            </label>
                            <i data-lucide="smile" class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"></i>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="intro-y col-span-12 md:col-span-12 xl:col-span-12 box">
                <h2 class="text-lg font-medium mr-auto text-center">
                    Data not available
                </h2>
            </div>
        @endforelse
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $data->links('pagination::tailwind') }}
        </div>
    </div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
