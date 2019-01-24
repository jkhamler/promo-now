<div class="tab-pane fade show active" id="urnSpecification" role="tabpanel"
     aria-labelledby="urn-specification-tab">

    <h2>URN Specification</h2>

    @php
        /** @var $urnSpecification \App\Models\UrnSpecification */
    @endphp

    <div class="col-8">
        <form method="POST"
              action="{{ route('updateUrnSpecification', [$promotion->id, $urnSpecification->id, 'id']) }}">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="referenceId">Reference ID</label>
                <input type="text" class="form-control" id="referenceId" name="referenceId"
                       aria-describedby="referenceIdHelp" required
                       placeholder="Enter reference ID" value="{{$urnSpecification->reference_id}}">
            </div>

            <div class="form-group">
                <label for="purpose">Purpose</label>
                <select class="form-control" id="purpose" name="purpose">
                    @foreach ($urnSpecificationPurposes as $purposeValue => $purposeLabel)
                        <option value="{{ $purposeValue }}" @php if($urnSpecification->purpose == $purposeValue){
                                $selectedPurposeLabel = $purposeLabel;
                                echo 'selected';}@endphp>{{ $purposeLabel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="length">Length</label>
                <input type="number" class="form-control" id="length" name="length"
                       aria-describedby="levelHelp" min="1" value="{{ $urnSpecification->length }}"
                       placeholder="Enter length">
                <small id="levelHelp" class="form-text text-muted">E.g. '5000'
                </small>
            </div>

            <div class="form-group">
                <label for="includedChars">Included Characters</label>
                <input type="text" class="form-control" id="includedChars" name="includedChars"
                       aria-describedby="includedCharsHelp"
                       placeholder="Enter included chars" value="{{ $urnSpecification->included_characters }}">
                <small id="includedCharsHelp" class="form-text text-muted">E.g. 'ABCDEFGH12345
                </small>
            </div>

            <div class="form-group">
                <label for="regexExclude">Regex Exclude</label>
                <input type="text" class="form-control" id="regexExclude" name="regexExclude"
                       aria-describedby="regexExcludeHelp"
                       placeholder="Enter regex exclude" value="{{ $urnSpecification->regexExclude }}">
                <small id="regexExcludeHelp" class="form-text text-muted">E.g. '^A-Z*$'
                </small>
            </div>

            <div class="form-group">
                <label for="profanityCheckLanguageId">Profanity Check Language</label>
                <select class="form-control" id="profanityCheckLanguageId" name="profanityCheckLanguageId">
                    <option value='0'>Not Selected</option>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}"@php $selectedProfanityCheckLanguage = null; if($urnSpecification->profanity_check_language_id == $language->id){
                                $selectedProfanityCheckLanguage = $language->name;
                                echo 'selected';}@endphp>{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="urnQuantity">URN Quantity</label>
                <input type="number" class="form-control" id="urnQuantity" name="urnQuantity"
                       aria-describedby="urnQuantityHelp" min="1"
                       placeholder="Enter URN quantity" value="{{ $urnSpecification->urn_quantity }}">
                <small id="urnQuantityHelp" class="form-text text-muted">E.g. '5000'
                </small>
            </div>

            <div class="form-group">
                <label for="winningUrnQuantity">Winning URN Quantity</label>
                <input type="number" class="form-control" id="winningUrnQuantity" name="winningUrnQuantity"
                       aria-describedby="winningUrnQuantityHelp" min="1"
                       placeholder="Enter Winning URN quantity" value="{{ $urnSpecification->winning_urn_quantity }}">
                <small id="winningUrnQuantityHelp" class="form-text text-muted">E.g. '800'
                </small>
            </div>

            <div class="checkbox">
                <label><input type="checkbox" id="piToGenerate"
                              name="piToGenerate"@php if($urnSpecification->pi_to_generate){echo 'checked';} @endphp>PromotionsInteractive
                    to Generate</label>
            </div>

            <div class="checkbox">
                <label><input type="checkbox"
                              name="everyoneGets"@php if($urnSpecification->everyone_gets){echo 'checked';} @endphp>Everyone
                    Gets</label>
            </div>

            <div class="checkbox">
                <label><input type="checkbox"
                              name="allocatedByTier"@php if($urnSpecification->allocated_by_tier){echo 'checked';} @endphp>Allocated
                    by Tier</label>
            </div>

            <div class="float-left">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <button type="button" class="btn btn-primary float-right" data-toggle="modal" id="generateURNsButton"
                data-target=".generate-url-batch-modal" @php if(!$urnSpecification->pi_to_generate){echo "style='display: none;'";} @endphp>
            Generate URN Batch
        </button>

        <br/>

    </div>
</div>


<!-- Modal -->
<div class="modal fade generate-url-batch-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Generate URN Batch</h2>

                <form method="POST" action="{{ route('generateUrnBatch', [$promotion->id, $urnSpecification->id]) }}">

                    <div class="form-group">
                        @csrf
                        <label for="batchName">Name</label>
                        <input type="text" class="form-control" id="batchName" name="batchName"
                               aria-describedby="nameHelp" required
                               placeholder="Enter batch name">
                        <small id="nameHelp" class="form-text text-muted">E.g. 'Batch 1'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <input type="text" class="form-control" id="purpose" name="purpose"
                               disabled value="{{ $selectedPurposeLabel }}">
                    </div>

                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="text" class="form-control" id="length" name="length"
                               disabled value="{{ $urnSpecification->length }}">
                    </div>

                    <div class="form-group">
                        <label for="includedChars">Included Characters</label>
                        <input type="text" class="form-control" id="includedChars" name="includedChars"
                               disabled value="{{ $urnSpecification->included_characters }}">
                    </div>

                    <div class="form-group">
                        <label for="regexExclude">Regex Exclude</label>
                        <input type="text" class="form-control" id="regexExclude" name="regexExclude"
                               disabled value="{{ $urnSpecification->regex_exclude }}">
                    </div>

                    <div class="form-group">
                        <label for="profanityCheckLanguage">Profanity Check Language</label>
                        <input type="text" class="form-control" id="profanityCheckLanguage"
                               name="profanityCheckLanguage"
                               disabled value="{{ $selectedProfanityCheckLanguage }}">
                    </div>

                    <div class="form-group">
                        <label for="profanityCheckLanguageId">Profanity Check Language</label>
                        <select class="form-control" id="profanityCheckLanguageId" name="profanityCheckLanguageId" disabled>
                            <option value='0'>Not Selected</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}"@php $selectedProfanityCheckLanguage = null; if($urnSpecification->profanity_check_language_id == $language->id){
                                $selectedProfanityCheckLanguage = $language->name;
                                echo 'selected';}@endphp>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="urnQuantity">URN Quantity</label>
                        <input type="text" class="form-control" id="urnQuantity" name="urnQuantity"
                               disabled value="{{ $urnSpecification->urn_quantity }}">
                    </div>

                    <div class="form-group">
                        <label for="winningUrnQuantity">Winning URN Quantity</label>
                        <input type="text" class="form-control" id="winningUrnQuantity" name="winningUrnQuantity"
                               disabled value="{{ $urnSpecification->winning_urn_quantity }}">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox"
                                      disabled
                                      name="piToGenerate"@php if($urnSpecification->pi_to_generate){echo 'checked';} @endphp>PI to generate</label>
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox"
                                      disabled
                                      name="everyoneGets"@php if($urnSpecification->everyone_gets){echo 'checked';} @endphp>Everyone
                            Gets</label>
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox"
                                      disabled
                                      name="allocatedByTier"@php if($urnSpecification->allocated_by_tier){echo 'checked';} @endphp>Allocated
                            by Tier</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Generate URNs</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>