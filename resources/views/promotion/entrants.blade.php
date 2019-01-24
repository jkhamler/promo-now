<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="entrants" role="tabpanel" aria-labelledby="entrants-tab">

    <div class="container">

        @if ($errors->any())
            <div class="row">
                <div class="col-6">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif

        <h2>{{ $promotion->name }}</h2>

    </div>

    <div class="container-fluid p-3">
        <h4>Entrants</h4>

        <table id="entrantsTable" class="table table-striped table-bordered hover" style="width:100%">
            <thead>
            <tr>
                <th>Entry Date/time</th>
                <th>Entrant</th>
                <th>Email</th>
                <th>Item</th>
                <th>Reference Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($promotion->entrants as $entrant)
                @foreach($entrant->tierItemStock as $tierItemStock)
                    @php
                        /** @var $entrant \App\Models\Entrant */
                        /** @var $tierItemStock \App\Models\TierItemStock */

                    @endphp
                    <tr>
                        <td>{{ $entrant->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $entrant->person->getFullName() }}</td>
                        <td>{{ $entrant->person->email_address }}</td>
                        <td>{{ $tierItemStock->tierItem->short_description }}</td>
                        <td>{{ $tierItemStock->reference_number }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#entrantsTable').DataTable();
    });
</script>