<div class="left" id="profile">
    <div id="profile_picture">
        <a href="{!! route('account.wall',array($user->getSeName())) !!}">
            @if($user->photo)
                <img style="border: 1px solid {!! $user->online==1?'00CC00': 'EAEAEA' !!};"
                     src="{!! url($user->photo . $user->file_name) !!}" width="181" height="227"
                     alt="" border="0"/>
            @else
                <img style="border: 1px solid {!! $user->online==1?'00CC00': 'EAEAEA' !!}"
                     src="{!! url('assets/images/user_placeholder_181.png') !!}" width="181" height="227" alt=""
                     border="0"/>
            @endif

        </a>

        <div style="position: relative;" id="profile_edit"><input class="edit_button" type="button" name="edit_profile"
                                                                  id="edit_profile" value="Edit Profile"></div>
    </div>
    <div id="info">
        <div id="name">{!! $user->full_name !!}</div>
        <div id="education">
            <div>
                <div class="left education_logo" >

                </div>
                <div class="left education_text" >&nbsp;Education</div>
            </div>
            <div class="clear"></div>
            <div class="education_description">{!! $user->undergrad!=null?$user->undergrad  : '-'!!}</div>
        </div>
        <div id="school">
            <div>
                <div class="left school_logo" >

                </div>
                <div class="left school_text" >&nbsp;School</div>
            </div>
            <div class="clear"></div>
            <div class="school_description">{!! $user->school!=null?$user->school  : '-'!!}</div>
        </div>
        <div id="relation">
            <div>
                <div class="left relation_logo">

                </div>
                <div class="left relation_text" >&nbsp;Relationship</div>
            </div>
            <div class="clear"></div>
            <div id="relation_description">{!! $user->relationship!=null?$user->relationship  : '-'!!}</div>
        </div>
        <div id="dob">
            <div>
                <div class="left dob_logo" id="dob_logo">

                </div>
                <div class="left dob_text">&nbsp;Date of Birth</div>
            </div>
            <div class="clear"></div>
            <div class="club_description">{!! $user->birthday!=null?$user->birthday  : '-' !!}</div>
        </div>
    </div>
</div>
<div class="clear"><!-- --></div>