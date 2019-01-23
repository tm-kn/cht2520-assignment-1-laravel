@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <th>Time</th>
                    <th>Project</th>
                    <th>Activity</th>
                    <th>Time spent</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Stop</th>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    @if($loop->first || $activity->start_date != $activities[$loop->index - 1]->start_date)
                    <tr>
                        <td colspan="7">
                            {{ $activity->start_date->toFormattedDateString() }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td>
                        {{ $activity->start_datetime->toTimeString() }}{{ $activity->end_datetime ? ' - ' . $activity->end_datetime->toTimeString() : '' }}
                        </td>
                        <td>{{ $activity->project }}</td>
                        <td>{{ $activity->activity }}</td>
                        <td>{{ $activity->duration }}</td>
                        <td><a href="{{ action('ActivityController@show', $activity) }}">View</a></td>
                        <td><a href="{{ action('ActivityController@edit', $activity) }}">Edit</a></td>
                        <td>
                            <form method="post"  action="{{ action('ActivityController@destroy', $activity) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
