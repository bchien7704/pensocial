@if (session('success'))
    <div class="alert alert-success success">
        {{ session('message') }}
    </div>
@endif
<div class="settings_item">
    <div class="settings_item_title">Change password</div>
    {!! Form::open( array( 'route' => array('user.changepassword'))) !!}
    <div class="settings_item_content">
        <div class="settings_item_content_div_input ">
            <div class="settings_item_content_div_input_left">Old Password</div>
            <div class="settings_item_content_div_input_right {!! $errors->has('password') ? 'has-error' : '' !!}">
                {!! Form::input('password','password',  null, array('class'=>'settings_item_content_div_input_right_input form-control', 'id' => 'password', 'placeholder'=>'')) !!}
                @if ($errors->first('password'))
                    <span class="help-block">{!! $errors->first('password') !!}</span>
                @endif
            </div>
            <div class="clear"><!-- --></div>
        </div>

        <div class="settings_item_content_div_input">
            <div class="settings_item_content_div_input_left">New Password</div>
            <div class="settings_item_content_div_input_right {!! $errors->has('new_password') ? 'has-error' : '' !!}">
                {!! Form::input('password','new_password',  null, array('class'=>'settings_item_content_div_input_right_input form-control', 'id' => 'new_password', 'placeholder'=>'')) !!}
                @if ($errors->first('new_password'))
                    <span class="help-block">{!! $errors->first('new_password') !!}</span>
                @endif
            </div>
            <div class="clear"><!-- --></div>
        </div>

        <div class="settings_item_content_div_input">
            <div class="settings_item_content_div_input_left">Retype Password</div>
            <div class="settings_item_content_div_input_right {!! $errors->has('confirm_password') ? 'has-error' : '' !!}">
                {!! Form::input('password','confirm_password',  null, array('class'=>'settings_item_content_div_input_right_input form-control', 'id' => 'confirm_password', 'placeholder'=>'')) !!}
                @if ($errors->first('confirm_password'))
                    <span class="help-block">{!! $errors->first('confirm_password') !!}</span>
                @endif
            </div>
            <div class="clear"><!-- --></div>
        </div>

        <div class="settings_item_content_div_input" align="right" style="width: 440px;">
            <input class="share_button" type="submit" value="Save" name="change_pass"/>
        </div>
    </div>
    {!! Form::close() !!}
</div>
