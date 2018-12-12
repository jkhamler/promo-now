@extends('app')

@section('title', 'Promotions')

@section('content')

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

        <div class="col-8">
            <div class="tab-content" id="myTabContent">

                @include('promotion.campaign-basics')
                @include('promotion.urns')
                @include('promotion.prizes-items')
                @include('promotion.mechanics')
                @include('promotion.users')

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

