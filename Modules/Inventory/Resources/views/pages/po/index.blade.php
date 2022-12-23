@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 xl:col-span-3" id="pochita_form_div"></div>
        <div class="col-span-12 xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 flex flex-wrap sm:flex-nowrap items-center">
                    <div>
                        <button type="button" class="btn btn-outline-primary dark:text-white" id="pochita_add_button">
                            <i class="w-6 h-6 mr-2" data-lucide="plus-circle"></i>
                            New Data
                        </button>
                        <button type="button" class="btn btn-outline-primary dark:text-white" id="pochita_filter_button">
                            <i class="w-6 h-6 mr-2" data-lucide="search"></i>
                            Filter
                        </button>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>
                    </div>
                    <div class="hidden md:block mx-auto text-slate-500"></div>
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <div class="w-56 relative text-slate-500">
                            <label for="quick_search"></label>
                            <input id="quick_search" type="text" class="form-control w-56 box pr-10" placeholder="Quick Search...">
                            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-span-12" id="pochita_table_div"></div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endpush

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            fetch_data()
            show_form("SEARCH")
            // fetch_data
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let query = $('#quick_search').val();
                $('#hidden_page').val(page);
                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });
            $(document).on('keyup', '#quick_search', delay(function () {
                let query = $('#quick_search').val();
                let page = $('#hidden_page').val(1);
                fetch_data(page, query);
            }, 500));
            // show_form
            $(document).on('click', '#pochita_add_button', function (event) {
                event.preventDefault();
                show_form("ADD")
            });
            $(document).on('click', '#pochita_filter_button', function (event) {
                event.preventDefault();
                show_form("SEARCH")
            });
            $(document).on('click', '#pochita_table #pochita_table_edit', function (event) {
                event.preventDefault();
                let currentRow = $(this).closest('tr');
                let id = currentRow.find("td:eq(0)").text();
                show_form("EDIT", id)
            });
            $(document).on('click', '#pochita_form #reset_form', function (event) {
                event.preventDefault()
                $('#pochita_form')[0].reset();
            })
            // action_form
            $(document).on('submit', '#pochita_form', function (event) {
                event.preventDefault()
                let data = $(this).serializeArray();
                let type = $('#type_form').val();
                // action_form(data, type)
            })
        });

        function fetch_data(page, search) {
            if (page === undefined) {
                page = 1
            }
            $.ajax({
                url: '{{ route('inventory.po.show_table') }}',
                type: 'get',
                data: "page=" + page + "&quick_search=" + search,
                beforeSend: function () {
                    run_waitMe($('#pochita_table_div'), 1, 'facebook');
                },
                success: function (data) {
                    let table = $('#pochita_table_div')
                    table.html(data);
                    table.waitMe('hide');
                }
            });
        }

        function show_form(type, id) {
            if (type === "SEARCH") {
                let title = 'Search Purchase Order'
                let button_title = 'Search'
                $.ajax({
                    url: "{{ route('inventory.po.show_form') }}",
                    data: {
                        'type': type,
                        'title': title,
                        'button_title': button_title,
                        'id': id
                    },
                    beforeSend: function () {
                        run_waitMe($('#pochita_form_div'), 1, 'facebook');
                    },
                    success: function (data) {
                        let form = $('#pochita_form_div')
                        form.html(data).ready(function () {
                            new TomSelect("#supplier_id");
                            let start = moment().subtract(29, 'days');
                            let end = moment();

                            function cb(start, end) {
                                $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                            }

                            $('#date_range').daterangepicker({
                                startDate: start,
                                endDate: end,
                                ranges: {
                                    'Today': [moment(), moment()],
                                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                }
                            }, cb);

                            cb(start, end);
                        });
                        $('#type_form').val(type);
                        $('#id').val(id);
                        form.waitMe('hide');
                    }
                })
            }
            if (type === "ADD") {
                window.location.href = "{{ route('inventory.po.create') }}";
            }
            if (type === "EDIT") {
                window.location.href = "/inventory/po/"+id+"/edit"
            }
        }
    </script>
@endpush
