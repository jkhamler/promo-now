@php
    /** @var $faqGroup \App\Models\FAQGroup */
@endphp

<div class="tab-pane fade show" id="faqs" role="tabpanel"
     aria-labelledby="faqs-tab">

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


        <h2>{{ $faqGroup->name }}</h2>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target=".create-faq-modal">Create FAQ
        </button>

    </div>

    <div class="container-fluid p-3">
        <h4>FAQs</h4>

        {{--<table id="faqTable" class="table table-striped table-bordered hover" style="width: 100%;">--}}
        {{--<thead>--}}
        {{--<tr>--}}
        {{--<td>Order</td>--}}
        {{--<td>Title</td>--}}
        {{--<td>Body Text</td>--}}
        {{--</tr>--}}
        {{--</thead>--}}

        {{--<tbody id="tableContents">--}}

        {{--@foreach ($faqGroup->faqs as $faq)--}}
        {{--@php /** @var $faq \App\Models\FAQ */--}}
        {{--@endphp--}}
        {{--<tr class="row1" data-id="{{ $faq->id }}"--}}
        {{--data-href="{{ route('FAQDetails', [$promotion->id, $faqGroup->id, $faq->id]) }}">--}}
        {{--<td>{{ $faq->order }}</td>--}}
        {{--<td>{{ $faq->title }}</td>--}}
        {{--<td>{{ $faq->body_text }}</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}

        {{--</tbody>--}}
        {{--</table>--}}

        <table id="faqTable" class="table table-striped table-bordered hover" style="width: 100%;">
            <thead>
            <tr>
                <th>Order</th>
                <th>Title</th>
                <th>Body Text</th>
            </tr>
            </thead>
            <tbody id="tableContents">
            </tbody>
        </table>

    </div>

</div>

<!-- jQuery UI -->
<script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('#faqTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": '{{ route('FAQListData', [$promotion->id, $faqGroup->id]) }}',
            "columns": [
                {"data": "order"},
                {"data": "title"},
                {"data": "body_text"},
            ],
        });

    });

    // $('#faqTable').on('click', 'tbody tr', function () {
    //     window.location.href = $(this).data('href');
    // });

    $("#tableContents").sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function () {
            sendOrderToServer();
        }
    });


    function sendOrderToServer() {

        var order = [];
        $('tr').each(function (index, element) {
        // $('tr.row1').each(function (index, element) {
            order.push({
                id: $(this).attr('id'),
                position: index
            });
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('reorderFAQs', [$promotion->id, $faqGroup->id]) }}",
            data: {
                order: order,
                _token: '{{csrf_token()}}'
            },
            success: function (response) {
                if (response.status == "success") {

                    var table = $('#faqTable').DataTable();
                    table.clear().draw();

                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });

    }


</script>

<!-- Create FAQ Modal -->
<div class="modal fade create-faq-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Tier Item</h2>

                <form method="POST" action="{{ route('createFAQ', [$promotion->id, $faqGroup->id]) }}">


                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" min="1" class="form-control" id="order" name="order"
                               placeholder="Order" required>
                    </div>

                    <div class="form-group">

                        @csrf
                        <input type="hidden" name="faq_group_id" value="{{ $faqGroup->id }}"/>

                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               aria-describedby="titleHelp" required
                               placeholder="Enter title">
                        <small id="titleHelp" class="form-text text-muted">E.g. 'How do I claim my prize?'
                        </small>
                    </div>


                    <div class="form-group">
                        <label for="bodyText">Body Text</label>
                        <textarea class="form-control" id="bodyText" name="bodyText"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button id="deleteButton" type="button" class="btn btn-outline-primary" data-dismiss="modal">
                        Cancel
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

