@php use Modules\Inventory\Casts\ItemStatus @endphp
<form action="#" method="post" id="pochita_form">
    @csrf
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
            <label for="supplier">Supplier</label>
            <select name="supplier" id="supplier" class="form-control tom-select">
                <option value="">-- Select Supplier --</option>
                @foreach($supplier as $x)
                    <option value="{{ $x->id }}" {{ !empty($item) && in_array($x->toArray(), $item->inv_supplier->toArray()) ? 'selected' : '' }}>{{ $x->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="name" class="whitespace-nowrap">Item Name</label>
            <input name="name" id="name" type="text" value="{{ !empty($item) ? $item->name : '' }}" class="form-control" placeholder="Item Name">
        </div>
        <div class="mt-3">
            <label for="unit" class="whitespace-nowrap">Item Unit</label>
            <input name="unit" id="unit" type="text" value="{{ !empty($item) ? $item->unit : '' }}" class="form-control" placeholder="Item Unit">

        </div>
        <div class="mt-3">
            <label for="description" class="whitespace-nowrap">Description</label>
            <textarea name="description" id="description" cols="10" rows="5" class="form-control" placeholder="Description">{!! !empty($item) ? $item->description : '' !!}</textarea>
        </div>
        <div class="mt-3">
            <label for="cost" class="whitespace-nowrap">Cost</label>
            <input name="cost" id="cost" type="number" value="{{ !empty($item) ? $item->cost : '' }}" class="form-control" placeholder="Cost">
        </div>
        <div class="mt-3">
            <label for="status">Active Status</label>
            <div class="form-check mt-2">
                <input id="status-1" class="form-check-input" type="radio" name="status"
                       value="{{ ItemStatus::ACTIVE }}" {{ !empty($item) && $item->status == ItemStatus::ACTIVE ? 'checked' : '' }}>
                <label class="form-check-label" for="status-1">{{ ItemStatus::lang(1) }}</label>
            </div>
            <div class="form-check mt-2">
                <input id="status-0" class="form-check-input" type="radio" name="status"
                       value="{{ ItemStatus::INACTIVE }}" {{ !empty($item) && $item->status == ItemStatus::INACTIVE ? 'checked' : '' }}>
                <label class="form-check-label" for="status-0">{{ ItemStatus::lang(0) }}</label>
            </div>
        </div>
        <div class="text-right mt-5">
            <button type="button" class="btn btn-outline-secondary w-24 mr-1" id="reset_form">Reset</button>
            <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
        </div>
    </div>
</form>
