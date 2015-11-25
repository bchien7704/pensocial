@extends('backend/shared/layout')
@section('content')


        {{--{!! Notification::showAll() !!}--}}
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            <li><a href="#info" data-toggle="tab">Info</a></li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="settings">
                <br>
                <h4><i class="glyphicon glyphicon-cog"></i> Settings</h4>

                <br>
                {!! Form::open() !!}

                        <!-- Title -->
                <div class="control-group {!! $errors->has('site_title') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Username enabled</label>

                    <div class="controls">

                        {!! Form::checkbox('registerMethod', $setting->usernameEnabled ?: null,array('class'=>'form-control', 'id' => 'site_title', 'placeholder'=>'Title', 'value'=>Input::old('site_title'))) !!}

                        @if ($errors->first('title'))
                            <span class="help-block">{!! $errors->first('site_title') !!}</span>
                        @endif
                    </div>
                </div>
                <br>

                <!-- Google Analytics Code -->
                <div class="control-group {!! $errors->has('ga_code') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title"> Register method</label>

                    <div class="controls">
                        {!! Form::select('ga_code', $registerMethod ?: null,$setting->registerMethod ,array('class'=>'form-control', 'id' => 'ga_code', 'placeholder'=>' Google Analytics Code', 'value'=>Input::old('ga_code'))) !!}
                        @if ($errors->first('ga_code'))
                            <span class="help-block">{!! $errors->first('ga_code') !!}</span>
                        @endif
                    </div>
                </div>


                <br>
                {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="info">
                <br>
                <h4><i class="glyphicon glyphicon-info-sign"></i> Info</h4>
                <br>
                Lorem profile dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                <p>Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis
                    dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor
                    accumsan.
                    Aliquam in felis sit amet augue.</p>
            </div>
        </div>

@stop