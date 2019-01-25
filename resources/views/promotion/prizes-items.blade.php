<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="prizesItems" role="tabpanel"
     aria-labelledby="prizes-items-tab">

    <div class="container-fluid">
        <div class="row">
            <div class="col-6"><h2>{{ $promotion->name }}</h2></div>
            <div class="col-6">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".create-tier-modal">Create Tier
                </button>
            </div>
        </div>

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

    </div>

    <div class="container-fluid p-3">
        <h4>Tiers</h4>

        <table id="tierTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Level</td>
                <td>Short Description</td>
                <td>Long Description</td>
                <td>Quantity</td>
            </tr>
            </thead>
            <tbody>

            @foreach ($promotion->tiers as $tier)
                <tr data-href="{{ route('tierDetails', [$promotion->id, $tier->id]) }}">
                    <td>{{ $tier->level }}</td>
                    <td>{{ $tier->short_description }}</td>
                    <td>{{ $tier->long_description }}</td>
                    <td>{{ $tier->quantity }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('#tierTable').DataTable();

        $('#urnsRequired').change(function () {
            if (this.checked)
                $('#urnsIssued').show();
            else
                $('#urnsIssued').hide();
        });
    });

    $('#tierTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
</script>


<!-- Modal -->
<div class="modal fade create-tier-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Tier for Promotion - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createTier', [$promotion->id]) }}">
                    @csrf

                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="level">Level</label>
                        <input type="number" class="form-control" id="level" name="level"
                               aria-describedby="levelHelp" required min="1"
                               placeholder="Enter level">
                        <small id="nameHelp" class="form-text text-muted">E.g. '1'. Tier levels must be unique
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="promotionUrl">Short Description</label>
                        <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                               placeholder="Enter short description" required>
                        <small id="nameHelp" class="form-text text-muted">E.g. Level 1
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="promotionUrl">Long Description</label>
                        <input type="text" class="form-control" id="longDescription" name="longDescription"
                               placeholder="Enter long description" required>
                        <small id="nameHelp" class="form-text text-muted">E.g. Level 1 (Longer Description)
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="level">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                               aria-describedby="quantityHelp" required min="1"
                               placeholder="Enter quantity">
                        <small id="quantityHelp" class="form-text text-muted">E.g. '5000'
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>