@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p>
                <a href="{{ action('ActivityController@create') }}" class="btn btn-primary" role="button">
                    {{ __('New activity') }}
                </a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {!! Form::open(['method' => 'GET']) !!}
                {!! Form::text('start_date', $filters['start_date']->toDateString(), [
                    'class' => 'datetimepicker-input js-date',
                    'placeholder' => __('Start date'),
                    'data-toggle' => "datetimepicker",
                    'data-target' => "#start_date",
                    'id' => 'start_date',
                ]) !!}
                {!! Form::text('end_date', $filters['end_date']->toDateString(), [
                    'class' => 'datetimepicker-input js-date',
                    'placeholder' => __('End date'),
                    'data-toggle' => "datetimepicker",
                    'data-target' => "#end_date",
                    'id' => 'end_date',
                ]) !!}
                {!! Form::text('search_query', $filters['search_query'], ['placeholder' => __('Search query')]) !!}
                {!! Form::submit(__('Filter'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($activities->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Time') }}</th>
                        <th>{{ __('Project') }}</th>
                        <th>{{ __('Activity') }}</th>
                        <th>{{ __('Time spent') }}</th>
                        <th>{{ __('View') }}</th>
                        <th>{{ __('Edit') }}</th>
                        <th>{{ __('Delete') }}</th>
                        <th>{{ __('Stop') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    @if($loop->first || $activity->start_date != $activities[$loop->index - 1]->start_date)
                    <tr>
                        <td colspan="8" class="font-weight-bold">
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
                        <td>
                            <p>
                                <a class="btn btn-secondary" role="button" href="{{ action('ActivityController@show', $activity) }}">
                                    {{ __('View') }}
                                </a>
                            </p>
                        </td>
                        <td>
                            <p>
                                <a class="btn btn-secondary" role="button" href="{{ action('ActivityController@edit', $activity) }}">
                                    {{ __('Edit') }}
                                </a>
                            </p>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['ActivityController@destroy', $activity]]) !!}
                                {!! Form::submit(__('Delete'), ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>

                        <td>
                            @if($activity->isActive())
                            {!! Form::open(['action' => ['ActivityController@stop', $activity]]) !!}
                                {!! Form::submit(__('Stop'), ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-primary" role="alert">
                {{ __('No results found.') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
