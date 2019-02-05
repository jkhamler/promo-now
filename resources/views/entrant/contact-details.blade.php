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
                @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                    <li>Address 1: {{ $address->address_line_1 }}</li>
                    <li>Address 2: {{ $address->address_line_2 }}</li>
                    <li>Address 3: {{ $address->address_line_3 }}</li>
                    <li>Town/city: {{ $address->city }}</li>
                    <li>County/state: {{ $address->state }}</li>
                    <li>Postcode: {{ $address->postcode }}</li>
                    <li>Country: {{ $address->country->name }}</li>
                @else
                    <li>Address 1: {{ str_limit($address->address_line_1, 2, '***') }}</li>
                    <li>Address 2: {{ str_limit($address->address_line_2, 2, '***') }}</li>
                    <li>Address 3: {{ str_limit($address->address_line_3, 2, '***') }}</li>
                    <li>Town/city: {{ str_limit($address->city, 2, '***') }}</li>
                    <li>County/state: {{ str_limit($address->state, 2, '***') }}</li>
                    <li>Postcode: {{ str_limit($address->postcode, 2, '***') }}</li>
                    <li>Country: {{ str_limit($address->country->name, 2, '***') }}</li>
                @endif

            </ul>

        @endforeach


    </div>
</div>