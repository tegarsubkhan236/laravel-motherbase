@php use Modules\Inventory\Casts\ReceiveFromOrder @endphp
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
            <label for="date_range">Date</label>
            <input type="text" name="date_range" id="date_range" data-daterange="true" class="datepicker form-control block mx-auto">
        </div>
        <div class="mt-3">
            <label for="from_order">Type</label>
            <select name="from_order" id="from_order" class="form-control">
                <option value="0">-- Select Type --</option>
                <option value="{{ ReceiveFromOrder::PO }}">{{ ReceiveFromOrder::lang(1) }}</option>
                <option value="{{ ReceiveFromOrder::BO }}">{{ ReceiveFromOrder::lang(2) }}</option>
            </select>
        </div>

        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
        </div>
    </div>
</form>
