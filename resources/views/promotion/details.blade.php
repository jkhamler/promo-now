<!-- Stored in resources/views/promotion/index.blade.php -->

@extends('app')

@section('title', 'Promotions')

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab"
               aria-controls="details"
               aria-selected="true">Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users"
               aria-selected="false">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings"
               aria-selected="false">Settings</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="row">
            <div class="col-5">
                <div class="container m-2"><h2>{{ $promotion->name }}</h2></div>
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="container-fluid p-3">
                        <h3>Details</h3>

                        <form method="POST" action="{{ route('createPromotion') }}">

                            <div class="form-group">
                                @csrf
                                <label for="promotionName">Name</label>
                                <input type="text" class="form-control" id="promotionName" name="promotionName"
                                       aria-describedby="nameHelp"
                                       placeholder="Enter promotion name" value="{{$promotion->name}}">
                                <small id="nameHelp" class="form-text text-muted">E.g. 'Win a Ferrari'
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="promotionUrl">URL</label>
                                <input type="text" class="form-control" id="promotionUrl" name="url"
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

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>

                </div>

            </div>


        </div>
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            <p>Manage Users</p>
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <p>Manage Users</p>
        </div>
    </div>
@endsection

