<div class="tab-pane fade show active" id="mechanicBasics" role="tabpanel"
     aria-labelledby="mechanic-basics-tab">

    <div class="container"><h2>Mechanic Details - {{ $promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        <h4>Type: {{$mechanic->getTypeLabel()}}</h4>

        <form method="POST" action="{{ route('updateMechanic', [$mechanic->id, 'id']) }}">

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="URL" required value="{{$mechanic->getTypeLabel()}}">
            </div>


            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       aria-describedby="nameHelp" required
                       placeholder="Enter mechanic name" value="{{$mechanic->name}}">
                <small id="nameHelp" class="form-text text-muted">E.g. 'Instant Win 123'
                </small>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="URL" required value="{{$mechanic->description}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>


    </div>
</div>