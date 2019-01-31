@extends('master')

@section('title', 'Promotion - Entrant')

@section('content')

    @php
        /** @var \App\Models\Entrant $entrant */
        /** @var \App\Models\Promotion $promotion */
        $promotion = $entrant->promotion
    @endphp


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Entrant Details</li>
        </ol>
    </nav>

    @include('entrant.subnav')

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

        <div class="tab-content" id="myTabContent">

            @include('entrant.entrant-basics')
            @include('entrant.contact-details')
            @include('entrant.item-details')

        </div>

    </div>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Info Entrant Overview

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Entrant Overview

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop