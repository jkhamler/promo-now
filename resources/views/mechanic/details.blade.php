@extends('app')

@section('title', 'Promotion - Mechanics')

@section('content')

    @php
        /** @var \App\Models\Mechanic $mechanic */
        /** @var \App\Models\Promotion $promotion */
        $promotion = $mechanic->promotion
    @endphp


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/promotions">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="/promotions/{{ $promotion->id }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mechanic Details</li>
        </ol>
    </nav>

    @include('mechanic.subnav')

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

            @include('mechanic.mechanic-basics')
            @include('mechanic.winning-moment')
            @include('mechanic.timed-draw')
            @include('mechanic.everybody-gets')
            @include('mechanic.item-prize-seeding')
            @include('mechanic.mechanic-items')

        </div>

    </div>



@endsection

