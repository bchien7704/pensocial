<div class="right" id="content_center">
    <div class="content_centered">
        <div class="content_title">Campus Wall</div>
        <div class="content_status_top"></div>
        <div class="content_status">
            {!! Form::open( array( 'route' => array('user.changepassword'))) !!}

            {!! Form::textarea('share', null, array('class'=>'share_textarea', 'id' => 'share_update')) !!}
                <div align="right" style="padding-right: 9px;">
                    <input class="share_button" type="submit" value="Share" name="submit_share" />

                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="clear"><!-- --></div>
</div>