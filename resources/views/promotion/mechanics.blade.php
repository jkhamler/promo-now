<div class="tab-pane fade" id="mechanics" role="tabpanel" aria-labelledby="mechanics-tab">
    <div class="container"><h2>{{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">
        <h3>Mechanics</h3>
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

    <div class="row">

        <table class="table">

            <tr>
                <td>Name</td>
                <td>Description</td>
                <td>Type</td>
            </tr>

            <tbody>

            <?php

            ?>

            @foreach ($promotion->mechanics as $mechanic)
                <tr class="clickable-row">
                    <td>{{ $mechanic->name }}</td>
                    <td>{{ $mechanic->description }}</td>
                    <td>{{ $mechanic->type }}</td>
                    <td>
                        <form action="/mechanics/{{$mechanic->id}}">
                            <input type="submit" value="View/Edit"/>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

</div>