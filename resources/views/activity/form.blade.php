<div class="form-group row">
    {!! Form::label('activity', __('Activity'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::text('activity', null, [
            'required' => true,
            'class' => 'form-control' . ($errors->has('activity') ? ' is-invalid' : '')
        ]) !!}

        @if ($errors->has('activity'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('activity') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('project', __('Project'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::text('project', null, [
            'required' => true,
            'class' => 'form-control' . ($errors->has('project') ? ' is-invalid' : '')
        ]) !!}

        @if ($errors->has('project'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('project') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('start_datetime', __('Start time'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::text('start_datetime', isset($activity) ? null : Carbon\Carbon::now(), [
            'required' => true,
            'class' => 'form-control datetimepickerinput js-datetime' . ($errors->has('start_datetime') ? ' is-invalid' : ''),
            'data-toggle' => "datetimepicker",
            'data-target' => "#start_datetime"
        ]) !!}
        @if ($errors->has('start_datetime'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('start_datetime') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('end_datetime', __('End time'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::text('end_datetime', null, [
            'class' => 'form-control datetimepickerinput js-datetime' . ($errors->has('end_datetime') ? ' is-invalid' : ''),
            'data-toggle' => "datetimepicker",
            'data-target' => "#end_datetime"
        ]) !!}

        @if ($errors->has('end_datetime'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('end_datetime') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('description', __('Description'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::textarea('description', null, [
            'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '')
        ]) !!}

        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
