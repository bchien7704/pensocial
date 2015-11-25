@extends('frontend/shared/one_column')

@section('content')
<div class="site_width">

    <div class="slides">
        <div class="slides_container">

            <div>
                <div>
                    <div style="float: left; margin-top: 20px; padding: 0;">

                    </div>
                    <div class="left div_text2">

                    </div>
                    <div id="slide_register_box" style="float: right; margin-top: 30px; padding-left: 15px;">
                        @include('frontend.user.register_box')
                        <div class="clear"><!-- --></div>
                    </div>
                    <div style="height: 20px;"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="clear"><!-- --></div>
</div>
@stop
