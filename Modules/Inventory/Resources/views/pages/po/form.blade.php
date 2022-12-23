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
                        <a href="{{ route('inventory.po.index') }}" class="ml-auto">
                            <button type="button" class="btn btn-outline-primary w-24">Back</button>
                        </a>
                    </div>

                    {{--PO MASTER--}}
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-6 xl:col-span-6">
                            <div class="mt-3">
                                <label for="po_code" class="form-label">PO Code</label>
                                <div class="input-group">
                                    <input name="po_code" id="po_code" type="text"
                                           value="{{ !empty($item) ? $item->po_code : '' }}" class="form-control"
                                           placeholder="PO Code Auto Generated" disabled>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="supplier_id">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control tom-select">
                                    <option value="">-- Select Supplier --</option>
                                    @foreach($supplier as $x)
                                        <option value="{{ $x->id }}">{{ $x->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="remarks" class="whitespace-nowrap">Remarks</label>
                                <textarea name="remarks" id="remarks" cols="5" rows="2" class="form-control"
                                          placeholder="Remarks">{!! !empty($item) ? $item->description : '' !!}</textarea>
                            </div>
                        </div>
                        <div class="col-span-6 xl:col-span-6">
                            <div class="mt-3">
                                <label for="discount" class="form-label">Discount</label>
                                <div class="form-check mt-2">
                                    <input id="discount_nominal" class="form-check-input" type="radio" name="discount"
                                           value="discount_nominal">
                                    <label class="form-check-label" for="discount_nominal">Nominal</label>

                                    <div class="input-group w-full" id="discount_nominal_input" style="display: none">
                                        <input name="discount_nominal" type="number" class="form-control ml-8"
                                               placeholder="Discount Nominal">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                </div>
                                <div class="form-check mt-2">
                                    <input id="discount_percentage" class="form-check-input" type="radio"
                                           name="discount" value="discount_percentage">
                                    <label class="form-check-label" for="discount_percentage">Percentage</label>

                                    <div class="input-group w-full" id="discount_percentage_input"
                                         style="display: none">
                                        <input name="discount_percentage" type="number" class="form-control ml-4"
                                               placeholder="Discount Percentage">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="tax" class="form-label">Tax</label>
                                <div class="form-check mt-2">
                                    <input id="tax_nominal" class="form-check-input" type="radio" name="tax"
                                           value="tax_nominal">
                                    <label class="form-check-label" for="tax_nominal">Nominal</label>

                                    <div class="input-group w-full" id="tax_nominal_input" style="display: none">
                                        <input name="tax_nominal" type="number" class="form-control ml-8"
                                               placeholder="Tax Nominal">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                </div>
                                <div class="form-check mt-2">
                                    <input id="tax_percentage" class="form-check-input" type="radio" name="tax"
                                           value="tax_percentage">
                                    <label class="form-check-label" for="tax_percentage">Percentage</label>

                                    <div class="input-group w-full" id="tax_percentage_input" style="display: none">
                                        <input name="tax_percentage" type="number" class="form-control ml-4"
                                               placeholder="Tax Percentage">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--PO CHILDREN--}}
                    <div class="w-full mt-10 flex-1" id="pochita_item_table_div" style="display: none">
                        <div class="overflow-x-auto">
                            <table class="table border" id="pochita_item_table">
                                <thead>
                                <tr>
                                    <th class="!pr-2 bg-slate-50 dark:bg-darkmode-800"></th>
                                    <th class="bg-slate-50 dark:bg-darkmode-800">
                                        Item in Supplier
                                    </th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                                        QTY
                                    </th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                                        Price
                                    </th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                                        Price X QTY
                                    </th>
                                    <th class="!px-2 bg-slate-50 dark:bg-darkmode-800"></th>
                                </tr>
                                </thead>
                                <tbody id="pochita_item_table_body">
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="bg-slate-50 dark:bg-darkmode-800" colspan="6">
                                        <button type="button" class="btn btn-outline-primary border-dashed w-full mt-4" id="pochita_add_row">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round" data-lucide="plus"
                                                 class="lucide lucide-plus w-4 h-4 mr-2">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add New Item
                                        </button>
                                    </th>
                                </tr>
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
                                                <input type="number" name="sub_total" id="sub_total" value="" hidden>

                                                <div class="text-base text-slate-500 whitespace-nowrap" id="total_discount_show">Rp. 0</div>
                                                <input type="number" name="sub_total" id="total_discount" value="" hidden>

                                                <div class="text-base text-slate-500 whitespace-nowrap" id="total_tax_show">Rp. 0</div>
                                                <input type="number" name="sub_total" id="total_tax" value="" hidden>

                                                <div class="text-xl text-primary font-medium mt-2" id="grand_total_show">Rp. 0</div>
                                                <input type="number" name="sub_total" id="grand_total" value="" hidden>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <button type="button" class="btn btn-outline-secondary w-24 mr-1" id="pochita_reset_form">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary w-24">{{ $button_title }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        window.ItemBySupplier = {
            SupplierDetail: null,
            Items: {}
        }
        let rowIdx = 0;

        $(document).ready(function () {
            let supplier_id = $('#supplier_id'),
                selector_tax_nominal = $('#tax_nominal_input'),
                selector_tax_percentage = $('#tax_percentage_input'),
                selector_discount_nominal = $('#discount_nominal_input'),
                selector_discount_percentage = $('#discount_percentage_input'),
                pochita_item_table_div = $('#pochita_item_table_div'),
                pochita_form = $('#pochita_form'),
                pochita_reset_form = $('#pochita_reset_form'),
                pochita_add_row = $('#pochita_add_row'),
                pochita_item_table_body = $('#pochita_item_table_body')

            pochita_reset_form.on('click', function () {
                pochita_form.trigger("reset");
                pochita_item_table_div.hide()
                selector_tax_nominal.hide();
                selector_tax_percentage.hide();
                selector_discount_nominal.hide();
                selector_discount_percentage.hide();
                selector_tax_nominal.find('input[type=number]').val(null);
                selector_tax_percentage.find('input[type=number]').val(null);
                selector_discount_nominal.find('input[type=number]').val(null);
                selector_discount_percentage.find('input[type=number]').val(null);
            })

            $('input[name="tax"]').on('change', function (ev) {
                if (ev.target.value === "tax_nominal") {
                    selector_tax_nominal.show();
                    selector_tax_percentage.hide();
                    selector_tax_percentage.find('input[type=number]').val(null);
                }
                if (ev.target.value === "tax_percentage") {
                    selector_tax_nominal.hide();
                    selector_tax_percentage.show();
                    selector_tax_nominal.find('input[type=number]').val(null);
                }
            })

            $('input[name="discount"]').on('change', function (ev) {
                if (ev.target.value === "discount_nominal") {
                    selector_discount_nominal.show();
                    selector_discount_percentage.hide();
                    selector_discount_percentage.find('input[type=number]').val(null);
                }
                if (ev.target.value === "discount_percentage") {
                    selector_discount_nominal.hide();
                    selector_discount_percentage.show();
                    selector_discount_nominal.find('input[type=number]').val(null);
                }
            })

            $('input[name="discount_nominal"]').on('keyup', delay(function () {
                disc()
                tax()
                grand_total()
            }, 500))

            $('input[name="discount_percentage"]').on('keyup', delay(function () {
                disc()
                tax()
                grand_total()
            }, 500))

            $('input[name="tax_nominal"]').on('keyup', delay(function () {
                disc()
                tax()
                grand_total()
            }, 500))

            $('input[name="tax_percentage"]').on('keyup', delay(function () {
                disc()
                tax()
                grand_total()
            }, 500))

            supplier_id.on('change', function (ev) {
                ev.preventDefault()
                $.ajax({
                    url: "{{ route('inventory.global.get_item_by_supplier_id') }}",
                    type: 'get',
                    data: {
                        'supplier_id': ev.target.value
                    },
                    beforeSend: function () {
                        run_waitMe(pochita_form, 1, 'facebook');
                        run_waitMe(pochita_item_table_div, 1, 'facebook');
                    },
                    success: function (data) {
                        console.log(data)
                        window.ItemBySupplier.Items = data.data
                        window.ItemBySupplier.SupplierDetail = data.supplier_detail
                        pochita_form.waitMe('hide');
                        pochita_item_table_body.html('')
                        rowIdx = 0
                        sub_total()
                        disc()
                        tax()
                        grand_total()
                        pochita_item_table_div.show()
                        pochita_item_table_div.waitMe('hide');
                    },
                    error: function (e) {
                        console.log(e)
                        pochita_form.waitMe('hide');
                        pochita_item_table_div.waitMe('hide');
                    }
                })
            })

            pochita_add_row.on('click', function () {
                let item = ''
                $.each(window.ItemBySupplier.Items, function (key, value) {
                    item += '<option value="' + value.id + '">' + value.name + '</option>'
                })
                pochita_item_table_body.append(`
                     <tr id="R${++rowIdx}">
                        <td class="row-index !pr-2">${rowIdx}</td>
                        <td class="!px-2 w-72">
                            <label for="item_id"></label>
                            <select name="item_id[]" id="item_id" class="form-control">
                                <option value="">-- Select Item --</option>
                                ${item}
                            </select>
                        </td>
                        <td class="!px-2">
                            <div class="input-group">
                                <input type="number" name="qty[]" id="qty" class="form-control min-w-[3rem]" placeholder="QTY">
                                <div class="input-group-text" id="unit">undefined</div>
                            </div>
                        </td>
                        <td class="!px-2">
                            <div class="input-group">
                                <div class="input-group-text">Rp. </div>
                                <input type="number" name="price[]" id="price" class="form-control min-w-[3rem]" placeholder="Price">
                            </div>
                        </td>
                        <td class="!px-2">
                            <div class="input-group">
                                <div class="input-group-text">Rp. </div>
                                <input type="text" name="total[]" id="total" class="form-control min-w-[3rem] total_qty_price" disabled>
                            </div>
                        </td>
                        <td class="!pl-4 text-slate-500">
                            <button type="button" id="pochita_item_table_remove">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </td>
                    </tr>
                `)
            })

            pochita_item_table_body.ready(function () {
                $(this).on('change', '#item_id', function () {
                    let child = $(this).closest('tr')
                    let item_id = child.find('#item_id').val()
                    let price_element = child.find('#price')
                    let unit_element = child.find('#unit')
                    let filter_item = window.ItemBySupplier.Items.filter(v => v.id === parseFloat(item_id))
                    child.find('#total').val(0)
                    child.find('#qty').val(0)
                    if (filter_item.length === 0) {
                        unit_element.html('undefined')
                        price_element.val(0)
                    } else {
                        unit_element.html(filter_item[0]['unit'])
                        price_element.val(filter_item[0]['cost'])
                    }
                    if (item_id !== ''){
                        window.ItemBySupplier.Items = window.ItemBySupplier.Items.filter(v => v.id !== parseFloat(item_id))
                    }
                });

                $(this).on('keyup', '#qty', delay(function () {
                    total(this)
                    sub_total()
                    disc()
                    tax()
                    grand_total()
                }, 500));

                $(this).on('keyup', '#price', delay(function () {
                    total(this)
                    sub_total()
                    disc()
                    tax()
                    grand_total()
                }, 500));

                $(this).on('click', '#pochita_item_table_remove', function () {
                    let child = $(this).closest('tr').nextAll();
                    child.each(function () {
                        let id = $(this).attr('id');
                        let idx = $(this).children('.row-index');
                        let dig = parseInt(id.substring(1));
                        idx.html(`${dig - 1}`);
                        $(this).attr('id', `R${dig - 1}`);
                    });
                    $(this).closest('tr').remove();
                    sub_total()
                    disc()
                    tax()
                    grand_total()
                    rowIdx--;
                });
            })

            pochita_form.on('submit', function (ev) {
                ev.preventDefault()
                let data = $(this).serializeArray();
                $.ajax({
                    url: "{{ route('inventory.po.store') }}",
                    type: 'post',
                    data: data,
                    beforeSend: function () {
                        run_waitMe(pochita_form, 1, 'facebook');
                    },
                    success: function (data) {
                        console.log(data)
                        pochita_form.waitMe('hide');
                    },
                    error: function (e) {
                        if ('errors' in e.responseJSON) {
                            let error = "<ul class='text-left'>";
                            $.each(e.responseJSON.errors, function (i, val) {
                                $.each(val, function (i, val1) {
                                    error += '<li>' + val1 + '</li>'
                                })
                            })
                            error += "</ul>";
                            Swal.fire({
                                icon: 'error',
                                title: e.responseJSON.message,
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
                        pochita_form.waitMe('hide');
                    }
                })
            })
        })

        function total(element) {
            let child = $(element).closest('tr')
            let price_element = child.find('#price').val()
            let qty_element = child.find('#qty').val()
            if (!qty_element || !price_element) {
                child.find('#total').val(0)
                return 0
            } else {
                let total = parseFloat(qty_element) * parseFloat(price_element)
                child.find('#total').val(formatRupiah(total))
                return total
            }
        }

        function sub_total() {
            let subTotal = 0

            $(".total_qty_price").each(function () {
                subTotal += total(this)
            });
            $('#sub_total').val(subTotal)
            $('#sub_total_show').text('Rp. ' + formatRupiah(subTotal))
            return subTotal
        }

        function disc() {
            let disc = 0
            let radio_button_checked = $('input[name="discount"]:checked')
            let nominal = $('input[name="discount_nominal"]')
            let percentage = $('input[name="discount_percentage"]')
            if (radio_button_checked.val() === 'discount_nominal') {
                disc = parseFloat(nominal.val())
            }
            if (radio_button_checked.val() === 'discount_percentage') {
                disc = (parseFloat(percentage.val()) / 100) * sub_total()
            }
            $('#total_discount').val(disc)
            $('#total_discount_show').text('Rp. ' + formatRupiah(disc))
            return disc
        }

        function tax() {
            let tax = 0
            let radio_button_checked = $('input[name="tax"]:checked')
            let nominal = $('input[name="tax_nominal"]')
            let percentage = $('input[name="tax_percentage"]')
            if (radio_button_checked.val() === 'tax_nominal') {
                tax = parseFloat(nominal.val())
            }
            if (radio_button_checked.val() === 'tax_percentage') {
                tax = (sub_total() - disc()) * (parseFloat(percentage.val()) / 100)
            }
            $('#total_tax').val(tax)
            $('#total_tax_show').text('Rp. ' + formatRupiah(tax))
            return tax
        }

        function grand_total() {
            let grandTotal
            grandTotal = (sub_total() - disc()) + tax()
            $('#grand_total').val(grandTotal)
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
