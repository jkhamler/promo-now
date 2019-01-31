@extends('master')

@section('title', 'Promotion - Privacy Terms')

@section('content')

    @php
        /** @var \App\Models\PrivacyTerm $privacyTerm */
    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Privacy Terms Details</li>
        </ol>
    </nav>

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

    <h2>Privacy Terms</h2>

    @if(!$privacyTerm->isLatestVersion())<h4>(Archived - last
        updated {{ $privacyTerm->updated_at->format('d/m/Y H:i:s') }})</h4>@endif

    <div class="col-12">

        <form method="POST" action="{{ route('updatePrivacyTerms', [$promotion->id, $privacyTerm->id]) }}"
              id="updatePromoTermsForm">

            @csrf
            @method('PATCH')
            <input type="hidden" name="privacyTermId" value="{{ $privacyTerm->id }}"/>

            <div class="form-group">
                <label for="title">Partner</label>
                <input type="text" class="form-control" id="partner" name="partner"
                       value="{{ $privacyTerm->partner->name }}"
                       disabled>
            </div>

            <div class="form-group">
                <label for="title">Version</label>
                <input type="text" class="form-control" id="version" name="version" value="{{ $privacyTerm->version }}"
                       disabled>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $privacyTerm->title }}"
                       @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp
                       placeholder="Title" required>
            </div>

            <div class="form-group">
                <label for="acceptanceText">Acceptance Text</label>
                <textarea class="form-control" id="acceptanceText" name="acceptanceText"
                          @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp
                          placeholder="E.g. 'I have read and accept the terms and conditions and confirm I am over 18 years old.'">{{ $privacyTerm->acceptance_text }}</textarea>
            </div>

            <div class="form-group">
                <label for="terms">Terms</label>
                <textarea class="form-control" id="privacyTermsBodyText" name="privacyTermsBodyText"
                        @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp>{{ $privacyTerm->terms_body_text }}</textarea>
            </div>

            <div class="form-group">
                <label for="marketingOptIn">Marketing Opt In</label>
                <textarea class="form-control" id="marketingOptIn" name="marketingOptIn"
                          @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp
                          placeholder="E.g. 'I would like to receive marketing communications.'">{{ $privacyTerm->marketing_opt_in }}</textarea>
            </div>

            <div class="form-group">
                <label for="cookieTitle">Cookie Title</label>
                <input type="text" class="form-control" id="cookieTitle" name="cookieTitle"
                       value="{{ $privacyTerm->cookie_title }}"
                       @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp
                       placeholder="Cookie Title">
            </div>

            <div class="form-group">
                <label for="cookieBodyText">Cookie Terms</label>
                <textarea class="form-control" id="cookieBodyText" name="cookieBodyText" rows="3"
                        @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp>{{ $privacyTerm->cookie_body_text }}</textarea>
            </div>

            <div class="form-group">
                <label for="gdprEmail">GDPR Email Contact</label>
                <input type="text" class="form-control" id="gdprEmail" name="gdprEmail"
                       value="{{ $privacyTerm->gdpr_contact_email }}"
                       placeholder="e.g. privacyoffer@client.com"
                       required @php if(!$privacyTerm->isLatestVersion()) echo 'disabled'; @endphp>
            </div>


            @if($privacyTerm->isLatestVersion())
                <button type="submit" class="btn btn-primary">Update</button>
            @endif

        </form>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#privacyTermsBodyText').summernote({});
            $('#acceptanceText').summernote({});
            $('#marketingOptIn').summernote({});
            $('#cookieBodyText').summernote({});
        });

        @if(!$privacyTerm->isLatestVersion())

        $(document).ready(function () {
            $('#privacyTermsBodyText').summernote('disable');
        });

        @endif

    </script>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Info Privacy Term Overview

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Privacy Term Overview

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop