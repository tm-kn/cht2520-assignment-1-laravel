@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {!! Form::open(['action' => ['ActivityController@store']]) !!}
                @include('activity.form')
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
