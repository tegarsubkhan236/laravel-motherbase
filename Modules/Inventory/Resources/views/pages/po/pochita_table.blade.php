@php use Modules\Inventory\Casts\PoStatus; @endphp
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <table class="intro-y table table-report mt-5 overflow-auto lg:overflow-visible" id="pochita_table">
            <thead>
            <tr>
                <th class="whitespace-nowrap">#</th>
                <th class="whitespace-nowrap">PO CODE</th>
                <th class="whitespace-nowrap">SUPPLIER</th>
                <th class="whitespace-nowrap">AMOUNT</th>
                <th class="text-center whitespace-nowrap">STATUS</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $key => $item)
                <tr>
                    <td style="display: none;">{{ $item->id }}</td>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->po_code }}</td>
                    <td>{{ $item->inv_supplier->name }}</td>
                    <td>
                        <div class="font-medium whitespace-nowrap">Rp. {{ number_format(($item->amount - $item->discount) + $item->tax) }}</div>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Dics {{ $item->discount_perc ?? 0}}% | Tax {{ $item->tax_perc ?? 0}}%</div>
                    </td>
                    <td>
                        <div class="flex items-center justify-center {{ $item->status == PoStatus::CREATED ? "text-success" : "text-danger"}}">
                            @if($item->status == PoStatus::CREATED)
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                </svg>
                            @endif
                            {{PoStatus::lang($item->status)}}
                        </div>
                    </td>
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center text-warning mr-3" href="#" id="pochita_table_edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                            <a class="flex items-center text-danger" href="#" id="pochita_table_delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <h5>No data available</h5>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $data->links('pagination::tailwind') }}
        </div>
    </div>
</div>
