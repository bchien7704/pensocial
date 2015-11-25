<div class="index_right">
    {!! Form::open( array( 'route' => array('register'))) !!}
    <div class="index_righ_header">Join StudentJibe Today. Its Free!</div>
    <div class="index_righ_content">
        <div class="register_item">
            <div class="register_item_left">Full name</div>

            <div class="register_item_right {!! $errors->has('full_name') ? 'has-error' : '' !!}">
                <input type="text" class=" form-control register_item_right_text" name="full_name" value="{!! Input::old('full_name') !!}"
                        />
                @if ($errors->first('full_name'))
                    <span class="help-block">{!! $errors->first('full_name') !!}</span>
                @endif
            </div>

            <div class="clear"><!-- --></div>


        </div>

        <div class="register_item">
            <div class="register_item_left">Username</div>

            <div class="register_item_right {!! $errors->has('username') ? 'has-error' : '' !!}">
                <input type="text" class=" form-control register_item_right_text" name="username" value="{!! Input::old('username') !!}"
                        />
                @if ($errors->first('username'))
                    <span class="help-block">{!! $errors->first('username') !!}</span>
                @endif
            </div>

            <div class="clear"><!-- --></div>


        </div>

        <div class="register_item">
            <div class="register_item_left">Email</div>

            <div class="register_item_right {!! $errors->has('email') ? 'has-error' : '' !!}">
                <input type="text" class="form-control register_item_right_text" name="email" value="{!! Input::old('email') !!}"
                        />
                @if ($errors->first('email'))
                    <span class="help-block">{!! $errors->first('email') !!}</span>
                @endif
            </div>

            <div class="clear"><!-- --></div>


        </div>

        <div class="register_item">
            <div class="register_item_left">Password</div>

            <div class="register_item_right {!! $errors->has('password') ? 'has-error' : '' !!}" >
                <input type="password" class="form-control register_item_right_text" name="password"/>
                @if ($errors->first('password'))
                    <span class="help-block">{!! $errors->first('password') !!}</span>
                @endif
            </div>

            <div class="clear"><!-- --></div>


        </div>

        <div class="register_item">
            <div class="register_item_left">Retype</div>

            <div class="register_item_right {!! $errors->has('confirm_password') ? 'has-error' : '' !!}">
                <input type="password" class="form-control register_item_right_text" name="confirm_password"/>
                @if ($errors->first('confirm_password'))
                    <span class="help-block">{!! $errors->first('confirm_password') !!}</span>
                @endif
            </div>

            <div class="clear"><!-- --></div>

        </div>

        <div class="register_item">
            <div class="register_item_left">Sex</div>

            <div class="register_item_right select-style {!! $errors->has('gender') ? 'has-error' : '' !!}">
                <select id="index_sex" name="gender" class=" form-control register_item_right_text" value="{!! Input::old('gender') !!}"
                        style="width: 184px; height: 24px;">

                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
                </br>
                @if ($errors->first('gender'))
                    <span class="help-block">{!! $errors->first('gender') !!}</span>
                @endif
            </div>

            <div class="clear"><!-- --></div>


        </div>

        <div class="register_item">
            <div class="register_item_left">
                <input type="checkbox" name="terms" value="1"/> I accept the <a class="user_link2" href="terms">terms
                    and conditions</a>
            </div>

            <div class="clear"><!-- --></div>


        </div>
        <div align="center">
            <input class="submit_register" name="register" type="submit" value="Create new account"/>
        </div>

        <div align="center" class="register_confirmation">
            Already on StudentJibe? <a class="forgot_password_link" href="{!! route('login') !!}">Sign in</a>.
        </div>
    </div>

    {!! Form::close() !!}
</div>