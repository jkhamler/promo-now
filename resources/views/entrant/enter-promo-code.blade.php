@extends('app-entrant')

@section('title', 'Enter Competition')

@section('content')

    <h2 class="text-center">Enter Promo Code - {{ $promotion->name }}</h2>

    <form method="POST" action="{{ route('submitURN') }}">

        @csrf

        <input type="hidden" name="promotionId" value="{{ $promotion->id }}">

        <div class="form-group">
            <label for="description">URN</label>
            <input type="text" class="form-control" id="urn" name="urn" required
                   placeholder="Please enter your URN e.g. 'ABC123'">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


@endsection