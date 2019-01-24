@extends('master')

@section('title', 'FAQs')

@section('content')

    @php
        /** @var \App\Models\FAQ $faq */
        /** @var \App\Models\FAQGroup $faqGroup */
        $promotion = $faqGroup->promotion;
    @endphp

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promotionIndex') }}">Promotions</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('promotionDetails', [$promotion->id]) }}">{{ $promotion->name }}</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('FAQGroupDetails', [$promotion->id, $faqGroup->id]) }}">{{ $faqGroup->name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
        </ol>
    </nav>

    @php /** @var $promotion \App\Models\Promotion **/
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

    <div class="row">

        <div class="container-fluid">

            <div class="container"><h2>FAQ Details</h2></div>
            <div class="container-fluid p-3">

                <h4>FAQ: {{$faq->title }}</h4>

                <form method="POST" action="{{ route('updateFAQ', [$promotion->id, $faqGroup->id, $faq->id]) }}">

                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="faq_id" value="{{ $faq->id }}">

                    <div class="form-group">
                        <label for="order">FAQ Order</label>
                        <input type="number" min="1" class="form-control" id="order" name="order"
                               aria-describedby="orderHelp" required
                               placeholder="Enter order" value="{{$faq->order}}">
                        <small id="orderHelp" class="form-text text-muted">E.g. '2'. This must be unique within the FAQ
                            Group.
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               aria-describedby="titleHelp" required
                               placeholder="Enter FAQ title" value="{{$faq->title}}">
                        <small id="titleHelp" class="form-text text-muted">E.g. 'How do I claim my prize?'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="bodyText">Body Text</label>
                        <textarea class="form-control" id="bodyText" name="bodyText">{{ $faq->body_text }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>


            </div>


        </div>

    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#bodyText').summernote({});
        });

    </script>



@endsection

