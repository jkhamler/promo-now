@php
    /** @var $promotion \App\Models\Promotion */
@endphp

<div class="tab-pane fade show active" id="campaignBasics" role="tabpanel"
     aria-labelledby="campaign-basics-tab">

    <div class="container-fluid"><h2>{{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        <h4>Details</h4>

        <form method="POST" action="{{ route('updatePromotion', [$promotion->id]) }}">

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
                <label for="reference">Reference</label>
                <input type="text" class="form-control" id="reference" name="reference"
                       placeholder="URL" required value="{{$promotion->reference}}">
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url"
                       placeholder="URL" required value="{{$promotion->url}}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"
                          rows="3">{{ $promotion->description }}</textarea>
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

    </div></div>