@extends('app')

@section('title', 'Tiers')

@section('content')

    @php

        /** @var \App\Models\Tier $tier */
        /** @var \App\Models\Partner[] $partners */

        $promotion = $tier->promotion;


    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/promotions">Promotions</a></li>
            <li class="breadcrumb-item"><a href="/promotions/{{ $promotion->id }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$tier->short_description}}</li>
        </ol>
    </nav>

    @php /** @var $tier \App\Models\Tier **/
    @endphp

    @if ($errors->any())
        <div class="row">
            <div class="col-6">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    @endif

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
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                       placeholder="Quantity" min="1" required value="{{$tier->quantity}}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <br/>


    <!-- Tier Items-->

    <div class="row">
        <div class="col-9"><h3>Items</h3></div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right m-3" data-toggle="modal"
                    data-target=".bd-example-modal-lg">Create Tier Item
            </button>
        </div>
    </div>


    <div class="row">

        <table class="table">

            <tr>
                <td>Short Description</td>
                <td>Long Description</td>
                <td>Coupon Number</td>
                <td>Quantity</td>
                <td colspan="3">Partner</td>
            </tr>

            <tbody>

            @foreach ($tier->items as $tierItem)
                <tr class="clickable-row">
                    <td>{{ $tierItem->short_description }}</td>
                    <td>{{ $tierItem->long_description }}</td>
                    <td>{{ $tierItem->coupon_number }}</td>
                    <td>{{ $tierItem->quantity }}</td>
                    <td>{{ $tierItem->partner->name }}</td>
                    <td>
                        <form action="/tiers/items/{{$tierItem->id}}">
                            <input type="submit" value="View/Edit"/>
                        </form>
                    </td>
                    <td>
                        <i class="fas fa-trash-alt" data-toggle="modal" data-tier-item-id="{{ $tierItem->id }}"
                           data-target=".delete-tier-item"></i>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

    <!-- Create Tier Item Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="container-fluid p-3">

                    <h2>Create Tier Item</h2>

                    <form method="POST" action="{{ route('createTierItem') }}">

                        <div class="form-group">

                            @csrf
                            <input type="hidden" name="tier_id" value="{{ $tier->id }}"/>

                            <label for="shortDescription">Short Description</label>
                            <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                                   aria-describedby="shortDescriptionHelp" required
                                   placeholder="Enter short description">
                            <small id="shortDescriptionHelp" class="form-text text-muted">E.g. 'LCD TV'
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="longDescription">Long Description</label>
                            <input type="text" class="form-control" id="longDescription" name="longDescription"
                                   aria-describedby="longDescriptionHelp" required
                                   placeholder="Enter long description">
                            <small id="longDescriptionHelp" class="form-text text-muted">E.g. '40 Inch LCD TV'
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Coupon Number</label>
                            <input type="text" class="form-control" id="couponNumber" name="couponNumber"
                                   aria-describedby="couponNumberHelp" required
                                   placeholder="Enter coupon number">
                            <small id="couponNumberHelp" class="form-text text-muted">E.g. ABC12345
                            </small>

                        </div>
                        <div class="form-group">
                            <label for="description">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                   required placeholder="Enter quantity">
                        </div>

                        <div class="form-group">
                            <label for="partnerId">Partner</label>
                            <select class="form-control" id="partnerId" name="partnerId">
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}" @php if($partner->id == $tierItem->partner_id){echo 'selected';} @endphp>{{ $partner->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button id="deleteButton" type="button" class="btn btn-outline-primary" data-dismiss="modal">
                            Cancel
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Tier Item Modal -->

    <div class="modal fade delete-tier-item" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete this item?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>TODO...</b></p>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

<script type="text/javascript">

    // todo - set hidden 'tier item id' property of form in modal


</script>

