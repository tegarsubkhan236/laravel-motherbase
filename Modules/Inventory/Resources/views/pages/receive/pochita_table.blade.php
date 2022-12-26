@php use Modules\Inventory\Casts\PoStatus; @endphp
@if(!isset($data))
    <div class="intro-x text-slate-500 text-lg text-center my-4 box"> Do Filter data first</div>
@else
    <table class="intro-y table table-report mt-5 overflow-auto lg:overflow-visible" id="pochita_table">
        <thead>
        <tr>
            <th class="whitespace-nowrap">#</th>
            <th class="whitespace-nowrap">ORDER CODE</th>
            <th class="whitespace-nowrap">SUPPLIER</th>
            <th class="whitespace-nowrap">AMOUNT</th>
            <th class="text-center whitespace-nowrap">STOCKS_IDS</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
                <tr>
                    <td colspan="6" class="text-center">
                        <h5>Hallo World</h5>
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
