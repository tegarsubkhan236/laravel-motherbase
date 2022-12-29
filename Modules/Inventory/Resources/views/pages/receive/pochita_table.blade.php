@php
    use Modules\Inventory\Casts\PoStatus;
    use Modules\Inventory\Casts\BoStatus;
@endphp
@if(!isset($data))
    <div class="intro-x text-slate-500 text-lg text-center my-4 box"> Do Filter data first</div>
@else
    <h2 class="text-base font-medium">Receiving Order From</h2>
    @if(isset($supplier))
        <p class="text-base font-bold">{{ $supplier->name }}</p>
    @else
        <p class="text-base font-bold">All Supplier</p>
    @endif
    <table class="intro-y table table-report mt-5 overflow-auto lg:overflow-visible" id="pochita_table">
        <thead>
        <tr>
            <th class="whitespace-nowrap">#</th>
            @if(!isset($supplier))
                <th class="whitespace-nowrap">SUPPLIER</th>
            @endif
            <th class="whitespace-nowrap">PO CODE</th>
            <th class="whitespace-nowrap">Sub Total</th>
            <th class="whitespace-nowrap">Grand Total</th>
            <th class="text-center whitespace-nowrap">STATUS</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $key => $item)
            <tr>
                <td style="display: none;">{{ $item->id }}</td>
                <td>{{ $key+1 }}</td>
                @if(!isset($supplier))
                    <td>{{ $item->inv_supplier->name }}</td>
                @endif
                <td>{{ $item->po_code }}</td>
                <td>
                    <div class="font-medium whitespace-nowrap">Rp. {{ number_format($item->amount) }}</div>
                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Dics {{ $item->discount_perc ?? 0}}% | Tax {{ $item->tax_perc ?? 0}}%</div>
                </td>
                <td>
                    <div class="font-medium whitespace-nowrap">Rp. {{ number_format(($item->amount - $item->discount) + $item->tax) }}</div>
                </td>
                <td class="text-center">
                    <span class="text-white text-sm font-normal mr-2 px-2.5 py-0.5 rounded
                        @if($item->status == PoStatus::CREATED) bg-success
                        @elseif($item->status == PoStatus::PARTIAL_RECEIVE) bg-warning
                        @elseif($item->status == PoStatus::FULL_RECEIVE) bg-emerald-900
                        @else bg-danger @endif
                    ">
                        {{PoStatus::lang($item->status)}}
                    </span>
                </td>
                <td class="table-report__action">
                    <div class="flex justify-center items-center">
                        @if($item->status == PoStatus::CREATED)
                            <a class="flex items-center text-success mr-3" href="{{ route('inventory.receive.create', ['id' => $item->id, 'type' => 'PO']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path>
                                </svg>
                            </a>
                        @elseif($item->status == PoStatus::PARTIAL_RECEIVE)
                            <a class="flex items-center text-warning mr-3" href="#" id="view_bo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            <tr class="bo_view" style="display: none">
                <td colspan="6" class="text-center">
                    <table class="intro-y table table-report overflow-auto lg:overflow-visible">
                        <thead>
                        <tr>
                            <td colspan="6">
                                <h2 class="text-base font-medium">Back Order From</h2>
                                <p class="text-base font-bold">{{ $item->po_code }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">BO CODE</th>
                            <th class="whitespace-nowrap">Sub Total</th>
                            <th class="whitespace-nowrap">Grand Total</th>
                            <th class="text-center whitespace-nowrap">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($item->inv_bos as $bo_key => $bo)
                            <tr>
                                <td style="display: none;">{{ $bo->id }}</td>
                                <td>{{ $bo_key+1 }}</td>
                                <td>{{ $bo->bo_code }}</td>
                                <td>
                                    <div class="font-medium whitespace-nowrap">Rp. {{ number_format($bo->amount) }}</div>
                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Dics {{ $bo->discount_perc ?? 0}}% | Tax {{ $bo->tax_perc ?? 0}}%</div>
                                </td>
                                <td>
                                    <div class="font-medium whitespace-nowrap">Rp. {{ number_format(($bo->amount - $bo->discount) + $bo->tax) }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="text-white text-sm font-normal mr-2 px-2.5 py-0.5 rounded
                                        @if($bo->status == BoStatus::CREATED) bg-success
                                        @elseif($bo->status == BoStatus::PARTIAL_RECEIVE) bg-warning
                                        @elseif($bo->status == BoStatus::FULL_RECEIVE) bg-emerald-900
                                        @else bg-danger @endif
                                    ">
                                        {{BoStatus::lang($bo->status)}}
                                    </span>
                                </td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        @if($bo->status == BoStatus::CREATED)
                                            <a class="flex items-center text-success mr-3" href="{{ route('inventory.receive.create', ['id' => $bo->id, 'type' => 'BO']) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path>
                                                </svg>
                                            </a>
                                        @elseif($bo->status == BoStatus::PARTIAL_RECEIVE)
                                            <a class="flex items-center text-warning mr-3" href="#" id="view_bo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                        @endif
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
@endif
