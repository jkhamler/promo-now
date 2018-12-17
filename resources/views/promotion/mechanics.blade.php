<?php
/** @var $promotion \App\Models\Promotion */
?>

<div class="tab-pane fade" id="mechanics" role="tabpanel" aria-labelledby="mechanics-tab">

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
                data-target=".create-mechanic-modal">Create
            Mechanic
        </button>
    </div>

    <div class="container-fluid p-3">
        <h4>Mechanics</h4>


        <table class="table">

            <tr>
                <td>Name</td>
                <td>Description</td>
                <td colspan="2">Type</td>
            </tr>

            <tbody>

            <?php

            ?>

            @foreach ($promotion->mechanics as $mechanic)
                @php /** @var $mechanic \App\Models\Mechanic */@endphp
                <tr class="clickable-row">
                    <td>{{ $mechanic->name }}</td>
                    <td>{{ $mechanic->description }}</td>
                    <td>{{ $mechanic->getTypeLabel() }}</td>
                    <td>
                        <form action="/promotions/{{ $promotion->id }}/mechanics/{{$mechanic->id}}">
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
<div class="modal fade create-mechanic-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Create Mechanic</h2>

                <form method="POST" action="{{ route('createMechanic') }}">

                    @csrf
                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}"/>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               aria-describedby="nameHelp" required
                               placeholder="Enter mechanic name">
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

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            @foreach ($mechanicTypes as $mechanicTypeValue => $mechanicTypeLabel)
                                <option value="{{ $mechanicTypeValue }}">{{ $mechanicTypeLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>
