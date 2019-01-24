<div class="tab-pane fade show active" id="tierItemBasics" role="tabpanel"
     aria-labelledby="tier-item-basics-tab">

    <div class="container-fluid"><h2>{{ $tierItem->short_description }}</h2></div>
    <div class="container-fluid p-3">

        <div class="col-8">
            <form method="POST" action="{{ route('updateTierItem', [$promotion->id, $tier->id, $tierItem->id, 'id']) }}">

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="tier_item_id" value="{{ $tierItem->id }}"/>

                    <label for="shortDescription">Short Description</label>
                    <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                           placeholder="Short Description" required value="{{$tierItem->short_description}}">
                </div>

                <div class="form-group">
                    <label for="longDescription">Long Description</label>
                    <input type="text" class="form-control" id="longDescription" name="longDescription"
                           placeholder="Long Description" required value="{{$tierItem->long_description}}">
                </div>

                <div class="form-group">
                    <label for="couponNumber">Coupon Number</label>
                    <input type="text" class="form-control" id="couponNumber" name="couponNumber"
                           placeholder="Coupon Number" required value="{{$tierItem->coupon_number}}">
                </div>

                <div class="form-group">
                    <label for="partner">Partner</label>
                    <select class="form-control" id="partnerId" name="partnerId">
                        @foreach ($partners as $partner)
                            <option value="{{ $partner->id }}" @php if($partner->id == $tierItem->partner_id){echo 'selected';} @endphp>{{ $partner->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" min="1" class="form-control" id="quantity" name="quantity"
                           placeholder="Coupon Number" required value="{{$tierItem->quantity}}">
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
