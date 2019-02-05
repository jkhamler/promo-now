@extends('master')

@section('title', 'Audit')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Audit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-9"><h1>Audit</h1></div>
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
        <div class="container">
            <table id="auditTable" class="table table-striped table-bordered hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Model</th>
                    <th scope="col">Action</th>
                    <th scope="col">User</th>
                    <th scope="col">Time</th>
                    <th scope="col">Old Values</th>
                    <th scope="col">New Values</th>
                </tr>
                </thead>
                <tbody id="audits">
                @foreach($audits as $audit)
                    <tr>
                        <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                        <td>{{ $audit->event }}</td>
                        <td>{{ $audit->user ? $audit->user->name : '' }}</td>
                        <td>{{ $audit->created_at }}</td>
                        <td>
                            <table class="table">
                                @foreach($audit->old_values as $attribute => $value)
                                    <tr>
                                        <td><b>{{ $attribute }}</b></td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>
                            <table class="table">
                                @foreach($audit->new_values as $attribute => $value)
                                    <tr>
                                        <td><b>{{ $attribute }}</b></td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#auditTable').DataTable({
                "order" : [[3, "desc"]]
            });
        });

        // $('#auditTable').on('click', 'tbody tr', function () {
        //     window.location.href = $(this).data('href');
        // });
    </script>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Info Audit Index

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Audit Index

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop
