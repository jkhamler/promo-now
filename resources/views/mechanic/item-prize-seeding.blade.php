@php
    /** @var \App\Models\Mechanic $mechanic */
@endphp

<div class="tab-pane fade" id="itemPrizeSeeding" role="tabpanel"
     aria-labelledby="item-prize-seeding-tab">

    <div class="container"><h2>Item/Prize Seeding Details - {{ $mechanic->promotion->name }}</h2></div>
    <div class="container-fluid p-3">

        <div class="row">

            <div class="col-9">

                <h4>Type: {{$mechanic->getTypeLabel()}}</h4>

                <form method="POST" action="{{ route('updateMechanic', [$mechanic->id, 'id']) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">

                        <label for="startDateTime">Start Date/Time</label>
                        <input type="datetime-local" class="form-control" id="startDateTime" name="startDateTime"
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->start_datetime)}}">
                    </div>

                    <div class="form-group">

                        <label for="endDateTime">End Date/Time</label>
                        <input type="datetime-local" class="form-control" id="endDateTime" name="endDateTime"
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->end_datetime)}}">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="isOpen"
                                    @php if($mechanic->is_open){echo 'checked';} @endphp>Is Open</label>
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="isRecyclable"
                                    @php if($mechanic->is_recyclable){echo 'checked';} @endphp>Is Recyclable</label>
                    </div>

                    <div class="form-group">

                        <label for="claimWindowDurationSeconds">Claim Window Duration (Secs)</label>
                        <input type="number" class="form-control" id="claimWindowDurationSeconds"
                               name="claimWindowDurationSeconds"
                               value="{{ $mechanic->claim_window_duration_seconds }}">
                    </div>

                    <div class="form-group">

                        <label for="claimWindowDeadline">Claim Window Date/Time</label>
                        <input type="datetime-local" class="form-control" id="claimWindowDeadline"
                               name="claimWindowDeadline"
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->claim_window_deadline)}}">
                    </div>

                    <div class="form-group">

                        <label for="drawDateTime">Draw Date/Time</label>
                        <input type="datetime-local" class="form-control" id="drawDateTime"
                               name="drawDateTime"
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->draw_datetime)}}">
                    </div>

                    <div class="form-group">

                        <label for="drawEntrantsDeadline">Draw Entrants Deadline</label>
                        <input type="datetime-local" class="form-control" id="drawEntrantsDeadline"
                               name="drawEntrantsDeadline"
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->draw_entrants_deadline)}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
</div>