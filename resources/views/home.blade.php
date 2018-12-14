<!-- Stored in resources/views/home.blade.php -->

@extends('app')

@section('title', 'PromoNow')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="container-fluid">


        <div>
            <h3>
                Welcome to PromoNow!
            </h3>

            <p>
                The easiest one-stop solution for configuring your promotional campaigns.
            </p>

        </div>

        <br/>

        <div class="row">

            <div class="col-4 border p-3">
                <h4>Todo List</h4>

                <ul>
                    <li>Register Users</li>
                    <li>Define Promotion Details</li>
                </ul>


            </div>


        </div>


    </div>

@endsection