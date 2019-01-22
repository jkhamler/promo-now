<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="entrants" role="tabpanel" aria-labelledby="entrants-tab">

    <div class="container">

        <h2>Entrants</h2>
        <table id="entrantsTable" class="table table-striped table-bordered hover" style="width:100%">
            <thead>
            <tr>
                <th>Entry Date/time</th>
                <th>Name</th>
                <th>Email</th>
                <th>Item</th>
            </tr>
            </thead>
            <tbody>
            @foreach($promotion->entrants as $entrant)
                <tr>
                    <td>{{ $entrant->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $entrant->person->getFullName() }}</td>
                    <td>{{ $entrant->person->email_address }}</td>
                    <td>{{ $entrant->tierItems->first()->short_description }}</td>
                </tr>
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