<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">

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


        <h2>{{ $promotion->name }}</h2>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-promo-term-modal">Create Promo Terms
        </button>
    </div>

    <div class="container-fluid p-3">
        <h4>Terms</h4>


        <table class="table">

            <tr>
                <td>Name</td>
                <td>Description</td>
                <td colspan="2">Type</td>
            </tr>

            <tbody>

            <?php

            ?>

            @foreach ($promotion->promoTerms as $term)
                @php /** @var $term \App\Models\PromoTerm */@endphp
                <tr class="clickable-row">
                    <td>{{ $term->name }}</td>
                    <td>{{ $term->description }}</td>
                    <td>{{ $term->getTypeLabel() }}</td>
                    <td>
                        <form action="/promotions/{{ $promotion->id }}/terms/{{$term->id}}">
                            <input type="submit" value="View/Edit"/>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

</div>

<!-- Modal -->
<div class="modal fade create-promo-term-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Term</h2>

                <form method="POST" action="{{ route('createPromoTerms') }}">

                    @csrf
                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               aria-describedby="nameHelp" required
                               placeholder="Enter term name">
                        <small id="nameHelp" class="form-text text-muted">E.g. 'Winning Moment 123'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                               placeholder="Description" required>
                        <small id="nameHelp" class="form-text text-muted">E.g. 'Winning moment 123 description'
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>
