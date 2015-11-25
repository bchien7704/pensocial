@extends('frontend/shared/one_column')

@section('content')
<div class="site_width">
    <div class="site_content">
        <div class="static_title" style="text-align: center;">Invite your friends to StudentJibe</div>
        <div style="margin: 0px auto; width: 500px;">
            <form action="" method="POST">


                <div class="settings_item_content_div_input">
                    <div class="settings_item_content_div_input_left">Email student<br />(Maximum 4 email)</div>
                    <div class="settings_item_content_div_input_right"><textarea name="message" class="settings_item_content_div_input_right_input" style="height: 50px;"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea></div>

                    <div class="clear"><!-- --></div>
                </div>

                <div class="settings_item_content_div_input">
                    <div class="settings_item_content_div_input_left">Personal message<br />(optional)</div>
                    <div class="settings_item_content_div_input_right"><textarea name="message" class="settings_item_content_div_input_right_input" style="height: 50px;"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea></div>

                    <div class="clear"><!-- --></div>
                </div>

                <div class="settings_item_content_div_input" align="right" style="width: 440px;">
                    <input class="share_button" type="submit" value="Invite" name="invite" />
                </div>
            </form>
        </div>
    </div>

</div>
    @stop