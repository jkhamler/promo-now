<!-- Stored in resources/views/promotion/enter-promo-code.blade.php -->

@extends('master')

@section('title', 'Promotions')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Promotions</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-9"><h1>Promotions</h1></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target=".create-promotion-modal">Create
                Promotion
            </button>
        </div>
    </div>

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

    <div class="container-fluid p-3">
        <h4>Promotions</h4>

        <table id="promotionTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Name</td>
                <td>Reference</td>
                <td>URL</td>
                <td>Online Date</td>
                <td>Promo Open Date</td>
                <td>Promo Closed Date</td>
                <td>Offline Date</td>
                <td>URNs Issued</td>
            </tr>
            </thead>
            <tbody>

            <?php
            /** @var $promotions \App\Models\Promotion[] */
            $now = \Carbon\Carbon::now();

            $nowString = \App\Models\Promotion::dateFieldFormat($now);

            $nextMonth = clone $now;
            $nextMonth->addMonth(1);

            $nextMonthString = \App\Models\Promotion::dateFieldFormat($nextMonth);

            $monthAfterNext = clone $now;
            $monthAfterNext->addMonth(2);

            $monthAfterNextString = \App\Models\Promotion::dateFieldFormat($monthAfterNext);

            $twoMonthsAfterNext = clone $now;
            $twoMonthsAfterNext->addMonth(3);

            $twoMonthsAfterNextString = \App\Models\Promotion::dateFieldFormat($twoMonthsAfterNext);

            ?>

            @foreach ($promotions as $promotion)
                <tr data-href="{{ route('promotionDetails', [$promotion->id]) }}">
                    <td>{{ $promotion->name }}</td>
                    <td>{{ $promotion->reference }}</td>
                    <td>{{ $promotion->url }}</td>
                    <td>{{ $promotion->online_date->format('Y-m-d') }}</td>
                    <td>{{ $promotion->promo_open_date->format('Y-m-d') }}</td>
                    <td>{{ $promotion->promo_closed_date->format('Y-m-d') }}</td>
                    <td>{{ $promotion->offline_date->format('Y-m-d') }}</td>
                    <td>{{ $promotion->urns_issued }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>



    <script type="text/javascript">
        $(document).ready(function () {
            $('#promotionTable').DataTable();
        });

        $('#promotionTable').on('click', 'tbody tr', function () {
            window.location.href = $(this).data('href');
        });
    </script>


    <!-- Modal -->
    <div class="modal fade create-promotion-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="container-fluid p-3">

                    <h2>Create Promotion</h2>

                    <form method="POST" action="{{ route('createPromotion') }}">

                        <div class="form-group">
                            @csrf
                            <label for="promotionName">Name</label>
                            <input type="text" class="form-control" id="promotionName" name="promotionName"
                                   aria-describedby="nameHelp" required
                                   placeholder="Enter promotion name">
                            <small id="nameHelp" class="form-text text-muted">E.g. 'Win a Ferrari'
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="reference">Reference</label>
                            <input type="text" class="form-control" id="reference" name="reference"
                                   placeholder="Reference" required>
                            <small id="referenceHelp" class="form-text text-muted">E.g. WIN12345
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url"
                                   placeholder="URL" required>
                            <small id="nameHelp" class="form-text text-muted">E.g. winstuff.com/code
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                   placeholder="Description" required>
                            <small id="nameHelp" class="form-text text-muted">E.g. Win some amazing prizes
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="onlineDate">Online Date</label>
                            <input type="datetime-local" class="form-control" id="onlineDate" name="onlineDate"
                                   value="{{ $nowString }}" required>
                        </div>

                        <div class="form-group">
                            <label for="promoOpenDate">Promo Open Date</label>
                            <input type="datetime-local" class="form-control" id="promoOpenDate" name="promoOpenDate"
                                   value="{{ $nextMonthString }}" required>
                        </div>

                        <div class="form-group">
                            <label for="promoClosedDate">Promo Closed Date</label>
                            <input type="datetime-local" class="form-control" id="promoClosedDate"
                                   name="promoClosedDate"
                                   value="{{ $monthAfterNextString }}" required>
                        </div>

                        <div class="form-group">
                            <label for="offlineDate">Offline Date</label>
                            <input type="datetime-local" class="form-control" id="offlineDate" name="offlineDate"
                                   value="{{ $twoMonthsAfterNextString }}" required>
                        </div>

                        <div class="form-group">
                            <label for="urnsRequired" class="checkbox-inline">
                                <input type="checkbox" id="urnsRequired" name="urnsRequired">&nbsp;URNs Required</label>
                        </div>

                        <div class="form-group" id="urnsIssued" style="display: none;">
                            <label for="urnsIssued">URN Live Universe (aka Pack Universe)</label>
                            <input type="number" min="0" class="form-control" id="urnsIssued" name="urnsIssued"
                                   placeholder="URNs Issued" value="10000">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    </form>

                </div>
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

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Info Promotions Index

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Promotions Index

        Loremxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

