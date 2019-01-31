@extends('master')

@section('title', 'Partners')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Partners</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-9"><h1>Partners</h1></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target=".create-partner-modal">Create
                Partner
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
        <div class="container">
            <table id="partnersTable" class="table table-striped table-bordered hover">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Legal Name</td>
                    <td>Description</td>
                    <td>Company Number</td>
                </tr>
                </thead>

                <tbody>
                @foreach ($partners as $partner)

                    <tr data-href="partners/{{ $partner->id }}">
                        <td>{{ $partner->name }}</td>
                        <td>{{ $partner->legal_name }}</td>
                        <td>{{ $partner->description }}</td>
                        <td>{{ $partner->company_number }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#partnersTable').DataTable();
        });

        $('#partnersTable').on( 'click', 'tbody tr', function () {
            window.location.href = $(this).data('href');
        });
    </script>



    <!-- Modal -->
    <div class="modal fade create-partner-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="container-fluid p-3">

                    <h2>Create Partner</h2>

                    <form method="POST" action="{{ route('createPartner') }}">

                        <div class="form-group">
                            @csrf
                            <label for="partnerName">Name</label>
                            <input type="text" class="form-control" id="partnerName" name="partnerName"
                                   aria-describedby="nameHelp" required
                                   placeholder="Enter partner name">
                            <small id="nameHelp" class="form-text text-muted">E.g. Amazon
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="legalName">Legal Name</label>
                            <input type="text" class="form-control" id="legalName" name="legalName"
                                   placeholder="Legal Name">
                            <small id="legalNameHelp" class="form-text text-muted">E.g. GlaxoSmithKline PLC
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                   placeholder="Description">
                            <small id="descriptionHelp" class="form-text text-muted">E.g. Largest global e-retailer
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="companyNumber">Company Number</label>
                            <input type="text" class="form-control" id="companyNumber" name="companyNumber"
                                   placeholder="Company Number">
                            <small id="companyNumberHelp" class="form-text text-muted">E.g. ABC12345
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('sidebar-right-gdpr')
    @parent
    <p>GDPR Info Partners Index

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop

@section('sidebar-right-useful-info')
    @parent

    <p>Useful Info Partners Index

        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
    </p>
@stop
