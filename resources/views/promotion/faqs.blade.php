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

        <table id="faqGroupsTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <td>Name</td>
                <td>Description</td>
            </tr>
            </thead>
            <tbody>

            @foreach ($promotion->faqGroups as $faqGroup)
                @php
                    /** @var $faqGroup \App\Models\FAQGroup */
                @endphp
                <tr data-href="{{ route('FAQGroupDetails', [$promotion->id, $faqGroup->id]) }}">
                    <td>{{ $faqGroup->name }}</td>
                    <td>{{ $faqGroup->description }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#faqGroupsTable').DataTable();
    });

    $('#faqGroupsTable').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
</script>


<!-- Modal -->
<div class="modal fade create-faq-group-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create FAQ Group for Promotion - {{ $promotion->name }}</h2>

                <form method="POST" action="{{ route('createFAQGroup', [$promotion->id]) }}">
                    @csrf

                    <input type="hidden" name="promotionId" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               aria-describedby="nameHelp" required
                               placeholder="Enter name">
                        <small id="nameHelp" class="form-text text-muted">E.g. 'General FAQs'
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                               aria-describedby="descriptionHelp" required
                               placeholder="Enter description">
                        <small id="descriptionHelp" class="form-text text-muted">E.g. 'General FAQs Description'
                        </small>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>