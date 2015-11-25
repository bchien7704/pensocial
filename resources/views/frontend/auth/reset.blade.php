@extends('frontend/shared/one_column')

@section('content')

    <div class="site_width">
        <div class="site_content">
            <div class="static_title">Reset your password</div>

            <div align="center">
                <div class="message-forgot-password">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div align="left" class="login_container">
                        <div class="login_item">
                            <div class="login_item_text">
                                Email address:
                            </div>
                            <div class="login_item_text_box">
                                {!! Form::text('email',  null, array('class'=>'login_item_input_text', 'id' => 'email', 'placeholder'=>'', 'value'=>Input::old('email'))) !!}

                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="login_item">
                            <div class="login_item_text">
                                Password:
                            </div>
                            <div class="login_item_text_box">

                                {!! Form::input('password','password',  null, array('class'=>'login_item_input_text', 'id' => 'password', 'placeholder'=>'')) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                        <div class="login_item">
                            <div class="login_item_text">
                                Confirm:
                            </div>
                            <div class="login_item_text_box">

                                {!! Form::input('password','password_confirmation',  null, array('class'=>'login_item_input_text', 'id' => 'password_confirmation', 'placeholder'=>'')) !!}
                            </div>

                            <div class="clear"><!-- --></div>
                        </div>


                        <div align="right">
                            <input name="recover" type="submit" value="Reset " class="menu_notloggedin_submit"/>
                        </div>


                    </div>
                </form>


            </div>
        </div>

    </div>
@stop