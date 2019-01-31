@extends('master')

@section('title', 'Promotion - Partner')

@section('content')

    @php
        /** @var \App\Models\PrivacyTerm $promotionPartner */
    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Promotion Partner Details</li>
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

    <h2>Promotion Partner</h2>

    <div class="col-12">

        <form method="POST" action="{{ route('updatePromotionPartner', [$promotion->id, $promotionPartner->id]) }}"
              id="updatePromoTermsForm">

            @csrf
            @method('PATCH')
            <input type="hidden" name="promotionPartnerId" value="{{ $promotionPartner->id }}"/>

            <div class="form-group">
                <label for="title">Partner</label>
                <input type="text" class="form-control" id="partnerId" name="partnerId"
                       value="{{ $promotionPartner->partner->name }}"
                       disabled>
            </div>

            <div class="form-group">
                <label for="purpose">Purpose</label>
                <select class="form-control" id="purpose" name="purpose"
                        @php if($promotionPartner->purpose == \App\Models\PromotionPartner::PURPOSE_FULFILLMENT_PARTNER){echo 'disabled';} @endphp>
                    @foreach ($promotionPartnerPurposes as $purposeValue => $purposeLabel)
                        <option value="{{ $purposeValue }}"@php if($promotionPartner->purpose == $purposeValue){echo 'selected';} @endphp>{{ $purposeLabel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes"
                          rows="3">{{ $promotionPartner->notes }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>

@endsection

