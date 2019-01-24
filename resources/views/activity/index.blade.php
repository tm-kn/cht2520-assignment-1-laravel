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
            <form method="get">
                <input type="text" name="start_date" value="{{ $filters['start_date']->toDateString() }}">
                <input type="text" name="end_date" placeholder="{{ __('End date') }}" value="{{ $filters['end_date']->toDateString() }}">
                <input type="text" name="search_query" placeholder="{{ __('Search query') }}" value="{{ $filters['search_query'] }}">
                <button class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($activities->isNotEmpty())
            <table class="table">
                <thead>
                    <th>{{ __('Time') }}</th>
                    <th>{{ __('Project') }}</th>
                    <th>{{ __('Activity') }}</th>
                    <th>{{ __('Time spent') }}</th>
                    <th>{{ __('View') }}</th>
                    <th>{{ __('Edit') }}</th>
                    <th>{{ __('Delete') }}</th>
                    <th>{{ __('Stop') }}</th>
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
                            <form method="post"  action="{{ action('ActivityController@destroy', $activity) }}">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" role="button">{{ __('Delete') }}</button>
                            </form>
                        </td>
                        <td></td>
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
