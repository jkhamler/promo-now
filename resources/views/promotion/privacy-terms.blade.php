<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="privacyTerms" role="tabpanel" aria-labelledby="privacy-terms-tab">

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

        @php

            if($promotion->outstandingPrivacyTermsPartners()->count() > 0){

            echo <<<EOT
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".create-privacy-term-modal">Create Privacy Terms
            </button>
EOT;

            }

        @endphp

    </div>

    <div class="container-fluid p-3">
        <h4>Privacy Terms</h4>


        <table class="table">

            <tr>
                <td>Version</td>
                <td>Partner</td>
                <td colspan="2">Title</td>
            </tr>

            <tbody>

            @foreach ($promotion->privacyTerms as $privacyTerm)
                @php /** @var $privacyTerm \App\Models\PrivacyTerm */@endphp
                <tr class="clickable-row">
                    <td>{{ $privacyTerm->version }}@if($privacyTerm->isLatestVersion()) (Active) @endif</td>
                    <td>{{ $privacyTerm->partner->name }}</td>
                    <td>{{ $privacyTerm->title }}</td>

                    <td>
                        <form action="/promotions/{{ $promotion->id }}/privacy-terms/{{$privacyTerm->id}}">
                            <input type="submit"
                                   @if($privacyTerm->isLatestVersion()) value="View/Edit"
                                   @else value="View Archive"@endif/>
                        </form>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>

    </div>

</div>

<!-- Modal -->
<div class="modal fade create-privacy-term-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Privacy Terms - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createPrivacyTerms') }}" id="createPrivacyTermsForm">

                    @csrf
                    <input type="hidden" name="promotionId" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="partnerId">Partner</label>
                        <select class="form-control" id="partnerId" name="partnerId">
                            @foreach ($promotion->outstandingPrivacyTermsPartners() as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Title" required>
                    </div>

                    <div class="form-group">
                        <label for="acceptanceText">Acceptance Text</label>
                        <textarea class="form-control" rows="2" id="acceptanceText" name="acceptanceText"
                                  placeholder="E.g. 'I have read and accept the terms and conditions and confirm I am over 18 years old.'"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="terms">Terms</label>
                        <textarea class="form-control" id="privacyTermsBodyText" name="privacyTermsBodyText"
                                  rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="marketingOptIn">Marketing Opt In</label>
                        <textarea class="form-control" rows="2" id="marketingOptIn" name="marketingOptIn"
                                  placeholder="E.g. 'I would like to receive marketing communications.'"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cookieTitle">Cookie Title</label>
                        <input type="text" class="form-control" id="cookieTitle" name="cookieTitle"
                               placeholder="Cookie Title">
                    </div>

                    <div class="form-group">
                        <label for="cookieBodyText">Cookie Terms</label>
                        <textarea class="form-control" id="cookieBodyText" name="cookieBodyText" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gdprEmail">GDPR Email Contact</label>
                        <input type="text" class="form-control" id="gdprEmail" name="gdprEmail"
                               placeholder="e.g. privacyoffer@client.com" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#privacyTermsBodyText').summernote({
            // toolbar: [
            //     // [groupName, [list of button]]
            //     ['style', ['bold', 'italic', 'underline', 'clear']],
            //     ['font', ['strikethrough', 'superscript', 'subscript']],
            //     ['fontsize', ['fontsize']],
            //     ['color', ['color']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['height', ['height']]
            // ]
        });
    });

</script>