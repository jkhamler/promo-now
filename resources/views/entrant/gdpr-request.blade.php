@extends('app-entrant')

@section('title', 'GDPR Request')

@section('content')

    <h2 class="text-center">GDPR Request</h2>

    <p>
        Please use this form to inform us that you wish all of your personal data to be purged from our system.
    </p>

    <form method="POST" action="{{ route('gdprRequest') }}">
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
            <label for="emailAddress">Email</label>
            <input type="text" class="form-control" id="emailAddress" name="emailAddress"
                   placeholder="Please enter your Email address e.g. 'jon@email.com'">
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="subject" class="form-control" id="subject" name="subject" value="GDPR Request" disabled>
        </div>

        <div class="form-group">
            <label for="enquiry">Enquiry</label>
            <textarea class="form-control" rows="4" id="enquiry" name="enquiry"
                      placeholder="I would like all information relating to me to be removed from the PromoNow system."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
    </form>

@endsection