<div class="tab-pane fade show active" id="faqBasics" role="tabpanel"
     aria-labelledby="faq-basics-tab">

    <h2>FAQ - {{$faqGroup->short_description}}</h2>

    <div class="col-8">
        <form method="POST" action="{{ route('updateFAQGroup', [$promotion->id, $faqGroup->id]) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="level">Level</label>
                <input type="text" class="form-control" id="level" name="level"
                       aria-describedby="nameHelp" required
                       placeholder="Enter level" value="{{$faqGroup->level}}">
            </div>

            <div class="form-group">
                <label for="shortDescription">Short Description</label>
                <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                       placeholder="Short Description" required value="{{$faqGroup->short_description}}">
            </div>

            <div class="form-group">
                <label for="longDescription">Long Description</label>
                <input type="text" class="form-control" id="longDescription" name="longDescription"
                       placeholder="Long Description" required value="{{$faqGroup->long_description}}">
            </div>

            <div class="form-group">
                <label for="quantity">Item Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                       placeholder="Quantity" min="1" required value="{{$faqGroup->quantity}}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</div>