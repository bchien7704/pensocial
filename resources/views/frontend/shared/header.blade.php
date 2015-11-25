
<header class="top_header">
    <div class="header">
        <div class="logo left">

            <a href="{!! route('home') !!}">
                <img src="{!! url('frontend/images/logo.png') !!}" alt="logo">
            </a>

        </div>
        @if(!Auth::check())
            <div class="right">
                <div align="left" class="reg_login_container">
                    {!! Form::open() !!}
                    <div class="left">
                        <div class="left">
                            <div class="reg_login_item_text_box">
                                {!! Form::email('email',null,array('class'=>'reg_login_item_input_text', 'id' => 'facebookLink', 'placeholder'=>' Email', 'value'=>Input::old('email'))) !!}

                            </div>
                        </div>
                        <div class="left">
                            <div class="reg_login_item_text_box">
                                {!! Form::input('password','password', null, array('class'=>'reg_login_item_input_text', 'id' => 'password', 'placeholder'=>'Password', 'value'=>Input::old('password'))) !!}

                            </div>
                        </div>
                        <div class="clear"><!-- --></div>
                        <div class="left">
                            <input type="checkbox" checked="" name="logged" style="float: left; margin-top: 0px;">

                            <div class="remember_password"> Keep me logged in</div>
                        </div>
                        <div class="left header_forgot_password">
                            <a href="{!! route('resetpassword.email') !!}" class="forgot_password_link" style="color: #fff; padding-left: 6px;">Forgot your password?</a>
                        </div>
                    </div>
                    <div class="right">
                        <input type="submit" class="reg_menu_notloggedin_submit" value="Sign In" name="login">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <div class="menu left">
                @include('frontend.shared.topmenu')
            </div>
            <div class="search left">
                @include('frontend.common.search_box')
            </div>
            <div>
               @include('frontend.common.header_link')
            </div>
        @endif


    </div>

</header><!--/header-->