<div class="tab-pane fade" id="urns" role="tabpanel" aria-labelledby="urns-tab">

    <div class="container">

        <h2>URNs</h2>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>URN Batch</th>
                <th>URN</th>
                <th>Created at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($urnSpecification->urnBatches as $urnBatch)
                @foreach($urnBatch->urns as $urn)
                    <tr>
                        <td>{{ $urnBatch->batch_name }}</td>
                        <td>{{ $urn->urn }}</td>
                        <td>{{ $urn->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
            @endforeach
            @endforeach
            </tfoot>
        </table>

    </div>

</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>