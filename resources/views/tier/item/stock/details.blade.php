@extends('master')

@section('title', 'Tiers')

@section('content')

    @php
        $tierItem = $tierItemStock->tierItem;
        $tier = $tierItem->tier;
        $promotion = $tier->promotion;
    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tierDetails', [$promotion->id, $tier->id]) }}">{{ $tier->short_description }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$tierItem->short_description}}</li>
        </ol>
    </nav>

    @php /** @var $promotion \App\Models\Promotion **/
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

    <div class="row">

        <div class="container-fluid">

            <h2>Stock Details</h2>

            <div class="container-fluid p-3">

                <div class="col-8">
                    <form method="POST" action="{{ route('updateTierItemStock', [$tierItemStock->id, 'id']) }}">

                        <div class="form-group">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="tier_item_stock_id" value="{{ $tierItemStock->id }}"/>

                            <label for="referenceNumber">Reference Number</label>
                            <input type="text" class="form-control" id="referenceNumber" name="referenceNumber"
                                   placeholder="Reference Number" required value="{{$tierItemStock->reference_number}}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>


        </div>

    </div>


@endsection

