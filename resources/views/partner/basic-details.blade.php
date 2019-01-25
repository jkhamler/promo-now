@php
    /** @var $partner \App\Models\Partner */
@endphp

<div class="tab-pane fade show active" id="partnerBasics" role="tabpanel"
     aria-labelledby="partner-basics-tab">

    <div class="container-fluid"><h2>{{ $partner->name }}</h2></div>
    <div class="container-fluid p-3">

        <h4>Details</h4>

        <form method="POST" action="{{ route('updatePartner', [$promotion->id, $partner->id]) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="partnerName">Name</label>
                <input type="text" class="form-control" id="partnerName" name="partnerName"
                       aria-describedby="nameHelp" required
                       placeholder="Enter partner name" value="{{$partner->name}}">
                <small id="nameHelp" class="form-text text-muted">E.g. 'Win a Ferrari'
                </small>
            </div>

            <div class="form-group">
                <label for="legalName">Legal Name</label>
                <input type="text" class="form-control" id="legalName" name="legalName"
                       placeholder="Legal Name" value="{{$partner->legal_name}}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="Description" value="{{$partner->description}}">
            </div>

            <div class="form-group">
                <label for="companyNumber">Company Number</label>
                <input type="text" class="form-control" id="companyNumber" name="companyNumber"
                       placeholder="Company Number" value="{{$partner->company_number}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>
