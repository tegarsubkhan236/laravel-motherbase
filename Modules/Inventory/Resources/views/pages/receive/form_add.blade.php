@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 xl:col-span-12">
            <form action="#" method="post" id="pochita_form">
                @csrf
                <div class="box p-5">
                    <div class="flex flex-wrap">
                        <h2 class="text-lg font-medium">
                            {{ $title }}
                        </h2>
                        <a href="{{ route('inventory.receive.index') }}" class="ml-auto">
                            <button type="button" class="btn btn-outline-primary w-24">Back</button>
                        </a>
                    </div>

                    {{--PO MASTER--}}
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-6 xl:col-span-6">
                            <div class="mt-3">
                                <label for="po_code" class="form-label">PO Code</label>
                                <div class="input-group w-full">
                                    <div class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="16 18 22 12 16 6"></polyline>
                                            <polyline points="8 6 2 12 8 18"></polyline>
                                        </svg>
                                    </div>
                                    <input name="po_code" id="po_code" type="text" value="{{ $item->po_code }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="supplier_id">Supplier</label>
                                <div class="input-group w-full">
                                    <div class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <input name="supplier_name" type="text" value="{{ $item->inv_supplier->name }}" class="form-control" disabled>
                                    <input name="supplier_id" type="hidden" value="{{ $item->inv_supplier->id }}" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="remarks" class="whitespace-nowrap">Remarks</label>
                                <textarea name="remarks" id="remarks" cols="5" rows="2" class="form-control" placeholder="Remarks" disabled>{!! $item->description !!}</textarea>
                            </div>
                        </div>
                        <div class="col-span-6 xl:col-span-6">
                            <div class="mt-3">
                                <label class="form-label">Discount</label>
                                {{--NOMINAL--}}
                                <div class="form-check mt-2">
                                    <label class="form-check-label">Nominal</label>
                                    <div class="input-group w-full">
                                        <div class="input-group-text ml-8">Rp</div>
                                        <input name="discount_nominal_show" type="text" value="{{ number_format($item->discount,0,',','.') }}" class="form-control" disabled>
                                        <input name="discount_nominal_value" type="hidden" value="{{ $item->discount }}">
                                    </div>
                                </div>
                                {{--PERCENTAGE--}}
                                <div class="form-check mt-2">
                                    <label class="form-check-label">Percentage</label>
                                    <div class="input-group w-full">
                                        <input name="discount_percentage_show" type="text" value="{{ number_format($item->discount_perc,0,',','.') }}" class="form-control ml-4" disabled>
                                        <input name="discount_percentage_value" type="hidden" value="{{ $item->discount_perc }}">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Tax</label>
                                {{--NOMINAL--}}
                                <div class="form-check mt-2">
                                    <label class="form-check-label">Nominal</label>
                                    <div class="input-group w-full">
                                        <div class="input-group-text ml-8">Rp</div>
                                        <input name="tax_nominal_show" type="text" value="{{ number_format($item->tax,0,',','.') }}" class="form-control" disabled>
                                        <input name="tax_nominal_value" type="hidden" value="{{ $item->tax }}">
                                    </div>
                                </div>
                                {{--PERCENTAGE--}}
                                <div class="form-check mt-2">
                                    <label class="form-check-label">Percentage</label>
                                    <div class="input-group w-full">
                                        <input name="tax_percentage_show" type="text" value="{{ number_format($item->tax_perc,0,',','.') }}" class="form-control ml-4" disabled>
                                        <input name="tax_percentage_value" type="hidden" value="{{ $item->tax_perc }}">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--PO CHILDREN--}}
                    <div class="w-full mt-10 flex-1">
                        <div class="overflow-x-auto">
                            <table class="table border" id="pochita_item_table">
                                <thead>
                                <tr>
                                    <th class="!pr-2 bg-slate-50 dark:bg-darkmode-800"></th>
                                    <th class="bg-slate-50 dark:bg-darkmode-800">Item in Supplier</th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">QTY</th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">Price</th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">Total</th>
                                </tr>
                                </thead>
                                <tbody id="pochita_item_table_body">
                                    @foreach($item->inv_po_item as $key => $po_item)
                                    <tr>
                                        <td class="!pr-2">{{ $key+1 }}</td>
                                        <td class="!px-2 w-72">
                                            <div class="input-group w-full">
                                                <div class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="3" y="14" width="7" height="7"></rect>
                                                        <rect x="3" y="3" width="7" height="7"></rect>
                                                        <line x1="14" y1="4" x2="21" y2="4"></line>
                                                        <line x1="14" y1="9" x2="21" y2="9"></line>
                                                        <line x1="14" y1="15" x2="21" y2="15"></line>
                                                        <line x1="14" y1="20" x2="21" y2="20"></line>
                                                    </svg>
                                                </div>
                                                <input name="item_name[]" id="item_name" type="text" value="{{ $po_item->inv_item->name }}" class="form-control" disabled>
                                            </div>
                                            <input type="hidden" name="item_id[]" id="item_id" value="{{ $po_item->inv_item->id }}">
                                        </td>
                                        <td class="!px-2">
                                            <div class="input-group">
                                                <input type="number" name="qty[]" id="qty" value="{{ $po_item->quantity }}" class="form-control min-w-[3rem]">
                                                <div class="input-group-text" id="unit">{{ $po_item->inv_item->unit }}</div>
                                            </div>
                                        </td>
                                        <td class="!px-2">
                                            <div class="input-group">
                                                <div class="input-group-text">Rp. </div>
                                                <input type="text" name="price_show[]" id="price_show" value="{{ number_format($po_item->price,0,',','.') }}" class="form-control min-w-[3rem]" disabled>
                                                <input type="hidden" name="price_value[]" id="price_value" value="{{ $po_item->price }}">
                                            </div>
                                        </td>
                                        <td class="!px-2">
                                            <div class="input-group">
                                                <div class="input-group-text">Rp. </div>
                                                <input type="text" name="total[]" id="total" value="{{ number_format(($po_item->price * $po_item->quantity),0,',','.') }}" class="form-control min-w-[3rem] total_qty_price" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th colspan="6">
                                        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
                                            <div class="text-center sm:text-left mt-10 sm:mt-0">
                                                <div class="text-base text-slate-500">Sub Total</div>
                                                <div class="text-base text-slate-500">Disc</div>
                                                <div class="text-base text-slate-500">Tax</div>
                                                <div class="text-lg text-primary font-medium mt-2">Grand Total</div>
                                            </div>
                                            <div class="text-center sm:text-right sm:ml-auto">
                                                <div class="text-base text-slate-500 whitespace-nowrap" id="sub_total_show">Rp. 0</div>
                                                <input type="hidden" name="sub_total_value" id="sub_total_value">

                                                <div class="text-base text-slate-500 whitespace-nowrap" id="total_discount_show">Rp. 0</div>
                                                <input type="hidden" name="total_discount_value" id="total_discount_value">

                                                <div class="text-base text-slate-500 whitespace-nowrap" id="total_tax_show">Rp. 0</div>
                                                <input type="hidden" name="total_tax_value" id="total_tax_value">

                                                <div class="text-xl text-primary font-medium mt-2" id="grand_total_show">Rp. 0</div>
                                                <input type="hidden" name="grand_total_value" id="grand_total_value">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24" id="pochita_submit_form">{{ $button_title }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2()
            sub_total()
            disc()
            tax()
            grand_total()

            $(this).on('keyup', '#qty', delay(function () {
                total(this)
                sub_total()
                disc()
                tax()
                grand_total()
            }, 1000));

            $('#pochita_form').on('submit', function (ev) {
                ev.preventDefault()
                let data = $(this).serializeArray();
                $.ajax({
                    url: "/inventory/receive/"+{{ $item->id }}+"/"+"{{ $type }}"+"/store",
                    type: 'post',
                    data: data,
                    beforeSend: function () {
                        run_waitMe($('#pochita_form'), 1, 'facebook');
                    },
                    success: function (data) {
                        console.log(data)
                        Swal.fire({
                            icon: 'success',
                            title: 'Created !',
                            text: 'Purchase Order with code '+ data.code +'has been created',
                            showConfirmButton: true,
                        })
                        $('#pochita_submit_form').prop('disabled', true)
                        $('#pochita_form').find("input,textarea,select").prop("disabled", true);
                        $("#pochita_item_table").find("input,button,textarea,select").prop("disabled", true);
                        $('#pochita_form').waitMe('hide');
                    },
                    error: function (e) {
                        if (e.status === 400){
                            if ('errors' in e.responseJSON) {
                                let error = "<ul class='text-left'>";
                                $.each(e.responseJSON.errors, function (i, val) {
                                    error += '<li>' + val + '</li>'
                                })
                                error += "</ul>";
                                Swal.fire({
                                    icon: 'error',
                                    title: e.statusText,
                                    html: error,
                                    showConfirmButton: true,
                                })
                            } else if ('error' in e.responseJSON) {
                                Swal.fire({
                                    icon: 'error',
                                    title: e.statusText,
                                    html: e.responseJSON.error,
                                    showConfirmButton: true,
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unhandle error',
                                    showConfirmButton: true,
                                })
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unhandle error',
                                showConfirmButton: true,
                            })
                        }
                        $('#pochita_form').waitMe('hide');
                    }
                })
            })
        })

        function total(element) {
            let child = $(element).closest('tr')

            let price_element = child.find('#price_value').val()
            let qty_element = child.find('#qty').val()
            if (!qty_element || !price_element) {
                child.find('#total').val(0)
                return 0
            } else {
                let total = parseInt(qty_element) * parseInt(price_element)
                child.find('#total').val(formatRupiah(total))
                return total
            }
        }

        function sub_total() {
            let subTotal = 0

            $(".total_qty_price").each(function () {
                subTotal += total(this)
            });
            $('#sub_total_value').val(subTotal)
            $('#sub_total_show').text('Rp. ' + formatRupiah(subTotal))
            return subTotal
        }

        function disc() {
            let nominal = $('input[name="discount_nominal_value"]')
            let disc = parseInt(nominal.val())
            $('#total_discount_value').val(disc)
            $('#total_discount_show').text('Rp. ' + formatRupiah(disc))
            return disc
        }

        function tax() {
            let nominal = $('input[name="tax_nominal_value"]')
            let tax = parseInt(nominal.val())
            $('#total_tax_value').val(tax)
            $('#total_tax_show').text('Rp. ' + formatRupiah(tax))
            return tax
        }

        function grand_total() {
            let grandTotal
            grandTotal = (sub_total() - disc()) + tax()
            $('#grand_total_value').val(grandTotal)
            $('#grand_total_show').text('Rp. ' + formatRupiah(grandTotal))
        }

        function formatRupiah(num) {
            let str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 1,
                formatted;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (let j = 0, len = str.length; j < len; j++) {
                if (str[j] !== ",") {
                    output.push(str[j]);
                    if (i % 3 === 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        }
    </script>
@endpush
