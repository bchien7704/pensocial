@extends('backend/shared/layout')
@section('content')


{!!  Form::open( array('action' => '\Penst\Http\Controllers\Admin\EmailAccountController@store', 'files'=>true)) !!}

        <!-- Google Analytics Code -->
<div class="control-group {!! $errors->has('email') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> Email address</label>

    <div class="controls">
        {!! Form::text('email', $emailAccount->email ?: null, array('class'=>'form-control', 'id' => 'email', 'placeholder'=>'Email', 'value'=>Input::old('email'))) !!}
        @if ($errors->first('email'))
            <span class="help-block">{!! $errors->first('email') !!}</span>
        @endif
    </div>
</div>

<br>
<!-- Google Analytics Code -->
<div class="control-group {!! $errors->has('display_name') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> Email display name</label>

    <div class="controls">
        {!! Form::text('display_name', $emailAccount->display_name ?: null, array('class'=>'form-control', 'id' => 'display_name', 'placeholder'=>'Display name', 'value'=>Input::old('display_name'))) !!}
        @if ($errors->first('display_name'))
            <span class="help-block">{!! $errors->first('display_name') !!}</span>
        @endif
    </div>
</div>
<br>
<!-- Title -->
<div class="control-group {!! $errors->has('host') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> Host</label>

    <div class="controls">
        {!! Form::text('host', $emailAccount->host ?: null, array('class'=>'form-control', 'id' => 'host', 'placeholder'=>'Host', 'value'=>Input::old('host'))) !!}
        @if ($errors->first('host'))
            <span class="help-block">{!! $errors->first('host') !!}</span>
        @endif
    </div>
</div>
<br>
<div class="control-group {!! $errors->has('port') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Port</label>

    <div class="controls">
        {!! Form::input('number','port', $emailAccount->port ?: null, array('class'=>'form-control', 'id' => 'port', 'placeholder'=>'Port', 'value'=>Input::old('port'))) !!}
        @if ($errors->first('port'))
            <span class="help-block">{!! $errors->first('port') !!}</span>
        @endif
    </div>
</div>

<br>
<!-- Google Analytics Code -->
<div class="control-group {!! $errors->has('username') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> User</label>

    <div class="controls">
        {!! Form::text('username', $emailAccount->username ?: null, array('class'=>'form-control', 'id' => 'username', 'placeholder'=>'Username', 'value'=>Input::old('username'))) !!}
        @if ($errors->first('username'))
            <span class="help-block">{!! $errors->first('username') !!}</span>
        @endif
    </div>
</div>
<br>
<!-- Title -->
<div class="control-group {!! $errors->has('password') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Password</label>

    <div class="controls">
        {!! Form::input('password','password', $emailAccount->password ?: null, array('class'=>'form-control', 'id' => 'password', 'placeholder'=>'Password', 'value'=>Input::old('password'))) !!}
        @if ($errors->first('password'))
            <span class="help-block">{!! $errors->first('password') !!}</span>
        @endif
    </div>
</div>
<br>
<div class="control-group {!! $errors->has('enabled') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">SSL</label>

    <div class="controls">

        {!! Form::checkbox('email_ssl', 'email_ssl',$emailAccount->email_ssl) !!}

        @if ($errors->first('email_ssl'))
            <span class="help-block">{!! $errors->first('email_ssl') !!}</span>
        @endif
    </div>
</div>
<br>
<div class="control-group {!! $errors->has('use_default_credentials') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Use default credentials: </label>

    <div class="controls">

        {!! Form::checkbox('use_default_credentials', 'use_default_credentials',$emailAccount->use_default_credentials) !!}

        @if ($errors->first('use_default_credentials'))
            <span class="help-block">{!! $errors->first('use_default_credentials') !!}</span>
        @endif
    </div>
</div>
<br>
<br>
{!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}


@stop