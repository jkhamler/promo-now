<div class="tab-pane fade show" id="contactDetails" role="tabpanel"
     aria-labelledby="contact-details-tab">

    <div class="container"><h2>Entrant Details - {{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        <h4>Contact Address</h4>

        @foreach($entrant->person->addresses as $address)
            @php
                /** @var $address \App\Models\Address */
            @endphp
            <ul>
                <li>Address 1: {{ $address->address_line_1 }}</li>
                <li>Address 2: {{ $address->address_line_2 }}</li>
                <li>Address 3: {{ $address->address_line_3 }}</li>
                <li>Town/city: {{ $address->city }}</li>
                <li>County/state: {{ $address->state }}</li>
                <li>Postcode: {{ $address->postcode }}</li>
                <li>Country: {{ $address->country->name }}</li>
            </ul>

        @endforeach


    </div>
</div>