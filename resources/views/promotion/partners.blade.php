@php
    /** @var $promotion \App\Models\Promotion */
@endphp

<div class="tab-pane fade" id="partners" role="tabpanel"
     aria-labelledby="partners-tab">

    <div class="container-fluid">
        <div class="row">
            <div class="col-6"><h2>{{ $promotion->name }}</h2></div>
            <div class="col-6">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".create-promotion-partner-modal">Add Partner
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
        <h4>Partners</h4>

        <table id="promotionPartnersTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Partner</td>
                <td>Purpose</td>
                <td>Notes</td>
            </tr>
            </thead>

            <tbody>

            @foreach ($promotion->promotionPartners as $promotionPartner)
                @php
                    /** @var $promotionPartner \App\Models\PromotionPartner */
                @endphp
                <tr data-href="{{ route('promotionPartnerDetails', [$promotion->id, $promotionPartner->id]) }}">
                    <td>{{ $promotionPartner->partner->name }}</td>
                    <td>{{ $promotionPartner->getPurposeLabel() }}</td>
                    <td>{{ $promotionPartner->notes }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#promotionPartnersTable').DataTable();
    });

    $('#promotionPartnersTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
</script>

<!-- Modal -->
<div class="modal fade create-promotion-partner-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Add Partner to Promotion</h2>

                <form method="POST" action="{{ route('createPromotionPartner', [$promotion->id]) }}">
                    @csrf

                    <input type="hidden" name="promotionId" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="purpose">Partner</label>
                        <select class="form-control" id="partnerId" name="partnerId">
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <select class="form-control" id="purpose" name="purpose">
                            @foreach ($promotionPartnerPurposes as $purposeValue => $purposeLabel)
                                <option value="{{ $purposeValue }}">{{ $purposeLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>