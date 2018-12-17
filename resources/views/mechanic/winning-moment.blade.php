@php
    /** @var \App\Models\Mechanic $mechanic */
@endphp

<div class="tab-pane fade" id="winningMoment" role="tabpanel"
     aria-labelledby="winning-moment-tab">

    <div class="container"><h2>Winning Moment Details - {{ $mechanic->promotion->name }}</h2></div>
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
                               required
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->start_datetime)}}">
                    </div>

                    <div class="form-group">

                        <label for="endDateTime">End Date/Time</label>
                        <input type="datetime-local" class="form-control" id="endDateTime" name="endDateTime"
                               required
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->end_datetime)}}">
                    </div>

                    <div class="form-group">

                        <label for="isOpen">Is Open</label>
                        <input type="checkbox" class="form-control" id="isOpen" name="isOpen"
                                @php if($mechanic->is_open){echo 'checked';} @endphp>
                    </div>

                    <div class="form-group">

                        <label for="isRecyclable">Is Recyclable</label>
                        <input type="checkbox" class="form-control" id="isRecyclable" name="isRecyclable"
                                @php if($mechanic->is_recyclable){echo 'checked';} @endphp>
                    </div>

                    <div class="form-group">

                        <label for="claimWindowDurationSeconds">Claim Window Duration (Secs)</label>
                        <input type="number" class="form-control" id="claimWindowDurationSeconds"
                               name="claimWindowDurationSeconds"
                               required
                               value="{{ $mechanic->claim_window_duration_seconds }}">
                    </div>

                    <div class="form-group">

                        <label for="claimWindowDeadline">Claim Window Date/Time</label>
                        <input type="datetime-local" class="form-control" id="claimWindowDeadline"
                               name="claimWindowDeadline"
                               required
                               value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->claim_window_deadline)}}">
                    </div>

                    {{--<div class="form-group">--}}

                        {{--<label for="drawDateTime">Draw Date/Time</label>--}}
                        {{--<input type="datetime-local" class="form-control" id="drawDateTime" name="drawDateTime"--}}
                               {{--required--}}
                               {{--value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->draw_datetime)}}">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}

                        {{--<label for="drawEntrantsDeadline">Draw Entrants Deadline</label>--}}
                        {{--<input type="datetime-local" class="form-control" id="drawEntrantsDeadline"--}}
                               {{--name="drawEntrantsDeadline"--}}
                               {{--required--}}
                               {{--value="{{ \App\Models\Promotion::dateFieldFormat($mechanic->draw_entrants_deadline)}}">--}}
                    {{--</div>--}}

                    <div class="form-group">

                        <label for="piToGenerateMoments">PI To Generated Moments</label>
                        <input type="checkbox" class="form-control" id="piToGenerateMoments" name="piToGenerateMoments"
                                @php if($mechanic->pi_to_generate_moments){echo 'checked';} @endphp>
                    </div>

                    <div class="form-group">

                        <label for="momentDurationSeconds">Moment Duration (Secs)</label>
                        <input type="number" class="form-control" id="momentDurationSeconds"
                               name="momentDurationSeconds"
                               required
                               value="{{ $mechanic->moment_duration_seconds }}">
                    </div>

                    <div class="form-group">

                        <label for="momentDistributionInterval">Moment Distribution Interval (Secs)</label>
                        <input type="number" class="form-control" id="momentDistributionInterval"
                               name="momentDistributionInterval"
                               required
                               value="{{ $mechanic->moment_distribution_interval_seconds }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>


            </div>

        </div>

    </div>
</div>