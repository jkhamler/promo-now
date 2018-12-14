@extends('app')

@section('title', 'Tiers')

@section('content')

    @php

        /** @var \App\Models\TierItem $tierItem */

        $tier = $tierItem->tier;

        $promotion = $tier->promotion;

    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/promotions">Promotions</a></li>
            <li class="breadcrumb-item"><a href="/promotions/{{ $promotion->id }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item"><a href="/tiers/{{ $tier->id }}">{{ $tier->short_description }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$tierItem->short_description}}</li>
        </ol>
    </nav>

    @php /** @var $tier \App\Models\Tier **/
    @endphp

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

    <h2>Tier Item - {{$tierItem->short_description}}</h2>

    <div class="col-8">
        <form method="POST" action="{{ route('updateTierItem', [$tierItem->id, 'id']) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <input type="hidden" name="tier_item_id" value="{{ $tierItem->id }}"/>

                <label for="shortDescription">Short Description</label>
                <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                       placeholder="Short Description" required value="{{$tierItem->short_description}}">
            </div>

            <div class="form-group">
                <label for="longDescription">Long Description</label>
                <input type="text" class="form-control" id="longDescription" name="longDescription"
                       placeholder="Long Description" required value="{{$tierItem->long_description}}">
            </div>

            <div class="form-group">
                <label for="couponNumber">Coupon Number</label>
                <input type="text" class="form-control" id="couponNumber" name="couponNumber"
                       placeholder="Coupon Number" required value="{{$tierItem->coupon_number}}">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                       placeholder="Quantity" min="1" required value="{{$tierItem->quantity}}">
            </div>

            <div class="form-group">
                <label for="sel1">Partner</label>
                <select class="form-control" id="partnerId" name="partnerId">
                    @foreach ($partners as $partner)
                        <option value="{{ $partner->id }}" @php if($partner->id == $tierItem->partner_id){echo 'selected';} @endphp>{{ $partner->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <br/>


@endsection

