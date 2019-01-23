@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <dl>
                <dt>Project</dt>
                <dd>{{ $activity->project }}</dd>
                <dt>Activity</dt>
                <dd>{{ $activity->activity }}</dd>
                <dt>Duration</dt>
                <dd>{{ $activity->duration }}</dd>
                <dt>Start</dt>
                <dd>{{ $activity->start_datetime->toDayDateTimeString() }}</dd>
                @if($activity->end_datetime)
                    <dt>End</dt>
                    <dd>{{ $activity->end_datetime->toDayDateTimeString() }}</dd>
                @endif
            </dl>
            @if($activity->description)
                <h3>Description</h3>
                {{ $activity->description }}
            @endif
        </div>
    </div>
</div>
@endsection
