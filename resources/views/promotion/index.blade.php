<!-- Stored in resources/views/promotion/index.blade.php -->

@extends('app')

@section('title', 'Promotions')

@section('content')

    <div class="row">
        <div class="col-9"><h1>Promotions</h1></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Create
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

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">URL</th>
            <th scope="col">Description</th>
            <th scope="col">Online Date</th>
            <th scope="col">Promo Open Date</th>
            <th scope="col">Promo Closed Date</th>
            <th scope="col">Offline Date</th>
            <th scope="col">URNs Issued</th>
        </tr>
        </thead>
        <tbody>

        @php
            /** @var $promotions \App\Models\Promotion[] */
        $nowString = \App\Models\Promotion::dateFieldFormat(\Carbon\Carbon::now());
        @endphp

        @foreach ($promotions as $promotion)
            <tr class="clickable-row" data-href="/123">
                <td>{{ $promotion->name }}</td>
                <td>{{ $promotion->url }}</td>
                <td>{{ $promotion->description }}</td>
                <td>{{ $promotion->online_date->format('Y-m-d') }}</td>
                <td>{{ $promotion->promo_open_date->format('Y-m-d') }}</td>
                <td>{{ $promotion->promo_closed_date->format('Y-m-d') }}</td>
                <td>{{ $promotion->offline_date->format('Y-m-d') }}</td>
                <td>{{ $promotion->urns_issued }}</td>
                <td>
                    <form action="/promotions/{{$promotion->id}}">
                        <input type="submit" value="View/Edit"/>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                            <label for="promotionUrl">URL</label>
                            <input type="text" class="form-control" id="promotionUrl" name="url"
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

