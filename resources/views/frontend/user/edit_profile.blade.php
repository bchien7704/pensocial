@extends('frontend/shared/one_column')

@section('content')
    <script>
        $(function () {
            $("#birthday").datepicker();
        });
    </script>
    <div class="site_content">
        <div class="site_width">
            <div class="site_content_left_account">
                @include('frontend.user.navigation_account')
            </div>
            <div class="site_content_right_account">
                <div>
                    <div class="static_title">Update Your Personal Information's</div>
                </div>
                {!! Form::open(array('route' => array('admin.user.update', $user->id), 'method' => 'PATCH', 'files'=>true)) !!}

                <div class="edit_profile_content">
                    <div>
                        <div class="edit_profile_steps_headline">
                            <div class="headline_dotted" style="width: 530px;">&nbsp;</div>

                            About me
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">First name:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('full_name', $user->full_name ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'full_name', 'placeholder'=>'Full name', 'value'=>Input::old('full_name'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Gender:</div>
                            <div class="edit_profile_steps_items_right select-style">

                                {!! Form::select('gender', array('0' => 'Male', '1' => 'Female'),$user->gender,array('class' => 'edit_profile_steps_items_input', 'value'=>Input::old('gender'))) !!}
                                @if ($errors->first('gender'))
                                    <span class="help-block">{!! $errors->first('gender') !!}</span>
                                @endif
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Birthday:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('birthday', $user->birthday ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'birthday', 'placeholder'=>'Birthday', 'value'=>Input::old('birthday'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Clubs:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::textarea('clubs', $user->clubs ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'clubs', 'placeholder'=>'Clubs', 'value'=>Input::old('clubs'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Relationship:</div>
                            <div class="edit_profile_steps_items_right select-style">

                                {!! Form::select('relationship', array('0' => 'Complicated', '1' => 'Married','2' => 'Single'),$user->relationship,array('class' => 'edit_profile_steps_items_input', 'value'=>Input::old('relationship'))) !!}
                                @if ($errors->first('relationship'))
                                    <span class="help-block">{!! $errors->first('relationship') !!}</span>
                                @endif
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                    </div>
                    <div style="height: 30px;"><!-- --></div>
                    <div>
                        <div class="edit_profile_steps_headline">
                            <div style="width: 456px;" class="headline_dotted">&nbsp;</div>

                            Change your avatar
                        </div>

                    </div>
                    <div style="height: 30px;"><!-- --></div>
                    <div>
                        <div class="edit_profile_steps_headline">
                            <div style="width: 530px;" class="headline_dotted">&nbsp;</div>

                            Education
                            <div class="edit_profile_steps_items">
                                <div class="edit_profile_steps_items_left">Grad School:</div>
                                <div class="edit_profile_steps_items_right">

                                    {!! Form::textarea('school', $user->school ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'school', 'placeholder'=>'School', 'value'=>Input::old('school'))) !!}
                                </div>

                                <div class="clear"><!-- --></div>
                            </div>
                            <div class="edit_profile_steps_items">
                                <div class="edit_profile_steps_items_left">Under Grad:</div>
                                <div class="edit_profile_steps_items_right">

                                    {!! Form::textarea('undergrad', $user->undergrad ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'undergrad', 'placeholder'=>'Undergrad', 'value'=>Input::old('undergrad'))) !!}
                                </div>

                                <div class="clear"><!-- --></div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 30px;"><!-- --></div>
                    <div>
                        <div class="edit_profile_steps_headline">
                            <div style="width: 540px;" class="headline_dotted">&nbsp;</div>

                            Contact
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Facebook:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('facebook', $user->facebook ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'facebook', 'placeholder'=>'', 'value'=>Input::old('facebook'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Twitter:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('twitter', $user->twitter ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'twitter', 'placeholder'=>'', 'value'=>Input::old('twitter'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">LinkedIn:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('linkedin', $user->linkedin ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'linkedin', 'placeholder'=>'', 'value'=>Input::old('linkedin'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Phone:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('phone', $user->phone ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'phone', 'placeholder'=>'', 'value'=>Input::old('phone'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="edit_profile_steps_items">
                            <div class="edit_profile_steps_items_left">Website:</div>
                            <div class="edit_profile_steps_items_right">

                                {!! Form::text('website', $user->website ?: null, array('class'=>'edit_profile_steps_items_input', 'id' => 'website', 'placeholder'=>'', 'value'=>Input::old('website'))) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="clear"><!-- --></div>
    </div>
@stop