<!-- Stored in resources/views/competition/index.blade.php -->

@extends('app')

@section('title', 'Competitions')

@section('content')

    <div class="row">
        <div class="col-9"><h1>Competitions</h1></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Create
                Competition
            </button>
        </div>
    </div>


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
            /** @var $competitions \App\Models\Competition[] */
        @endphp

        @foreach ($competitions as $competition)
            <tr>
                <td>{{ $competition->name }}</td>
                <td>{{ $competition->url }}</td>
                <td>{{ $competition->description }}</td>
                <td>{{ $competition->online_date->format('Y-m-d') }}</td>
                <td>{{ $competition->promo_open_date->format('Y-m-d') }}</td>
                <td>{{ $competition->promo_closed_date->format('Y-m-d') }}</td>
                <td>{{ $competition->offline_date->format('Y-m-d') }}</td>
                <td>{{ $competition->urns_issued }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>


@endsection


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Competition</h2>


                <form method="POST" action="{{ route('createCompetition') }}">

                    <div class="form-group">
                        @csrf
                        <label for="competitionName">Name</label>
                        <input type="text" class="form-control" id="competitionName" name="competitionName"
                               aria-describedby="nameHelp"
                               placeholder="Enter competition name">
                        <small id="nameHelp" class="form-text text-muted">E.g. 'Win a Ferrari'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="competitionUrl">URL</label>
                        <input type="text" class="form-control" id="competitionUrl" name="url"
                               placeholder="URL">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                               placeholder="URL">
                    </div>

                    <div class="form-group">
                        <label for="onlineDate">Online Date</label>
                        <input type="date" class="form-control" id="onlineDate" name="onlineDate"
                               value="@php echo date('Y-m-d') @endphp">
                    </div>

                    <div class="form-group">
                        <label for="promoOpenDate">Promo Open Date</label>
                        <input type="date" class="form-control" id="promoOpenDate" name="promoOpenDate"
                               value="@php echo date('Y-m-d') @endphp">
                    </div>

                    <div class="form-group">
                        <label for="promoClosedDate">Promo Closed Date</label>
                        <input type="date" class="form-control" id="promoClosedDate" name="promoClosedDate"
                               value="@php echo date('Y-m-d') @endphp">
                    </div>

                    <div class="form-group">
                        <label for="offlineDate">Offline Date</label>
                        <input type="date" class="form-control" id="offlineDate" name="offlineDate"
                               value="@php echo date('Y-m-d') @endphp">
                    </div>

                    <div class="form-group">
                        <label for="urnsIssued">URNs Issued</label>
                        <input type="number" class="form-control" id="urnsIssued" name="urnsIssued"
                               placeholder="URNs Issued" value="1000">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

</div>
