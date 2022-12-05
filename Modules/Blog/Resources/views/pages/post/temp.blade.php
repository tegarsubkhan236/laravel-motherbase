{{--Keywords--}}
<li class="nav-item">
    <button title="Use search keywords" data-tw-toggle="tab" data-tw-target="#keywords"
            class="nav-link tooltip w-full sm:w-40 py-4" id="keywords-tab" role="tab"
            aria-selected="false">
        <i data-lucide="align-left" class="w-4 h-4 mr-2"></i> Keywords
    </button>
</li>

{{--Caption & Images--}}
<div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
    <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
        <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Caption & Images
    </div>
    <div class="mt-5">
        <div>
            <label for="post-form-7" class="form-label">Caption</label>
            <input id="post-form-7" type="text" class="form-control" placeholder="Write caption">
        </div>
        <div class="mt-3">
            <label class="form-label">Upload Image</label>
            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                <div class="flex flex-wrap px-4">
                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/preview-5.jpg') }}">
                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/preview-9.jpg') }}">
                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/preview-15.jpg') }}">
                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('dashboardAsset/dist/images/preview-6.jpg') }}">
                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                    <span class="text-primary mr-1">Upload a file</span> or drag and drop
                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                </div>
            </div>
        </div>
    </div>
</div>

{{--Tags Input--}}
<div class="mt-3">
    <label for="post-form-4" class="form-label">Tags</label>
    <select data-placeholder="Select your favorite actors" class="tom-select w-full" id="post-form-4" multiple>
        <option value="1" selected>Leonardo DiCaprio</option>
        <option value="2">Johnny Deep</option>
        <option value="3" selected>Robert Downey, Jr</option>
        <option value="4">Samuel L. Jackson</option>
        <option value="5">Morgan Freeman</option>
    </select>
</div>

{{--Show Author Name--}}
<div class="form-check form-switch flex flex-col items-start mt-3">
    <label for="post-form-6" class="form-check-label ml-0 mb-2">Show Author Name</label>
    <input id="post-form-6" class="form-check-input" type="checkbox">
</div>
