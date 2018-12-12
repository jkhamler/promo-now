<div class="tab-pane fade" id="prizesItems" role="tabpanel"
     aria-labelledby="prizes-items-tab">

    <div class="row m-2">
        <div class="col-8">
            <h2>{{ $promotion->name }}</h2>
        </div>
        <div class="col-3">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target=".bd-example-modal-lg">
                Create
                Tier
            </button>
        </div>
    </div>

    <div class="container-fluid p-3">

        <h4>Tiers</h4>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Level</th>
                <th scope="col">Short Description</th>
                <th scope="col">Long Description</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>

            <?php
            /** @var $tiers \App\Models\Tier[] */
            ?>

            @foreach ($tiers as $tier)
                <tr class="clickable-row">
                    <td>{{ $tier->level }}</td>
                    <td>{{ $tier->short_description }}</td>
                    <td>{{ $tier->long_description }}</td>
                    <td>{{ $tier->quantity }}</td>
                    <td>
                        <form action="/tiers/{{$tier->id}}">
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Tier</h2>

                <form method="POST" action="{{ route('createTier') }}">

                    @csrf
                    <div class="form-group">
                        <label for="level">Level</label>
                        <input type="number" class="form-control" id="level" name="level"
                               aria-describedby="levelHelp" required min="1"
                               placeholder="Enter level">
                        <small id="nameHelp" class="form-text text-muted">E.g. '1'
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


<script type="text/javascript">
    $(document).ready(function () {

        $('#urnsRequired').change(function () {
            if (this.checked)
                $('#urnsIssued').show();
            else
                $('#urnsIssued').hide();
        });
    });
</script>
