@extends('master')

@section('title', 'Promotion - Mechanics')

@section('content')

    @php
        /** @var \App\Models\UrnSpecification $urnSpecification */
    @endphp


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">URN Specification Details</li>
        </ol>
    </nav>

    @include('urn.specification.subnav')

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

                @include('urn.specification.basics')
                @include('urn.specification.urns')

            </div>

        </div>

    </div>


@endsection

