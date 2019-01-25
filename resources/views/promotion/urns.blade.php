<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="urns" role="tabpanel"
     aria-labelledby="urns-tab">

    <div class="container-fluid">

        <div class="row">
            <div class="col-6"><h2>{{ $promotion->name }}</h2></div>
            <div class="col-6">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".create-urn-specification-modal">Create URN Specification
                </button>
            </div>

        </div>

    </div>

    <div class="container-fluid p-3">
        <h4>URN Specifications</h4>

        <table id="urnSpecificationsTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Reference ID</td>
                <td>Purpose</td>
                <td>Length</td>
                <td>Quantity</td>
                <td>Winning Quantity</td>
            </tr>
            </thead>

            <tbody>

            @foreach ($promotion->urnSpecifications as $urnSpecification)
                @php
                    /** @var $urnSpecification \App\Models\UrnSpecification */
                @endphp
                <tr data-href="{{ route('urnSpecificationDetails', [$promotion->id, $urnSpecification->id]) }}">
                    <td>{{ $urnSpecification->reference_id }}</td>
                    <td>{{ $urnSpecification->getPurposeLabel() }}</td>
                    <td>{{ $urnSpecification->length }}</td>
                    <td>{{ $urnSpecification->urn_quantity }}</td>
                    <td>{{ $urnSpecification->winning_urn_quantity }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#urnSpecificationsTable').DataTable();
    });

    $('#urnSpecificationsTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
</script>


<!-- Modal -->
<div class="modal fade create-urn-specification-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create URN Specification for Promotion - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createUrnSpecification', [$promotion->id]) }}">
                    @csrf

                    <input type="hidden" name="promotionId" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="referenceId">Reference ID</label>
                        <input type="text" class="form-control" id="referenceId" name="referenceId"
                               aria-describedby="levelHelp" required
                               placeholder="Enter Reference ID">
                        <small id="nameHelp" class="form-text text-muted">E.g. '5000 Winning Codes'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <select class="form-control" id="purpose" name="purpose">
                            @foreach ($urnSpecificationPurposes as $purposeValue => $purposeLabel)
                                <option value="{{ $purposeValue }}">{{ $purposeLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="number" class="form-control" id="length" name="length"
                               aria-describedby="levelHelp" required min="1"
                               placeholder="Enter length">
                        <small id="levelHelp" class="form-text text-muted">E.g. '5000'
                        </small>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>