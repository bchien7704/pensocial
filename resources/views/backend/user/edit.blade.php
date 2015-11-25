@extends('backend/shared/layout')
@section('content')
    {!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
    {!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
    {!! HTML::style('bootstrap_datepicker/css/datepicker.css') !!}
    {!! HTML::script('bootstrap_datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::script('bootstrap_datepicker/js/locales/bootstrap-datepicker.tr.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {


            $('#birthday').datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                orientation: "top auto"
            });


        });
    </script>
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#imformation" data-toggle="tab">Imformation</a></li>
        <li><a href="#group" data-toggle="tab">Group</a></li>
    </ul>
    {!! Form::open(array('route' => array('admin.user.update', $user->id), 'method' => 'PATCH', 'files'=>true)) !!}
    <div class="tab-content">

        <div class="tab-pane active user_imformation_tab" id="imformation">
            <br>
            {{--<h4><i class="glyphicon glyphicon-cog"></i> Imformation </h4>--}}

            <br>
            <!-- Image -->
            <div class="fileinput fileinput-new control-group {!! $errors->has('photo') ? 'has-error' : '' !!}"
                 data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img data-src=""
                         {!! (($user->photo.$user->file_name) ? "src='".url($user->photo.$user->file_name)."'" : null) !!} alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"
                     style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span
                                    class="fileinput-exists">Change</span>
                            {!! Form::file('photo', null, array('class'=>'form-control', 'id' => 'photo', 'placeholder'=>'photo', 'value'=>Input::old('photo'))) !!}
                            @if ($errors->first('photo')) <span
                                    class="help-block">{!! $errors->first('photo') !!}</span> @endif </span> <a href="#"
                                                                                                                class="btn btn-default fileinput-exists"
                                                                                                                data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
            </div>
            <br>
            <!-- Image -->
            {{--<div class="fileinput fileinput-new control-group {!! $errors->has('photo') ? 'has-error' : '' !!}"--}}
            {{--data-provides="fileinput">--}}
            {{--<div class="fileinput-preview thumbnail" data-trigger="fileinput"--}}
            {{--style="width: 200px; height: 150px;"></div>--}}
            {{--<div> <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span--}}
            {{--class="fileinput-exists">Change</span> {!! Form::file('photo', null, array('class'=>'form-control', 'id' => 'photo', 'placeholder'=>'photo', 'value'=>Input::old('photo'))) !!}--}}
            {{--@if ($errors->first('photo')) <span--}}
            {{--class="help-block">{!! $errors->first('photo') !!}</span> @endif </span> <a href="#"--}}
            {{--class="btn btn-default fileinput-exists"--}}
            {{--data-dismiss="fileinput">Remove</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            <br>
            <!-- Email -->
            <div class="control-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                <label class="control-label" for="email">Email</label>

                <div class="controls">
                    {!! Form::text('email', $user->email, array('class'=>'form-control', 'id' => 'email', 'placeholder'=>'Email', 'value'=>Input::old('email'))) !!}
                    @if ($errors->first('email'))
                        <span class="help-block">{!! $errors->first('email') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <!-- First name -->
            <div class="control-group {!! $errors->has('full_name') ? 'has-error' : '' !!}">
                <label class="control-label" for="email">Full name</label>

                <div class="controls">
                    {!! Form::text('first_name', $user->full_name, array('class'=>'form-control', 'id' => 'full_name', 'placeholder'=>'Full name', 'value'=>Input::old('full_name'))) !!}
                    @if ($errors->first('full_name'))
                        <span class="help-block">{!! $errors->first('full_name') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- First name -->
            <div class="control-group {!! $errors->has('clubs') ? 'has-error' : '' !!}">
                <label class="control-label" for="email">Clubs</label>

                <div class="controls">
                    {!! Form::text('clubs', $user->first_name, array('class'=>'form-control', 'id' => 'clubs', 'placeholder'=>'Clubs ', 'value'=>Input::old('clubs'))) !!}
                    @if ($errors->first('clubs'))
                        <span class="help-block">{!! $errors->first('clubs') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Gender-->
            <div class="control-group {!! $errors->has('gender') ? 'has-error' : '' !!}">
                <label class="control-label" for="email">Gender</label>

                <div class="controls">
                    {{--<div class="gender">--}}
                    {{--<label class="forcheckbox"--}}
                    {{--for="gender-m">Female </label> {!!   Form::radio('gender', 'm',true, array('id'=>'gender-m')) !!}--}}
                    {{--</div>--}}
                    {{--<div class="gender"><label class="forcheckbox"--}}
                    {{--for="gender-f">Male</label> {!!  Form::radio('gender', 'f',false,array('id'=>'gender-f')) !!}--}}
                    {{--</div>--}}
                    {!! Form::select('gender', array('0' => 'Male', '1' => 'Female'),$user->gender,array('class' => 'form-control', 'value'=>Input::old('gender'))) !!}
                    @if ($errors->first('gender'))
                        <span class="help-block">{!! $errors->first('gender') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Datetime -->
            <div class="control-group {!! $errors->has('birthday') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Birthday</label>

                <div class="controls"> {!! Form::text('birthday', $user->birthday, array('class'=>'form-control', 'id' => 'birthday',
                'value'=>Input::old('birthday'))) !!}
                    @if ($errors->first('birthday'))
                        <span class="help-block">{!! $errors->first('birthday') !!}</span> @endif </div>
            </div>
            <br>

            <!-- Active -->
            <div class="control-group {!! $errors->has('activated') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Activated</label>

                <div class="controls">

                    {!! Form::checkbox('activated', $user->activated ?: null,array('class'=>'form-control', 'id' => 'activated', 'value'=>Input::old('activated'))) !!}

                    @if ($errors->first('activated'))
                        <span class="help-block">{!! $errors->first('activated') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Ip address -->
            <div class="control-group ">
                <label class="control-label" for="title">IP address</label>

                <div class="controls">

                    {!!$user->getIpAddressAttribute($user->last_ip_address) !!}


                </div>
            </div>
            <br>
            <!-- Active -->
            <div class="control-group ">
                <label class="control-label" for="title">Created on</label>

                <div class="controls">
                    {!! $user->created_at !!}

                </div>
            </div>
            <br>
            <!-- Active -->
            <div class="control-group ">
                <label class="control-label" for="title">Last activity</label>

                <div class="controls">

                    {!! $user->date_last_active !!}


                </div>
            </div>
            <br>

        </div>
        <div class="tab-pane" id="group">
            <br>
            {{--<h4><i class="glyphicon glyphicon-info-sign"></i> Group</h4>--}}
            <br>
            <!-- Group -->
            <div class="control-group " style="margin-left: 15px">
                {{--<label class="control-label" for="groups">Groups</label>--}}
                <div class="controls" >

                    @foreach($groups as $id=>$group)
                        <label class="checkbox"><input {!! ((in_array($group, $userGroups)) ? 'checked' : '') !!} type="checkbox" value="{!! $id !!}" name="groups[{!! $group !!}]">  {!! $group !!}</label>
                    @endforeach

                </div>
            </div>
            <br>


        </div>
    </div>
    {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
    {!! Form::close() !!}

@stop