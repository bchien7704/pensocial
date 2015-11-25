@extends('frontend/shared/one_column_login')

@section('content')
    <div class="top_header">
        <div class="header">
            <div class="left logo" >
                <a href="{!! route('home') !!}"> <img src="{!! url('frontend/images/logo.png') !!}" alt=""></a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="site_width">
        <div class="clear"></div>
        <div class="site_content">
            <div class="static_title">Sign In Into Your Account</div>

            <div align="center">

                {!! Form::open(array()) !!}
                @if ($errors->has('login'))
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>{!! $errors->first('login', ':message') !!}
                    </div>
                @endif
                    <div align="left" class="login_container">
                        <div class="login_item">
                            <div class="login_item_text">
                                Email:
                            </div>
                            <div class="login_item_text_box">
                                <input class="login_item_input_text" type="text" name="email" value="" />
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>

                        <div class="login_item">
                            <div class="login_item_text">
                                Password:
                            </div>
                            <div class="login_item_text_box">
                                <input class="login_item_input_text" type="password" name="password" />
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>

                        <div class="login_item" style="padding-left: 107px;">
                            <div class="left"><input style="margin-top: 0px;" type="checkbox" name="logged" /></div>
                            <div class="left" style="color: #333; margin-left: 2px; font-size: 10px;"> Keep me logged in</div>
                        </div>

                        <div align="right">
                            <input name="login" type="submit" value="Sign In" class="menu_notloggedin_submit" /> or
                            <a class="forgot_password_link" href="{!! route('resetpassword.email') !!}">Did you forgot your password?</a>
                        </div>

                        <div style="height: 10px;"><!-- --></div>

                        <div align="center">
                            <a class="forgot_password_link" href="{!! route('home') !!}">I don't have an account with StudentJibe. I want one!</a>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
@stop