@extends('backend/shared/layout')
@section('content')

{!! HTML::script('ckeditor/ckeditor.js') !!}
{!!  Form::open( array('action' => '\Penst\Http\Controllers\Admin\TopicController@store', 'files'=>true)) !!}

        <!-- Google Analytics Code -->
<div class="control-group {!! $errors->has('system_name') ? 'has-error' : '' !!}">
    <label class="control-label" for="title"> System name</label>

    <div class="controls">
        {!! Form::text('system_name', $topic->system_name ?: null, array('class'=>'form-control', 'id' => 'system_name', 'placeholder'=>'System name', 'value'=>Input::old('system_name'))) !!}
        @if ($errors->first('system_name'))
            <span class="help-block">{!! $errors->first('system_name') !!}</span>
        @endif
    </div>
</div>

<br>
<div class="control-group {!! $errors->has('is_password') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Password protected</label>

    <div class="controls">

        {!! Form::checkbox('is_password', 'is_password',$topic->is_password) !!}

        @if ($errors->first('is_password'))
            <span class="help-block">{!! $errors->first('is_password') !!}</span>
        @endif
    </div>
</div>
<br>
<!-- Title -->
<div class="control-group {!! $errors->has('password') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Password</label>

    <div class="controls">
        {!! Form::input('password','password', $topic->password ?: null, array('class'=>'form-control', 'id' => 'password', 'placeholder'=>'Password', 'value'=>Input::old('password'))) !!}
        @if ($errors->first('password'))
            <span class="help-block">{!! $errors->first('password') !!}</span>
        @endif
    </div>
</div>

<br>
<div class="control-group {!! $errors->has('include_stite_map') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Include in sitemap</label>

    <div class="controls">

        {!! Form::checkbox('include_stite_map', 'include_stite_map',$topic->include_stite_map) !!}

        @if ($errors->first('include_stite_map'))
            <span class="help-block">{!! $errors->first('include_stite_map') !!}</span>
        @endif
    </div>
</div>
<br>
<div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">  Title</label>

    <div class="controls">
        {!! Form::text('title', $topic->password ?: null, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
        @if ($errors->first('title'))
            <span class="help-block">{!! $errors->first('title') !!}</span>
        @endif
    </div>
</div>

<br>
<!-- Content -->
<div class="control-group {!! $errors->has('body') ? 'has-error' : '' !!}">
    <label class="control-label" for="title">Content</label>

    <div class="controls">
        {!! Form::textarea('body', null, array('class'=>'form-control', 'id' => 'body', 'placeholder'=>'body', 'value'=>Input::old('body'))) !!}
        @if ($errors->first('body'))
            <span class="help-block">{!! $errors->first('body') !!}</span>
        @endif
    </div>
</div>
<br>

<br>
<br>
{!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<script type="text/javascript">
    window.onload = function () {
        CKEDITOR.replace('body', {
            "filebrowserBrowseUrl": "{!! url('filemanager/show') !!}"
        });
    };

    $(document).ready(function () {

        if ($('#tag').length != 0) {
            var elt = $('#tag');
            elt.tagsinput();
        }
    });
</script>

@stop