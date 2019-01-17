@extends('app-entrant')

@section('title', 'Log Support Ticket')

@section('content')

    <h2 class="text-center">Contact Us - {{ $promotion->name }}</h2>

    <form method="POST" action="{{ route('logSupportTicket') }}">
        @csrf

        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName"
                   placeholder="E.g. 'John'">
        </div>

        <div class="form-group">
            <label for="firstName">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname"
                   placeholder="E.g. 'Smith'">
        </div>

        <div class="form-group">
            <label for="description">Email</label>
            <input type="text" class="form-control" id="email" name="email"
                   placeholder="Please enter your Email address e.g. 'jon@email.com'">
        </div>


        <div class="form-group">
            <label for="issue">Issue</label>
            <textarea class="form-control" rows="4" id="issue" name="issue"
                      placeholder="Please describe the issue that you're having as fully as possible and we will get back to you ASAP."></textarea>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
    </form>

@endsection