@extends('app')

@section('title', 'Tiers')

@section('content')

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

    <div class="row">

        <div class="col-8">
            <h1>Tier Details - {{ $tier->short_description }}</h1>

            <p>Level: {{ $tier->level }}</p>
            <p>Short Description: {{ $tier->short_description }}</p>
            <p>Long Description: {{ $tier->long_description }}</p>
            <p>Quantity: {{ $tier->quantity }}</p>
        </div>


    </div>


@endsection

