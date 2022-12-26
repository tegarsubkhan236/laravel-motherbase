
<form action="#" method="post" id="pochita_form">
    <div class="intro-y box p-5">
        <h2 class="intro-y text-lg font-medium text-center">
            {{ $title }}
        </h2>
        <label>
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            <input type="text" name="type_form" id="type_form" value="SEARCH" hidden>
            <input type="text" name="id" id="id" hidden>
        </label>
        @if( $type == "SEARCH")
            <div class="mt-3">
                <label for="po_code" class="form-label">PO Code</label>
                <div class="input-group">
                    <input name="po_code" id="po_code" type="text" value="{{ !empty($item) ? $item->po_code : '' }}" class="form-control" placeholder="PO Code">
                </div>
            </div>
            <div class="mt-3">
                <label for="date_range">Date</label>
                <input type="text" name="date_range" id="date_range" data-daterange="true" class="datepicker form-control block mx-auto">
            </div>
        @endif
        @if( $type == "ADD" || $type == "EDIT")
            <div class="mt-3">
                <label for="po_code" class="form-label">PO Code</label>
                <div class="input-group">
                    <input name="po_code" id="po_code" type="text" value="{{ !empty($item) ? $item->po_code : '' }}" class="form-control" placeholder="PO Code Auto Generated" disabled>
                </div>
            </div>
        @endif
        <div class="mt-3">
            <label for="supplier_id">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control">
                <option value="">-- Select Supplier --</option>
                @foreach($supplier as $x)
                    <option value="{{ $x->id }}" {{ !empty($item) && in_array($x->toArray(), $item->inv_supplier->toArray()) ? 'selected' : '' }}>{{ $x->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-right mt-5">
            <button type="button" class="btn btn-outline-secondary w-24 mr-1" id="reset_form">Reset</button>
            <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
        </div>
    </div>
</form>
