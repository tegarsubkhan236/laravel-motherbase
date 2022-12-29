@php
    use Modules\Inventory\Casts\PoStatus;
@endphp
<form action="#" method="post" id="pochita_form">
    <div class="intro-y box p-5">
        <h2 class="intro-y text-lg font-medium text-center">
            {{ $title }}
        </h2>
        <label>
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <input type="text" name="type_form" id="type_form" value="SEARCH" hidden>
        </label>
        <div class="mt-3">
            <label>Date</label>
            <input type="text" name="date_range" id="date_range" data-daterange="true" class="datepicker form-control block mx-auto">
        </div>
        <div class="mt-3">
            <label>Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control">
                <option value="">-- Select Supplier --</option>
                @foreach($supplier as $x)
                    <option value="{{ $x->id }}">{{ $x->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label>PO Code</label>
            <input type="text" name="po_code" id="po_code" class="form-control block mx-auto">
        </div>
        <div class="mt-3">
            <label>BO Code</label>
            <input type="text" name="bo_code" id="bo_code" class="form-control block mx-auto">
        </div>
        <div class="mt-3">
            <label>Status PO</label>
            <div class="form-check mt-2">
                <input id="status-{{ PoStatus::CREATED }}" class="form-check-input" type="radio" name="status" value="{{ PoStatus::CREATED }}">
                <label class="form-check-label" for="status-{{ PoStatus::CREATED }}">{{ PoStatus::lang(1) }}</label>
            </div>
            <div class="form-check mt-2">
                <input id="status-{{ PoStatus::PARTIAL_RECEIVE }}" class="form-check-input" type="radio" name="status" value="{{ PoStatus::PARTIAL_RECEIVE }}">
                <label class="form-check-label" for="status-{{ PoStatus::PARTIAL_RECEIVE }}">{{ PoStatus::lang(3) }}</label>
            </div>
        </div>

        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
        </div>
    </div>
</form>
