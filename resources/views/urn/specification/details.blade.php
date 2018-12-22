@extends('app')

@section('title', 'Promotion - Mechanics')

@section('content')

    @php
        /** @var \App\Models\UrnSpecification $urnSpecification */
    @endphp


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/promotions">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="/promotions/{{ $promotion->id }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">URN Specification Details</li>
        </ol>
    </nav>

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

    <h2>URN Specification</h2>

    <div class="col-8">
        <form method="POST" action="{{ route('updateUrnSpecification', [$urnSpecification->id, 'id']) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="level">Level</label>
                <input type="text" class="form-control" id="level" name="level"
                       aria-describedby="nameHelp" required
                       placeholder="Enter level" value="{{$urnSpecification->level}}">
            </div>

            <div class="form-group">
                <label for="shortDescription">Short Description</label>
                <input type="text" class="form-control" id="shortDescription" name="shortDescription"
                       placeholder="Short Description" required value="{{$urnSpecification->short_description}}">
            </div>

            <div class="form-group">
                <label for="longDescription">Long Description</label>
                <input type="text" class="form-control" id="longDescription" name="longDescription"
                       placeholder="Long Description" required value="{{$urnSpecification->long_description}}">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                       placeholder="Quantity" min="1" required value="{{$urnSpecification->quantity}}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <br/>




@endsection

