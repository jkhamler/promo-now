<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="privacyTerms" role="tabpanel" aria-labelledby="privacy-terms-tab">

    <div class="container-fluid">
        <div class="row">
            <div class="col-6"><h2>{{ $promotion->name }}</h2></div>

            <div class="col-6">
                @php
                    if($promotion->outstandingPrivacyTermsPartners()->count() > 0){
                    echo <<<EOT
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".create-privacy-term-modal">Create Privacy Terms
                    </button>
EOT;
                    }
                @endphp
            </div>

        </div>

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

    </div>

    <div class="container-fluid p-3">
        <h4>Privacy Terms</h4>

        <table id="privacyTermsTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Version</td>
                <td>Partner</td>
                <td>Title</td>
            </tr>
            </thead>
            <tbody>

            @foreach ($promotion->privacyTerms as $privacyTerm)
                @php /** @var $privacyTerm \App\Models\PrivacyTerm */@endphp
                <tr data-href="{{ route('privacyTermDetails', [$promotion->id, $privacyTerm->id]) }}">
                    <td>{{ $privacyTerm->version }}@if($privacyTerm->isLatestVersion()) (Active) @endif</td>
                    <td>{{ $privacyTerm->partner->name }}</td>
                    <td>{{ $privacyTerm->title }}</td>
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

                <form method="POST" action="{{ route('createPrivacyTerms', [$promotion->id]) }}"
                      id="createPrivacyTermsForm">

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
                        <textarea class="form-control" id="acceptanceText" name="acceptanceText"
                                  placeholder="E.g. 'I have read and accept the terms and conditions and confirm I am over 18 years old.'"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="terms">Terms</label>
                        <textarea class="form-control" id="privacyTermsBodyText" name="privacyTermsBodyText"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="marketingOptIn">Marketing Opt In</label>
                        <textarea class="form-control" id="marketingOptIn" name="marketingOptIn"
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
        $('#privacyTermsBodyText').summernote({});
        $('#acceptanceText').summernote({});
        $('#marketingOptIn').summernote({});
        $('#cookieBodyText').summernote({});

        $('#privacyTermsTable').DataTable();
    });

    $('#privacyTermsTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });

</script>