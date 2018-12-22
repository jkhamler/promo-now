<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="urns" role="tabpanel"
     aria-labelledby="urns-tab">

    <div class="container">
        <h2>{{ $promotion->name }}</h2>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-urn-specification-modal">Create URN Specification
        </button>
    </div>

    <div class="container-fluid p-3">
        <h4>URN Specifications</h4>

        <table class="table">
            <tr>
                <td>Reference ID</td>
                <td>Batch Name</td>
                <td>Purpose</td>
                <td>Length</td>
                <td>Quantity</td>
                <td>Winning Quantity</td>
            </tr>
            <tbody>

            @foreach ($promotion->urnSpecifications as $urnSpecification)
                @php
                    /** @var $urnSpecification \App\Models\UrnSpecification */
                @endphp
                <tr class="clickable-row">
                    <td>{{ $urnSpecification->reference_id }}</td>
                    <td>{{ $urnSpecification->batch_name }}</td>
                    <td>{{ $urnSpecification->getPurposeLabel() }}</td>
                    <td>{{ $urnSpecification->length }}</td>
                    <td>{{ $urnSpecification->urn_quantity }}</td>
                    <td>{{ $urnSpecification->winning_urn_quantity }}</td>
                    <td>
                        <form action="/promotions/{{$promotion->id}}/urn-specifications/{{$urnSpecification->id}}">
                            <input type="submit" value="View/Edit"/>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>


<!-- Modal -->
<div class="modal fade create-urn-specification-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create URN Specification for Promotion - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createUrnSpecification') }}">
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
                        <label for="batchName">Batch Name</label>
                        <input type="text" class="form-control" id="batchName" name="batchName"
                               placeholder="Enter batch name" required>
                        <small id="nameHelp" class="form-text text-muted">E.g. Level 1
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