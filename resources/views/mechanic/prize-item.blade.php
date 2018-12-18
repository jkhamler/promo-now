@php
    /** @var \App\Models\Mechanic $mechanic */
@endphp

<div class="tab-pane fade" id="prizeItem" role="tabpanel"
     aria-labelledby="prize-item-tab">

    <div class="container"><h2>Prize Item - {{ $mechanic->promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        <div class="row">

            <div class="col-9">

                <h4>Type: {{$mechanic->getTypeLabel()}}</h4>

                <form method="POST" action="{{ route('updateMechanic', [$mechanic->id, 'id']) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="type">Prize Item</label>
                        <select class="form-control" id="tierItemId" name="tierItemId">
                            <option value="0">None Allocated</option>
                            @foreach ($mechanic->promotion->getAllPossibleTierItems() as $tierItem)
                                <option @php if($mechanic->tier_item_id == $tierItem->id){
                                echo 'selected';}@endphp value="{{ $tierItem->id }}">{{ $tierItem->short_description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
</div>