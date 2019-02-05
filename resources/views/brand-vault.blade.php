<!-- Stored in resources/views/home.blade.php -->

@extends('master')

@section('title', 'PromoNow')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Brand Vault</li>
        </ol>
    </nav>

    <div class="container-fluid">


        <div>
            <h3>
                PromoNow Brand Vault
            </h3>

            <p>
                Here you can manage all assets/images relating to your campaigns
            </p>

        </div>

    </div>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Brand Vault Page

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Brand Vault Page

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop