<div class="tab-pane fade show" id="itemDetails" role="tabpanel"
     aria-labelledby="item-details-tab">

    <div class="container"><h2>Entrant Details - {{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">


        <h4>Item Details</h4>


        @foreach($entrant->tierItemStock as $item)
            <ul>
                <li>Item description: {{ $item->tierItem->short_description }}</li>
                <li>Reference number: {{ $item->reference_number }}</li>
                <li>Allocated date/time: {{ $item->allocated_datetime }}</li>
            </ul>
        @endforeach


    </div>
</div>