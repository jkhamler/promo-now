@extends('app-entrant')

@section('title', 'Valid Entry Code')

@section('content')


    @php
        /** @var $urn \App\Models\Urn */
    @endphp

    @if($urn->redeemed_at)

        <h2 class="text-center">Invalid Entry Code - {{ $urn->urn }}</h2>

        <p class="text-center">This entry code has already been redeemed.</p>

    @else

        <h2 class="text-center">Valid Entry Code - {{ $urn->urn }}</h2>

        <p class="text-center">Congratulations! This entry code is valid. Please enter your details below to claim your
            prize.</p>


        <form method="POST" action="{{ route('submitURN') }}">

            @csrf

            <input type="hidden" name="urnId" value="{{ $urn->id }}"/>

            <div class="form-group">
                <label for="description">Email</label>
                <input type="text" class="form-control" id="emailAddress" name="emailAddress" required
                       placeholder="Please enter your Email address e.g. 'jon@email.com'">
            </div>

            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required
                       placeholder="E.g. 'John'">
            </div>

            <div class="form-group">
                <label for="firstName">Surname</label>
                <input type="text" class="form-control" id="surname" name="surname" required
                       placeholder="E.g. 'Smith'">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endif



@endsection