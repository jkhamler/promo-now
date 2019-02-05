<div class="tab-pane fade show active" id="entrantBasics" role="tabpanel"
     aria-labelledby="entrant-basics-tab">

    <div class="container"><h2>Entrant Details - {{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        @php
            /** @var $entrant \App\Models\Entrant */
        @endphp

        <h4>Entrant Details</h4>

        <ul>
            @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                <li>Entrant: {{ $entrant->person->getFullName() }}</li>
                <li>Entrant Email: {{$entrant->person->email_address}}</li>
            @else
                <li>Entrant: {{ str_limit($entrant->person->first_name, 2, '***') }} {{ str_limit($entrant->person->surname, 2, '***') }}</li>
                <li>Entrant Email: {{$entrant->person->emailMasked()}}</li>
            @endif
            <li>URN: {{ $entrant->urn->urn }}</li>
            <li>Entry date/time: {{ $entrant->created_at }}</li>
        </ul>

    </div>


</div>