@extends('app')

@section('title', 'Partners')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
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

        <table class="table">

            <tr>
                <td>Name</td>
                <td>Legal Name</td>
                <td>Description</td>
                <td colspan="2">Company Number</td>
            </tr>

            <tbody>

            @foreach ($partners as $partner)
                <tr class="clickable-row">
                    <td>{{ $partner->name }}</td>
                    <td>{{ $partner->legal_name }}</td>
                    <td>{{ $partner->description }}</td>
                    <td>{{ $partner->company_number }}</td>
                    <td>
                        <form action="/partners/{{$partner->id}}">
                            <input type="submit" value="View/Edit"/>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>


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
                                   placeholder="Legal Name" required>
                            <small id="legalNameHelp" class="form-text text-muted">E.g. GlaxoSmithKline PLC
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                   placeholder="Description" required>
                            <small id="descriptionHelp" class="form-text text-muted">E.g. Largest global e-retailer
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="companyNumber">Description</label>
                            <input type="text" class="form-control" id="companyNumber" name="companyNumber"
                                   placeholder="Company Number" required>
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

