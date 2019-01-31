<!-- Stored in resources/views/home.blade.php -->

@extends('master')

@section('title', 'PromoNow')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Request Services</li>
        </ol>
    </nav>

    <div class="container-fluid">

        <div>
            <h3>
                Welcome to PromoNow!
            </h3>

            <p>
                Please raise an issue with our technical team using the form below.
            </p>

        </div>

        <h4>Request Services</h4>

        <form method="POST" action="{{ route('makeServiceRequest') }}">
            @csrf

            <div class="form-group">
                <label for="purpose">Promotion</label>
                <select class="form-control" id="promotionId" name="promotionId">
                    @foreach ($promotions as $promotion)
                        <option value="{{ $promotion->id }}">{{ $promotion->name }} ({{ $promotion->reference }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="subject" class="form-control" id="subject" name="subject"
                       placeholder="Please enter the subject of your inquiry.">
            </div>


            <div class="form-group">
                <label for="enquiry">Enquiry</label>
                <textarea class="form-control" rows="4" id="enquiry" name="enquiry"
                          placeholder="Please describe the issue that you're having as fully as possible and we will get back to you ASAP."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
        </form>


    </div>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Request Services

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Request Services

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop