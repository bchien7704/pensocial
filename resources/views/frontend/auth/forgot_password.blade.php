@extends('frontend/shared/one_column')

@section('content')

    <div class="site_width">
        <div class="site_content">
            <div class="static_title">Recover your password</div>

            <div align="center">
                <div class="message-forgot-password">
                @if (session('status'))
                    <div class="alert alert-success success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

                        <div align="right">
                            <input name="recover" type="submit" value="Recover" class="menu_notloggedin_submit" /> or
                            <a class="forgot_password_link" href="{!! route("login") !!}">Sign in to your account</a>
                        </div>

                        <div style="height: 10px;"><!-- --></div>

                        <div align="center">
                            <a class="forgot_password_link" href="{!! route('home') !!}">I don't have an account with StudentJibe. I want one!</a>
                        </div>
                    </div>
                   </form>



            </div>
        </div>

    </div>
@stop