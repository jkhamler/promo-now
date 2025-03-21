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
                    <tr data-href="{{ route('entrantDetails', [$promotion->id, $entrant->id]) }}">
                        <td>{{ $entrant->created_at->format('d/m/Y H:i:s') }}</td>
                        @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                            <td>{{ $entrant->person->getFullName() }}</td>
                            <td>{{ $entrant->person->email_address }}</td>
                        @else
                            <td>{{ str_limit($entrant->person->first_name, 2, '***') }} {{ str_limit($entrant->person->surname, 2, '***') }}</td>
                            <td>{{ $entrant->person->emailMasked() }}</td>
                        @endif
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

    $('#entrantsTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });

</script>