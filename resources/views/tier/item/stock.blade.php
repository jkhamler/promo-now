<div class="tab-pane fade show" id="tierItemStock" role="tabpanel"
     aria-labelledby="tier-item-stock-tab">

    <div class="container">

        <h2>{{ $tierItem->short_description }} Stock</h2>

        <table id="tierItemStockTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Partner</td>
                <td>Tier Item</td>
                <td>Reference Number</td>
                <td>Allocated Date/time</td>
            </tr>
            </thead>

            <tbody>

            @foreach ($tierItem->stock as $tierItemStock)
                <tr data-href="{{ route('tierItemStockDetails', [$promotion->id, $tier->id, $tierItem->id, $tierItemStock->id]) }}">
                    <td>{{ $tierItem->partner->name }}</td>
                    <td>{{ $tierItem->short_description }}</td>
                    <td>{{ $tierItemStock->reference_number }}</td>
                    <td>{{ $tierItemStock->allocated_datetime }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tierItemStockTable').DataTable();
    });

    $('#tierItemStockTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
</script>