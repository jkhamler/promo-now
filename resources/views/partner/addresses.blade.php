<?php
/** @var $partner \App\Models\Partner */
?>

<div class="tab-pane fade" id="addresses" role="tabpanel"
     aria-labelledby="addresses-tab">

    <div class="container">
        <h2>{{ $partner->name }}</h2>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-urn-specification-modal">Create Address
        </button>
    </div>

    <div class="container-fluid p-3">
        <h4>Addresses</h4>

        <table class="table">
            <tr>
                <td>Reference ID</td>
                <td>Purpose</td>
                <td>Length</td>
                <td>Quantity</td>
                <td>Winning Quantity</td>
            </tr>
            <tbody>

            {{--@foreach ($partner->urnSpecifications as $urnSpecification)--}}
                {{--@php--}}
                    {{--/** @var $urnSpecification \App\Models\UrnSpecification */--}}
                {{--@endphp--}}
                {{--<tr class="clickable-row">--}}
                    {{--<td>{{ $urnSpecification->reference_id }}</td>--}}
                    {{--<td>{{ $urnSpecification->getPurposeLabel() }}</td>--}}
                    {{--<td>{{ $urnSpecification->length }}</td>--}}
                    {{--<td>{{ $urnSpecification->urn_quantity }}</td>--}}
                    {{--<td>{{ $urnSpecification->winning_urn_quantity }}</td>--}}
                    {{--<td>--}}
                        {{--<form action="/partners/{{$partner->id}}/urn-specifications/{{$urnSpecification->id}}">--}}
                            {{--<input type="submit" value="View/Edit"/>--}}
                        {{--</form>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}

            </tbody>
        </table>
    </div>

</div>