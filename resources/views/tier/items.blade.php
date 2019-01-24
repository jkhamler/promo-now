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
                <td colspan="2">Partner</td>
            </tr>
            </thead>

            <tbody>

            @foreach ($tier->items as $tierItem)
                <tr data-href="{{ route('tierItemDetails', [$tierItem->id]) }}">
                    <td>{{ $tierItem->short_description }}</td>
                    <td>{{ $tierItem->long_description }}</td>
                    <td>{{ $tierItem->coupon_number }}</td>
                    <td>{{ $tierItem->quantity }}</td>
                    <td>{{ $tierItem->partner->name }}</td>
                    <td>
                        <i class="fas fa-trash-alt" data-toggle="modal" data-tier-item-id="{{ $tierItem->id }}"
                           data-target=".delete-tier-item"></i>
                    </td>
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

                    <form method="POST" action="{{ route('createTierItem') }}">

                        <div class="form-group">

                            @csrf
                            <input type="hidden" name="tier_id" value="{{ $tier->id }}"/>

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

    <!-- Delete Tier Item Modal -->

    <div class="modal fade delete-tier-item" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete this item?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>TODO...</b></p>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>