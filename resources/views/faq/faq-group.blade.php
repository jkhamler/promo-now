@extends('master')

@section('title', 'FAQs')

@section('content')

    @php

        /** @var \App\Models\FAQGroup $faqGroup */
        /** @var \App\Models\Partner[] $partners */

        $promotion = $faqGroup->promotion;

    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$faqGroup->name}}</li>
        </ol>
    </nav>

    @include('faq.subnav')

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

                @include('faq.basics')
                @include('faq.faqs')

            </div>

        </div>

    </div>

@endsection