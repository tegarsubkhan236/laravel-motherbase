<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        @if($errors->any())
            {!! implode('', $errors->all('
                <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                    :message
                    <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>'))
            !!}
        @endif

        @if(session()->has("success"))
            <div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert">
                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2 text-white"></i>
                <p class="text-white">{!! session()->get('success') !!}</p>
                <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
    </div>
</div>
