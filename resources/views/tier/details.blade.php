@extends('app')

@section('title', 'Tiers')

@section('content')

    @php

        /** @var \App\Models\Tier $tier */

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

    <h3>Items</h3>

    <div class="row">

        <table class="table">

            <tr>
                <td>Short Description</td>
                <td>Long Description</td>
                <td>Coupon Number</td>
                <td>Quantity</td>
                <td colspan="2">Partner</td>
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
                        <form action="/items/{{$tierItem->id}}">
                            <input type="submit" value="View/Edit" disabled/>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>


@endsection

