@extends('app-entrant')

@section('title', 'Support Ticket Logged')

@section('content')

    <h2 class="text-center">Support Ticket Logged</h2>

    <p class="text-center">Hi {{ $person->first_name }}, thanks for logging the issue with us. We will get back to you
        ASAP.</p>


@endsection