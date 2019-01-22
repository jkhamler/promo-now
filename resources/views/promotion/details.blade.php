@extends('master')

@section('title', 'Promotions')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/promotions">Promotions</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $promotion->name }}</li>
        </ol>
    </nav>


    @include('promotion.subnav')
    @php /** @var $promotion \App\Models\Promotion **/
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

                @include('promotion.campaign-basics')
                @include('promotion.urns')
                @include('promotion.prizes-items')
                @include('promotion.mechanics')
                @include('promotion.promo-terms')
                @include('promotion.privacy-terms')
                @include('promotion.faqs')
                @include('promotion.entrants')

            </div>

        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#urnsRequired').change(function () {
                if (this.checked)
                    $('#urnsIssued').show();
                else
                    $('#urnsIssued').hide();
            });
        });
    </script>

@endsection

