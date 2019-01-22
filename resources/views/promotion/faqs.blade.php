<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="faqs" role="tabpanel"
     aria-labelledby="faqs-tab">

    <div class="container">
        <h2>{{ $promotion->name }}</h2>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-faq-group-modal">Create FAQ Group
        </button>
    </div>

    <div class="container-fluid p-3">
        <h4>FAQ Groups</h4>

        <table class="table">
            <tr>
                <td>Name</td>
                <td>Description</td>
            </tr>
            <tbody>

            @foreach ($promotion->faqGroups as $faqGroup)
                @php
                    /** @var $faqGroup \App\Models\FAQGroup */
                @endphp
                <tr class="clickable-row">
                    <td>{{ $faqGroup->name }}</td>
                    <td>{{ $faqGroup->description }}</td>
                    <td>
                        <form action="{{ route('faqGroupDetails', [$promotion->id, $faqGroup->id]) }}">
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
<div class="modal fade create-faq-group-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create URN Specification for Promotion - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createUrnSpecification') }}">
                    @csrf

                    <input type="hidden" name="promotionId" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="referenceId">Reference ID</label>
                        <input type="text" class="form-control" id="referenceId" name="referenceId"
                               aria-describedby="levelHelp" required
                               placeholder="Enter Reference ID">
                        <small id="nameHelp" class="form-text text-muted">E.g. '5000 Winning Codes'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <select class="form-control" id="purpose" name="purpose">
                            @foreach ($urnSpecificationPurposes as $purposeValue => $purposeLabel)
                                <option value="{{ $purposeValue }}">{{ $purposeLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="number" class="form-control" id="length" name="length"
                               aria-describedby="levelHelp" required min="1"
                               placeholder="Enter length">
                        <small id="levelHelp" class="form-text text-muted">E.g. '5000'
                        </small>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>