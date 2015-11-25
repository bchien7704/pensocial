<div id="header_profile" class="left">
    <div id="header_profile_name" class="left">{!! Auth::user()->full_name !!}</div>
    <div style="cursor: pointer;" class="left">
        <span class="user_fly_drop" alt=""></span><br>
        <div style="padding: 6px;" id="min_menu" class="absolute shadow">
            <div>

                <a href="/user/settings" class="header_out_link">My Account</a>

                {{--<a href="/user/invitefriends" class="header_out_link">Invite Friends</a>--}}
                <a href="{!! route("logout") !!}" class="header_out_link">Sign out</a>
            </div>
        </div>
    </div>
</div>