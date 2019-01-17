<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="promoTerms" role="tabpanel" aria-labelledby="promo-terms-tab">

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

        @php

            if($promotion->promoTerms->count() == 0){

            echo <<<EOT
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".create-promo-term-modal">Create Promo Terms
            </button>
EOT;

            }

        @endphp

    </div>

    <div class="container-fluid p-3">
        <h4>Promo Terms</h4>


        <table class="table">

            <tr>
                <td>Version</td>
                <td>Valid From</td>
                <td colspan="2">Valid Until</td>
            </tr>

            <tbody>

            @foreach ($promotion->promoTerms as $promoTerm)
                @php /** @var $promoTerm \App\Models\PromoTerm */@endphp
                <tr class="clickable-row">
                    <td>{{ $promoTerm->version }}@if($promoTerm->isLatestVersion()) (Active) @endif</td>
                    <td>{{ $promoTerm->valid_from->format('Y-m-d') }}</td>
                    <td>{{ $promoTerm->valid_until->format('Y-m-d') }}</td>

                    <td>
                        <form action="/promotions/{{ $promotion->id }}/promo-terms/{{$promoTerm->id}}">
                            <input type="submit" @if($promoTerm->isLatestVersion()) value="View/Edit"@else value="View Archive"@endif/>
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
                    <input type="hidden" name="promotionId" value="{{ $promotion->id }}"/>

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
                        <textarea class="form-control" rows="2" id="acceptanceText" name="acceptanceText"
                                  placeholder="E.g. 'I have read and accept the terms and conditions and confirm I am over 18 years old.'"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="shortTerms">Short Terms</label>
                        <input type="text" class="form-control" id="shortTerms" name="shortTerms"
                               placeholder="Short Description" required>
                    </div>

                    <div class="form-group">
                        <label for="terms">Terms</label>
                        <textarea class="form-control" id="termsBodyText" name="termsBodyText" rows="3"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>