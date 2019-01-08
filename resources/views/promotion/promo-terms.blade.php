<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">

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
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-promo-term-modal">Create Promo Terms
        </button>
    </div>

    <div class="container-fluid p-3">
        <h4>Terms</h4>


        <table class="table">

            <tr>
                <td>Name</td>
                <td>Description</td>
                <td colspan="2">Type</td>
            </tr>

            <tbody>

            <?php

            ?>

            @foreach ($promotion->promoTerms as $term)
                @php /** @var $term \App\Models\PromoTerm */@endphp
                <tr class="clickable-row">
                    <td>{{ $term->name }}</td>
                    <td>{{ $term->description }}</td>
                    <td>{{ $term->getTypeLabel() }}</td>
                    <td>
                        <form action="/promotions/{{ $promotion->id }}/terms/{{$term->id}}">
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
<div class="modal fade create-promo-term-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Promo Terms - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createPromoTerms') }}" id="createPromoTermsForm">

                    @csrf
                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="partnerId">Partner</label>
                        <select class="form-control" id="partner" name="partner">
                            @foreach ($promotion->outstandingPromoTermsPartners() as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="validFrom">Valid From</label>
                        <input type="datetime-local" class="form-control" id="validFrom" name="validFrom"
                               required
                               value="<?php echo e(\App\Models\Promotion::dateFieldFormat($promotion->online_date)); ?>">
                    </div>

                    <div class="form-group">
                        <label for="validUntil">Valid Until</label>
                        <input type="datetime-local" class="form-control" id="validUntil" name="validUntil"
                               required
                               value="<?php echo e(\App\Models\Promotion::dateFieldFormat($promotion->offline_date)); ?>">
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Title" required>
                    </div>

                    <div class="form-group">
                        <label for="acceptanceText">Acceptance Text</label>
                        <textarea class="form-control" rows="2" id="acceptanceText" placeholder="E.g. 'I have read and accept the terms and conditions and confirm I am over 18 years old.'"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="shortDescription">Short Terms</label>
                        <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                               placeholder="Short Description" required>
                    </div>

                    <div class="form-group">
                        <label for="terms">Terms</label>
                        <textarea class="form-control" id="termsSummerNote" name="terms" rows="3"></textarea>
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#termsSummerNote').summernote({
            // toolbar: [
            //     // [groupName, [list of button]]
            //     ['style', ['bold', 'italic', 'underline', 'clear']],
            //     ['font', ['strikethrough', 'superscript', 'subscript']],
            //     ['fontsize', ['fontsize']],
            //     ['color', ['color']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['height', ['height']]
            // ]
        });
    });

</script>