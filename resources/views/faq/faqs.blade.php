@php
    /** @var $faqGroup \App\Models\FAQGroup */
@endphp

<div class="tab-pane fade show" id="faqs" role="tabpanel"
     aria-labelledby="faqs-tab">

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


        <h2>{{ $faqGroup->name }}</h2>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-faq-modal">Create FAQ
        </button>

    </div>

    <div class="container-fluid p-3">
        <h4>FAQs</h4>

        <table id="faqTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Order</td>
                <td>Title</td>
                <td>Body Text</td>
            </tr>
            </thead>

            <tbody>

            @foreach ($faqGroup->faqs as $faq)
                @php /** @var $faq \App\Models\FAQ */
                @endphp
                <tr data-href="{{ route('FAQDetails', [$promotion->id, $faqGroup->id, $faq->id]) }}">
                    <td>{{ $faq->order }}</td>
                    <td>{{ $faq->title }}</td>
                    <td>{{ $faq->body_text }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#faqTable').DataTable();
    });

    $('#faqTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
</script>

{{--<!-- Create FAQ Modal -->--}}
{{--<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"--}}
{{--aria-hidden="true">--}}

{{--<div class="modal-dialog modal-lg">--}}

{{--<div class="modal-content">--}}

{{--<div class="container-fluid p-3">--}}

{{--<h2>Create Tier Item</h2>--}}

{{--<form method="POST" action="{{ route('createTierItem', [$promotion->id, $faqGroup->id]) }}">--}}

{{--<div class="form-group">--}}

{{--@csrf--}}
{{--<input type="hidden" name="tier_id" value="{{ $faqGroup->id }}"/>--}}

{{--<label for="shortDescription">Short Description</label>--}}
{{--<input type="text" class="form-control" id="shortDescription" name="shortDescription"--}}
{{--aria-describedby="shortDescriptionHelp" required--}}
{{--placeholder="Enter short description">--}}
{{--<small id="shortDescriptionHelp" class="form-text text-muted">E.g. 'LCD TV'--}}
{{--</small>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="longDescription">Long Description</label>--}}
{{--<input type="text" class="form-control" id="longDescription" name="longDescription"--}}
{{--aria-describedby="longDescriptionHelp" required--}}
{{--placeholder="Enter long description">--}}
{{--<small id="longDescriptionHelp" class="form-text text-muted">E.g. '40 Inch LCD TV'--}}
{{--</small>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="description">Coupon Number</label>--}}
{{--<input type="text" class="form-control" id="couponNumber" name="couponNumber"--}}
{{--aria-describedby="couponNumberHelp" required--}}
{{--placeholder="Enter coupon number">--}}
{{--<small id="couponNumberHelp" class="form-text text-muted">E.g. ABC12345--}}
{{--</small>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="quantity">Quantity</label>--}}
{{--<input type="number" min="1" class="form-control" id="quantity" name="quantity"--}}
{{--aria-describedby="quantityHelp" required--}}
{{--placeholder="Enter quantity">--}}
{{--<small id="quantityHelp" class="form-text text-muted">E.g. 50--}}
{{--</small>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="partnerId">Partner</label>--}}
{{--<select class="form-control" id="partnerId" name="partnerId">--}}
{{--@foreach ($partners as $partner)--}}
{{--<option value="{{ $partner->id }}">{{ $partner->name }}</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}

{{--<button type="submit" class="btn btn-primary">Submit</button>--}}
{{--<button id="deleteButton" type="button" class="btn btn-outline-primary" data-dismiss="modal">--}}
{{--Cancel--}}
{{--</button>--}}
{{--</form>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

