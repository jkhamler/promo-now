@extends('master')

@section('title', 'Promotion - Promo Terms')

@section('content')

    @php
        /** @var \App\Models\PromoTerm $promoTerm */
    @endphp


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Promo Terms Details</li>
        </ol>
    </nav>

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

    <h2>Promo Terms</h2>

    @if(!$promoTerm->isLatestVersion())<h4>(Archived - last updated {{ $promoTerm->updated_at->format('d/m/Y H:i:s') }}
        )</h4>@endif

    <div class="col-12">

        <form method="POST" action="{{ route('updatePromoTerms', [$promotion->id, $promoTerm->id]) }}"
              id="updatePromoTermsForm">

            @csrf
            @method('PATCH')
            <input type="hidden" name="promoTermsId" value="{{ $promoTerm->id }}"/>

            <div class="form-group">
                <label for="title">Version</label>
                <input type="text" class="form-control" id="version" name="version" value="{{ $promoTerm->version }}"
                       disabled>
            </div>

            <div class="form-group">
                <label for="validFrom">Valid From</label>
                <input type="datetime-local" class="form-control" id="validFrom" name="validFrom"
                       required @php if(!$promoTerm->isLatestVersion()) echo 'disabled'; @endphp
                       value="<?php echo e(\App\Models\Promotion::dateFieldFormat($promoTerm->valid_from)); ?>">
            </div>

            <div class="form-group">
                <label for="validUntil">Valid Until</label>
                <input type="datetime-local" class="form-control" id="validUntil" name="validUntil"
                       required @php if(!$promoTerm->isLatestVersion()) echo 'disabled'; @endphp
                       value="<?php echo e(\App\Models\Promotion::dateFieldFormat($promoTerm->valid_until)); ?>">
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $promoTerm->title }}"
                       @php if(!$promoTerm->isLatestVersion()) echo 'disabled'; @endphp
                       placeholder="Title" required>
            </div>

            <div class="form-group">
                <label for="acceptanceText">Acceptance Text</label>
                <textarea class="form-control" id="acceptanceText" name="acceptanceText"
                          @php if(!$promoTerm->isLatestVersion()) echo 'disabled'; @endphp
                          placeholder="E.g. 'I have read and accept the terms and conditions and confirm I am over 18 years old.'">{{ $promoTerm->acceptance_text }}</textarea>
            </div>

            <div class="form-group">
                <label for="shortTerms">Short Terms</label>
                <textarea class="form-control" id="shortTerms" name="shortTerms"
                          @php if(!$promoTerm->isLatestVersion()) echo 'disabled'; @endphp
                          placeholder="E.g. 'Short Terms and COnditions'">{{ $promoTerm->short_terms }}</textarea>
            </div>

            <div class="form-group">
                <label for="terms">Terms</label>
                <textarea class="form-control" id="termsBodyText" name="termsBodyText"
                          rows="3">{{ $promoTerm->terms_body_text }}</textarea>
            </div>

            @if($promoTerm->isLatestVersion())
                <button type="submit" class="btn btn-primary">Update</button>
            @endif

        </form>
    </div>

    <br/>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#acceptanceText').summernote({});
            $('#shortTerms').summernote({});
            $('#termsBodyText').summernote({});
        });

        @if(!$promoTerm->isLatestVersion())

        $(document).ready(function () {
            $('#termsBodyText').summernote('disable');
        });

        @endif

    </script>


@endsection

