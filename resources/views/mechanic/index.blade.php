<!-- Stored in resources/views/mechanic/index.blade.php -->

@extends('app')

@section('title', 'Mechanics')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mechanics</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-9"><h1>Mechanics</h1></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target=".bd-example-modal-lg">Create
                Mechanic
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

    <div class="row">

        <table class="table">

            <tr>
                <td>Name</td>
                <td>URL</td>
                <td>Description</td>
                <td>Online Date</td>
                <td>Promo Open Date</td>
                <td>Promo Closed Date</td>
                <td>Offline Date</td>
                <td colspan="2">URNs Issued</td>
            </tr>

            <tbody>

            <?php

            ?>

            @foreach ($mechanics as $mechanic)
                <tr class="clickable-row">
                    <td>{{ $mechanic->name }}</td>
                    <td>{{ $mechanic->url }}</td>
                    <td>{{ $mechanic->description }}</td>
                    <td>{{ $mechanic->online_date->format('Y-m-d') }}</td>
                    <td>{{ $mechanic->promo_open_date->format('Y-m-d') }}</td>
                    <td>{{ $mechanic->promo_closed_date->format('Y-m-d') }}</td>
                    <td>{{ $mechanic->offline_date->format('Y-m-d') }}</td>
                    <td>{{ $mechanic->urns_issued }}</td>
                    <td>
                        <form action="/mechanics/{{$mechanic->id}}">
                            <input type="submit" value="View/Edit"/>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>


    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="container-fluid p-3">

                    <h2>Create Mechanic</h2>

                    <form method="POST" action="{{ route('createMechanic') }}">

                        <div class="form-group">
                            @csrf
                            <label for="mechanicName">Name</label>
                            <input type="text" class="form-control" id="mechanicName" name="mechanicName"
                                   aria-describedby="nameHelp" required
                                   placeholder="Enter mechanic name">
                            <small id="nameHelp" class="form-text text-muted">E.g. 'Win a Ferrari'
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="mechanicUrl">URL</label>
                            <input type="text" class="form-control" id="mechanicUrl" name="url"
                                   placeholder="URL" required>
                            <small id="nameHelp" class="form-text text-muted">E.g. winstuff.com/code
                            </small>
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

