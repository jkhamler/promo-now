<!-- Stored in resources/views/promotion/index.blade.php -->

@extends('app')

@section('title', 'Promotions')

@section('content')

    @include('promotion.subnav')
    @php /** @var $promotion \App\Models\Promotion **/
    @endphp

    <div class="tab-content" id="myTabContent">
        <div class="row">
            <div class="col-5">
                <div class="container m-2"><h2>{{ $promotion->name }}</h2></div>
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="container-fluid p-3">
                        <h3>Details</h3>

                        <form method="POST" action="{{ route('updatePromotion') }}">

                            <div class="form-group">
                                @csrf
                                @method('PUT')
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
                                       placeholder="URL" value="{{$promotion->url}}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="URL" value="{{$promotion->description}}">
                            </div>

                            <div class="form-group">
                                <label for="onlineDate">Online Date</label>
                                <input type="datetime-local" class="form-control" id="onlineDate" name="onlineDate"
                                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->online_date)}}">
                            </div>

                            <div class="form-group">
                                <label for="promoOpenDate">Promo Open Date</label>
                                <input type="datetime-local" class="form-control" id="promoOpenDate"
                                       name="promoOpenDate"
                                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->promo_open_date) }}">
                            </div>

                            <div class="form-group">
                                <label for="promoClosedDate">Promo Closed Date</label>
                                <input type="datetime-local" class="form-control" id="promoClosedDate"
                                       name="promoClosedDate"
                                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->promo_closed_date) }}">
                            </div>

                            <div class="form-group">
                                <label for="offlineDate">Offline Date</label>
                                <input type="datetime-local" class="form-control" id="offlineDate" name="offlineDate"
                                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->offline_date) }}">
                            </div>

                            <div class="form-group">
                                <label for="urnsRequired" class="checkbox-inline">
                                    <input type="checkbox" id="urnsRequired" name="urnsRequired"
                                           value="{{ $promotion->urns_required }}">&nbsp;URNs Required</label>
                            </div>

                            <div class="form-group" id="urnsIssued" style="display: none;">
                                <label for="urnsIssued">URN Live Universe (aka Pack Universe)</label>
                                <input type="number" min="0" class="form-control" id="urnsIssued" name="urnsIssued"
                                       placeholder="URNs Issued" value="{{ $promotion->urns_required }}">
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

