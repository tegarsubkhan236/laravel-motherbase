@php use Modules\Inventory\Casts\StockType @endphp
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
        <div class="mt-3">
            <label for="item_id">Item</label>
            <select name="item_id" id="item_id" class="form-control tom-select">
                <option value="">-- Select Item --</option>
                @foreach($items as $x)
                    <option value="{{ $x->id }}" {{ !empty($item) && in_array($x->toArray(), $item->inv_item->toArray()) ? 'selected' : '' }}>{{ $x->name }}</option>
                @endforeach
            </select>
        </div>
        @if( $type == "FILTER")
            <div class="mt-3">
                <label for="date_range">Date</label>
                <input type="text" name="date_range" id="date_range" data-daterange="true" class="datepicker form-control block mx-auto">
            </div>
        @endif
        @if( $type == "ADJUSTMENT")
            <div class="mt-3">
                <label for="quantity" class="whitespace-nowrap">Quantity</label>
                <input name="quantity" id="quantity" type="text" value="{{ !empty($item) ? $item->quantity : '' }}" class="form-control" placeholder="Quantity">
            </div>
        @endif
        <div class="mt-3">
            <label for="type">Stock Type</label>
            @if( $type == "FILTER")
                <div class="form-check mt-2">
                    <input id="type-1" class="form-check-input" type="radio" name="type"
                           value="{{ StockType::IN }}" {{ !empty($item) && $item->type == StockType::IN ? 'checked' : '' }}>
                    <label class="form-check-label" for="type-1">{{ StockType::lang(1) }}</label>
                </div>
                <div class="form-check mt-2">
                    <input id="type-2" class="form-check-input" type="radio" name="type"
                           value="{{ StockType::OUT }}" {{ !empty($item) && $item->type == StockType::OUT ? 'checked' : '' }}>
                    <label class="form-check-label" for="type-2">{{ StockType::lang(2) }}</label>
                </div>
            @endif
            <div class="form-check mt-2">
                <input id="type-3" class="form-check-input" type="radio" name="type"
                       value="{{ StockType::ADJUSMENT_MIN }}" {{ !empty($item) && $item->type == StockType::ADJUSMENT_MIN ? 'checked' : '' }}>
                <label class="form-check-label" for="type-3">{{ StockType::lang(3) }}</label>
            </div>
            <div class="form-check mt-2">
                <input id="type-4" class="form-check-input" type="radio" name="type"
                       value="{{ StockType::ADJUSMENT_PLUS }}" {{ !empty($item) && $item->type == StockType::ADJUSMENT_PLUS ? 'checked' : '' }}>
                <label class="form-check-label" for="type-4">{{ StockType::lang(4) }}</label>
            </div>
        </div>
        <div class="text-right mt-5">
            <button type="button" class="btn btn-outline-secondary w-24 mr-1" id="reset_form">Reset</button>
            <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
        </div>
    </div>
</form>
