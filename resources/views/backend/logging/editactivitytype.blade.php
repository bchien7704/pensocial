@extends('backend/shared/layout')
@section('content')


{!! Form::open() !!}

        <!-- Google Analytics Code -->
<div class="control-group {!! $errors->has('system_keyword') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> System keywords</label>

    <div class="controls">
        {!! Form::text('system_keyword', $activityType->system_keyword ?: null, array('class'=>'form-control', 'id' => 'system_keyword', 'placeholder'=>'System Keywords', 'value'=>Input::old('system_keyword'))) !!}
        @if ($errors->first('system_keyword'))
            <span class="help-block">{!! $errors->first('system_keyword') !!}</span>
        @endif
    </div>
</div>

<br>
<!-- Google Analytics Code -->
<div class="control-group {!! $errors->has('name') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> Name</label>

    <div class="controls">
        {!! Form::text('name', $activityType->name ?: null, array('class'=>'form-control', 'id' => 'name', 'placeholder'=>'Name', 'value'=>Input::old('name'))) !!}
        @if ($errors->first('name'))
            <span class="help-block">{!! $errors->first('name') !!}</span>
        @endif
    </div>
</div>
<br>
<!-- Title -->
<div class="control-group {!! $errors->has('enabled') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Enabled</label>

    <div class="controls">

       {!! Form::checkbox('enabled', 'enabled',$activityType->enabled) !!}

        @if ($errors->first('enabled'))
            <span class="help-block">{!! $errors->first('enabled') !!}</span>
        @endif
    </div>
</div>
<br>

<br>
{!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}


@stop