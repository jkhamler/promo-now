@php
    /** @var $faqGroup \App\Models\FAQGroup */
@endphp

<div class="tab-pane fade show active" id="faqBasics" role="tabpanel"
     aria-labelledby="faq-basics-tab">

    <h2>FAQ Group - {{ $faqGroup->name }}</h2>

    <div class="col-8">
        <form method="POST" action="{{ route('updateFAQGroup', [$promotion->id, $faqGroup->id]) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <input type="hidden" name="faq_group_id" value="{{ $faqGroup->id }}"/>

                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       aria-describedby="nameHelp" required
                       placeholder="Enter level" value="{{$faqGroup->name}}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="Description" value="{{$faqGroup->description}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</div>