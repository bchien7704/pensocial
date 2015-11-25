@extends('frontend/shared/one_column')

@section('content')
    <div class="site_content">
        <div class="site_width">
            <div class="site_content_left_account">
                @include('frontend.user.navigation_account')
            </div>
            <div class="site_content_right_account">
                <div class="site_content settings">
                    @include('frontend.user.setting_top')
                    @if(strlen($selectTab)==0)
                        @include('frontend.user.setting_password')
                    @elseif($selectTab=="account")
                        @include('frontend.user.setting_password')
                    @elseif($selectTab=="email")
                        @include('frontend.user.setting_email')
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop