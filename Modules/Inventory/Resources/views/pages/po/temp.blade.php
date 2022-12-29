<div class="col-span-6 xl:col-span-6">
    <div class="mt-3">
        <label for="discount" class="form-label">Discount</label>
        <div class="input-group w-full">
            <input name="discount_percentage" value="{{ $item->discount_perc }}" type="number" class="form-control">
            <div class="input-group-text">%</div>
        </div>
    </div>
    <div class="mt-3">
        <label for="tax" class="form-label">Tax</label>
        <div class="input-group w-full">
            <input name="tax_percentage" value="{{ $item->tax_perc }}" type="number" class="form-control">
            <div class="input-group-text">%</div>
        </div>
    </div>
</div>
