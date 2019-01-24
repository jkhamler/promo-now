<div class="tab-pane fade show" id="tierItems" role="tabpanel"
     aria-labelledby="tier-items-tab">


    <!-- Tier Items-->

    <div class="row">
        <div class="col-9"><h3>Items</h3></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right m-3" data-toggle="modal"
                    data-target=".bd-example-modal-lg">Create Tier Item
            </button>
        </div>
    </div>

    <div class="row">

        <table id="tierItemTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Short Description</td>
                <td>Long Description</td>
                <td>Coupon Number</td>
                <td>Quantity</td>
                <td>Partner</td>
            </tr>
            </thead>

            <tbody>

            @foreach ($faqGroup->items as $tierItem)
                <tr data-href="{{ route('tierItemDetails', [$promotion->id, $faqGroup->id, $tierItem->id]) }}">
                    <td>{{ $tierItem->short_description }}</td>
                    <td>{{ $tierItem->long_description }}</td>
                    <td>{{ $tierItem->coupon_number }}</td>
                    <td>{{ $tierItem->quantity }}</td>
                    <td>{{ $tierItem->partner->name }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tierItemTable').DataTable();
        });

        $('#tierItemTable').on('click', 'tbody tr', function () {
            window.location.href = $(this).data('href');
        });
    </script>

    <!-- Create Tier Item Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="container-fluid p-3">

                    <h2>Create Tier Item</h2>

                    <form method="POST" action="{{ route('createTierItem', [$promotion->id, $faqGroup->id]) }}">

                        <div class="form-group">

                            @csrf
                            <input type="hidden" name="tier_id" value="{{ $faqGroup->id }}"/>

                            <label for="shortDescription">Short Description</label>
                            <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                                   aria-describedby="shortDescriptionHelp" required
                                   placeholder="Enter short description">
                            <small id="shortDescriptionHelp" class="form-text text-muted">E.g. 'LCD TV'
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="longDescription">Long Description</label>
                            <input type="text" class="form-control" id="longDescription" name="longDescription"
                                   aria-describedby="longDescriptionHelp" required
                                   placeholder="Enter long description">
                            <small id="longDescriptionHelp" class="form-text text-muted">E.g. '40 Inch LCD TV'
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Coupon Number</label>
                            <input type="text" class="form-control" id="couponNumber" name="couponNumber"
                                   aria-describedby="couponNumberHelp" required
                                   placeholder="Enter coupon number">
                            <small id="couponNumberHelp" class="form-text text-muted">E.g. ABC12345
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" min="1" class="form-control" id="quantity" name="quantity"
                                   aria-describedby="quantityHelp" required
                                   placeholder="Enter quantity">
                            <small id="quantityHelp" class="form-text text-muted">E.g. 50
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="partnerId">Partner</label>
                            <select class="form-control" id="partnerId" name="partnerId">
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button id="deleteButton" type="button" class="btn btn-outline-primary" data-dismiss="modal">
                            Cancel
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>