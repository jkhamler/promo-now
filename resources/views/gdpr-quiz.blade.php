<!-- Stored in resources/views/home.blade.php -->

@extends('master')

@section('title', 'PromoNow')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">GDPR Quiz</li>
        </ol>
    </nav>

    <div class="container-fluid">

        <div>
            <h3>
                Welcome to PromoNow!
            </h3>

            <p>
                Please complete the GDPR Quiz below.
            </p>

        </div>

        <h4>GDPR Quiz</h4>

        <form method="POST" action="{{ route('submitGdprQuiz') }}">
            @csrf

            @foreach ($questions as $question => $answers)

                <div class="form-group">
                    <label for="type">{{$question}}</label>
                    <select class="form-control" id="type" name="type">
                        @foreach ($answers as  $answer)
                            <option value="{{ $answer }}">{{ $answer }}</option>
                        @endforeach
                    </select>
                </div>

            @endforeach

            <div class="form-group">
                <label for="acceptanceText">What would you do 5?</label>
                <textarea class="form-control" id="question5" name="question5"
                          placeholder="E.g. 'I would blah blah blah....'"></textarea>
            </div>

            <div class="form-group">
                <label for="acceptanceText">Please check all that apply</label>

                <br/>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1 &nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 2 &nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 3 &nbsp;</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

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