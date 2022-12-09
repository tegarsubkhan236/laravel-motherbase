@php use Modules\Inventory\Casts\SupplierStatus; @endphp
<form action="#" method="post" id="pochita_form">
    <div class="intro-y box p-5">
        <h2 class="intro-y text-lg font-medium text-center">
            {{ $title }}
        </h2>
        @if( $type == "SEARCH")
            <div class="intro-y col-span-11 alert alert-primary alert-dismissible show flex items-center mb-6 mt-5"
                 role="alert">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         data-lucide="info" class="lucide lucide-info w-4 h-4 mr-2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </span>
                <span>Maximum data that can be displayed is <strong>100</strong> rows</span>
                <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         data-lucide="x" class="lucide lucide-x w-4 h-4">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif
        <label>
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <input type="text" name="type_form" id="type_form" value="SEARCH" hidden>
            <input type="text" name="id" id="id" hidden>
        </label>
        <div class="mt-3">
            <label for="name" class="form-label">Supplier</label>
            <div class="input-group">
                <input name="name" id="name" type="text" value="{{ !empty($item->name) ? $item->name : '' }}"
                       class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="mt-3">
            <label for="cperson" class="form-label">Contact Person</label>
            <div class="input-group">
                <input name="cperson" id="cperson" type="text" value="{{ !empty($item) ? $item->cperson : '' }}"
                       class="form-control" placeholder="Contact Person">
            </div>
        </div>
        <div class="mt-3">
            <label for="address" class="form-label">Address</label>
            <div class="input-group">
                <input name="address" id="address" type="text" value="{{ !empty($item) ? $item->address : '' }}"
                       class="form-control" placeholder="Address">
            </div>
        </div>
        <div class="mt-3">
            <label for="contact" class="form-label">Phone</label>
            <div class="input-group">
                <input name="contact" id="contact" type="text" value="{{ !empty($item) ? $item->contact : '' }}"
                       class="form-control" placeholder="Contact">
            </div>
        </div>
        <div class="mt-3">
            <label for="status">Active Status</label>
            <div class="form-check mt-2">
                <input id="status" class="form-check-input" type="radio" name="status"
                       value="{{ SupplierStatus::ACTIVE }}" {{ !empty($item) && $item->status == SupplierStatus::ACTIVE ? 'checked' : '' }}>
                <label class="form-check-label" for="status">{{ SupplierStatus::lang(1) }}</label>
            </div>
            <div class="form-check mt-2">
                <input id="status" class="form-check-input" type="radio" name="status"
                       value="{{ SupplierStatus::INACTIVE }}" {{ !empty($item) && $item->status == SupplierStatus::INACTIVE ? 'checked' : '' }}>
                <label class="form-check-label" for="status">{{ SupplierStatus::lang(0) }}</label>
            </div>
        </div>
        <div class="text-right mt-5">
            <button type="button" class="btn btn-outline-secondary w-24 mr-1" id="reset_form">Reset</button>
            <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
        </div>
    </div>
</form>
