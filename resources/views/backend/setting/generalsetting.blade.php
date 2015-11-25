@extends('backend/shared/layout')
@section('content')





        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#settings" data-toggle="tab">Imformation</a></li>
            <li><a href="#info" data-toggle="tab">SEO settings</a></li>
        </ul>
        {!! Form::open() !!}
        <div class="tab-content">

            <div class="tab-pane active" id="settings">
                <br>
                <h4><i class="glyphicon glyphicon-cog"></i> Imformation </h4>

                <br>


                <!-- Title -->
                <div class="control-group {!! $errors->has('site_title') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Title</label>

                    <div class="controls">
                        {!! Form::text('name', $setting->name ?: null, array('class'=>'form-control', 'id' => 'name', 'placeholder'=>'Name', 'value'=>Input::old('name'))) !!}
                        @if ($errors->first('name'))
                            <span class="help-block">{!! $errors->first('site_title') !!}</span>
                        @endif
                    </div>
                </div>
                <br>

                <!-- Google Analytics Code -->
                <div class="control-group {!! $errors->has('ga_code') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title"> Facebook link</label>

                    <div class="controls">
                        {!! Form::text('facebookLink', $setting->facebookLink ?: null, array('class'=>'form-control', 'id' => 'facebookLink', 'placeholder'=>' Google Analytics Code', 'value'=>Input::old('facebookLink'))) !!}
                        @if ($errors->first('ga_code'))
                            <span class="help-block">{!! $errors->first('ga_code') !!}</span>
                        @endif
                    </div>
                </div>
                <br>

                <!-- Meta Keywords -->
                <div class="control-group {!! $errors->has('meta_keywords') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Twitter link</label>

                    <div class="controls">
                        {!! Form::text('twitterLink', $setting->twitterLink ?: null, array('class'=>'form-control', 'id' => 'twitterLink', 'placeholder'=>'Meta Keywords', 'value'=>Input::old('twitterLink'))) !!}
                        @if ($errors->first('meta_keywords'))
                            <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                        @endif
                    </div>
                </div>
                <br>

                <!-- Meta Description -->
                <div class="control-group {!! $errors->has('meta_description') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Youtube link</label>

                    <div class="controls">
                        {!! Form::text('youtubeLink', $setting->youtubeLink ?: null, array('class'=>'form-control', 'id' => 'youtubeLink', 'placeholder'=>'Meta Description', 'value'=>Input::old('youtubeLink'))) !!}
                        @if ($errors->first('meta_description'))
                            <span class="help-block">{!! $errors->first('meta_description') !!}</span>
                        @endif
                    </div>
                </div>
                <br>

            </div>
            <div class="tab-pane" id="info">
                <br>
                <h4><i class="glyphicon glyphicon-info-sign"></i> SEO settings</h4>
                <br>
                <!-- Meta Keywords -->
                <div class="control-group {!! $errors->has('meta_keywords') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Default title</label>

                    <div class="controls">
                        {!! Form::text('defaultTitle', $seoSettingView->defaultTitle ?: null, array('class'=>'form-control', 'id' => 'defaultTitle', 'placeholder'=>'Meta Keywords', 'value'=>Input::old('defaultTitle'))) !!}
                        @if ($errors->first('meta_keywords'))
                            <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                        @endif
                    </div>
                </div>
                <br>
                <!-- Meta Keywords -->
                <div class="control-group {!! $errors->has('meta_keywords') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Default meta keywords</label>

                    <div class="controls">
                        {!! Form::text('defaultMetaKeywords', $seoSettingView->defaultMetaKeywords ?: null, array('class'=>'form-control', 'id' => 'defaultMetaKeywords', 'placeholder'=>'Meta Keywords', 'value'=>Input::old('defaultMetaKeywords'))) !!}
                        @if ($errors->first('meta_keywords'))
                            <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                        @endif
                    </div>
                </div>
                <br>
                <!-- Meta Keywords -->
                <div class="control-group {!! $errors->has('meta_keywords') ? 'has-error' : '' !!}">
                    <label class="control-label" for="title">Default meta description</label>

                    <div class="controls">
                        {!! Form::text('defaultMetaDescription', $seoSettingView->defaultMetaDescription ?: null, array('class'=>'form-control', 'id' => 'defaultMetaDescription', 'placeholder'=>'Meta Keywords', 'value'=>Input::old('defaultMetaDescription'))) !!}
                        @if ($errors->first('meta_keywords'))
                            <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                        @endif
                    </div>
                </div>
                <br>

            </div>
        </div>
        {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
        {!! Form::close() !!}

@stop