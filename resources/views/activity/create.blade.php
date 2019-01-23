@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ action('ActivityController@store') }}">
                @csrf

                <div class="form-group row">
                    <label for="activity" class="col-md-4 col-form-label text-md-right">{{ __('Activity') }}</label>

                    <div class="col-md-6">
                        <input id="activity" type="text" class="form-control{{ $errors->has('activity') ? ' is-invalid' : '' }}" name="activity" value="{{ old('activity') }}" required autofocus>

                        @if ($errors->has('activity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('activity') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="project" class="col-md-4 col-form-label text-md-right">{{ __('Project') }}</label>

                    <div class="col-md-6">
                        <input id="project" type="text" class="form-control{{ $errors->has('project') ? ' is-invalid' : '' }}" name="project" value="{{ old('project') }}" required autofocus>

                        @if ($errors->has('project'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('project') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="start_datetime" class="col-md-4 col-form-label text-md-right">{{ __('Start datetime') }}</label>

                    <div class="col-md-6">
                        <input id="start_datetime" type="text" class="form-control{{ $errors->has('start_datetime') ? ' is-invalid' : '' }} datetimepicker-input js-datetime" name="start_datetime" value="{{ old('start_datetime', Carbon\Carbon::now()->toDateTimeString()) }}" required autofocus data-toggle="datetimepicker" data-target="#start_datetime">
                        @if ($errors->has('start_datetime'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('start_datetime') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="end_datetime" class="col-md-4 col-form-label text-md-right">{{ __('End datetime') }}</label>

                    <div class="col-md-6">
                        <input id="end_datetime" type="text" class="form-control{{ $errors->has('end_datetime') ? ' is-invalid' : '' }} datetimepicker-input js-datetime" name="end_datetime" value="{{ old('end_datetime') }}" autofocus data-toggle="datetimepicker" data-target="#end_datetime">

                        @if ($errors->has('end_datetime'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('end_datetime') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" autofocus>
                            {{ old('description') }}
                        </textarea>

                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
