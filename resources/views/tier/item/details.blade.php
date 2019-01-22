@extends('master')

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

    @include('tier.item.subnav')
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

            <div class="tab-content" id="myTabContent">

                @include('tier.item.basics')
                @include('tier.item.stock')

            </div>

        </div>

    </div>




@endsection

