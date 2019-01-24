<div class="tab-pane fade show active" id="tierBasics" role="tabpanel"
     aria-labelledby="tier-basics-tab">

    <h2>Tier - {{$tier->short_description}} (Level {{ $tier->level }})</h2>

    <div class="col-8">
        <form method="POST" action="{{ route('updateTier', [$tier->id, 'id']) }}">


            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="level">Level</label>
                <input type="text" class="form-control" id="level" name="level"
                       aria-describedby="nameHelp" required
                       placeholder="Enter level" value="{{$tier->level}}">
            </div>

            <div class="form-group">
                <label for="shortDescription">Short Description</label>
                <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                       placeholder="Short Description" required value="{{$tier->short_description}}">
            </div>

            <div class="form-group">
                <label for="longDescription">Long Description</label>
                <input type="text" class="form-control" id="longDescription" name="longDescription"
                       placeholder="Long Description" required value="{{$tier->long_description}}">
            </div>

            <div class="form-group">
                <label for="quantity">Item Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                       placeholder="Quantity" min="1" required value="{{$tier->quantity}}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</div>