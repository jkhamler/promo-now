@extends('master')

@section('title', 'Partners')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('partnerIndex') }}">Partners</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $partner->name }}</li>
        </ol>
    </nav>


    @include('partner.subnav')
    @php /** @var $partner \App\Models\Partner **/
    @endphp

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

    <div class="row">

        <div class="container-fluid">

            <div class="tab-content" id="myTabContent">

                @include('partner.basic-details')
                @include('partner.addresses')

            </div>

        </div>

    </div>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Info Partners Details

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Partners Details

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

