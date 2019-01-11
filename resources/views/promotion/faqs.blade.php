<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="faqs" role="tabpanel" aria-labelledby="faqs-tab">

    <div class="container">

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

        <h2>{{ $promotion->name }} - FAQs</h2>

    </div>

    <br/>

    <!-- Accordion -->
    <div class="container-fluid bg-gray" id="accordion-style-1">
        <section>
            <div class="row">

                <div class="col-12">
                    <div class="accordion" id="accordionExample">

                        @foreach($promotion->faqGroups as $faqGroup)

                            <div class="card">
                                <div class="card-header" id="heading{{ $loop->iteration }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse"
                                                data-target="#collapse{{ $loop->iteration }}"
                                                aria-expanded="true"
                                                aria-controls="collapse{{ $loop->iteration }}">
                                            <i class="fa fa-amazon main"></i><i
                                                    class="fa fa-angle-double-right mr-3"></i>{{ $faqGroup->name }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse{{ $loop->iteration }}" class="collapse fade"
                                     aria-labelledby="heading{{ $loop->iteration }}"
                                     data-parent="#accordionExample">
                                    <div class="card-body">

                                        @foreach($faqGroup->faqs as $faq)

                                            <h3>{{ $faq->title }}</h3>
                                            <p>{{ $faq->body_text }}</p>

                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </div>


</div>
