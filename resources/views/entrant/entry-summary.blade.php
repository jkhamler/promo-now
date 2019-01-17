@extends('app-entrant')

@section('title', 'Successful Entry')

@section('content')

    <h2 class="text-center">Hi {{ $person->first_name }}, Thanks for your entry - {{ $promotion->name }}</h2>

    <p class="text-center">Your entry has been submitted successfully. We will be in touch via email with instructions on
        how to claim your prize.</p>

@endsection