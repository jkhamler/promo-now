<div class="tab-pane fade show active" id="campaignBasics" role="tabpanel"
     aria-labelledby="campaign-basics-tab">

    <div class="container m-2"><h2>{{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        <h3>Details</h3>

        <form method="POST" action="{{ route('updatePromotion', [$promotion->id, 'id']) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="promotionName">Name</label>
                <input type="text" class="form-control" id="promotionName" name="promotionName"
                       aria-describedby="nameHelp" required
                       placeholder="Enter promotion name" value="{{$promotion->name}}">
                <small id="nameHelp" class="form-text text-muted">E.g. 'Win a Ferrari'
                </small>
            </div>

            <div class="form-group">
                <label for="promotionUrl">URL</label>
                <input type="text" class="form-control" id="promotionUrl" name="url"
                       placeholder="URL" required value="{{$promotion->url}}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="URL" required value="{{$promotion->description}}">
            </div>

            <div class="form-group">
                <label for="onlineDate">Online Date</label>
                <input type="datetime-local" class="form-control" id="onlineDate" name="onlineDate"
                       required
                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->online_date)}}">
            </div>

            <div class="form-group">
                <label for="promoOpenDate">Promo Open Date</label>
                <input type="datetime-local" class="form-control" id="promoOpenDate" required
                       name="promoOpenDate"
                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->promo_open_date) }}">
            </div>

            <div class="form-group">
                <label for="promoClosedDate">Promo Closed Date</label>
                <input type="datetime-local" class="form-control" id="promoClosedDate" required
                       name="promoClosedDate"
                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->promo_closed_date) }}">
            </div>

            <div class="form-group">
                <label for="offlineDate">Offline Date</label>
                <input type="datetime-local" class="form-control" id="offlineDate" name="offlineDate"
                       required
                       value="{{ \App\Models\Promotion::dateFieldFormat($promotion->offline_date) }}">
            </div>

            <div class="form-group">
                <label for="urnsRequired" class="checkbox-inline">
                    <input type="checkbox" id="urnsRequired"
                           name="urnsRequired" @php if($promotion->urns_required){echo "checked";} @endphp>&nbspURNs
                    Required</label>
            </div>

            <div class="form-group"
                 id="urnsIssued" @php if(!$promotion->urns_required){echo "style='display: none;'";} @endphp>
                <label for="urnsIssued">URN Live Universe (aka Pack Universe)</label>
                <input type="number" min="0" class="form-control" id="urnsIssued" name="urnsIssued"
                       placeholder="URNs Issued" value="{{ $promotion->urns_issued }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>
