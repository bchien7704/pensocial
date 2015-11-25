<div class="settings_item">


    <div class="settings_item_title">Receive email messages when:</div>
    {!! Form::open( array( 'route' => array('register'))) !!}

    <div class="settings_item_content">
        <?php
        $settings = str_split(Auth::user()->setting);
        ?>

        <div class="settings_item_email_div_input">


            {!! Form::checkbox('setting_1', $settings[0]==null ? $settings[0]: null,$settings[0] == '1'? true:false) !!}
            Receive email when receiveing a new message
        </div>

        <div class="settings_item_email_div_input">
            {!! Form::checkbox('setting_2', $settings[1]==null ? $settings[1]: null,$settings[1] == '1'? true:false) !!}
            Receive reminders by email
        </div>

        <div class="settings_item_content_div_input" align="center" style="width: 440px;">
            <input class="share_button" type="submit" value="Save" name="change_email_settings"/>
        </div>
    </div>


    {!! Form::close() !!}
</div>