@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {!! Form::model($activity, ['method' => 'PATCH', 'action' => ['ActivityController@update', $activity]]) !!}
                @include('activity.form')

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
