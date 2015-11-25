function studentjibe_box(s) {
    this.width = s.width;
    this.height = s.height != undefined ? s.height : 0;
    this.title = s.title;
    this.content = s.content;
    this.paddingTop = 10;
    this.paddingTop = s.paddingTop != undefined ? s.paddingTop : this.paddingTop;
    this.paddingBottom = 10;
    this.paddingBottom = s.paddingBottom != undefined ? s.paddingBottom : this.paddingBottom;
    this.paddingLeft = 10;
    this.paddingLeft = s.paddingLeft != undefined ? s.paddingLeft : this.paddingLeft;
    this.paddingRight = 20;
    this.paddingRight = s.paddingRight != undefined ? s.paddingRight : this.paddingRight;
    this.onsubmit = 'closeBox';
    this.onsubmit = s.onsubmit != undefined ? s.onsubmit : this.onsubmit;
    this.showSubmit = true;
    this.showSubmit = s.showSubmit != undefined ? s.showSubmit : this.showSubmit;
    this.showCancel = true;
    this.showCancel = s.showCancel != undefined ? s.showCancel : this.showCancel;
    this.textCancel = 'Cancel';
    this.textCancel = s.textCancel != undefined ? s.textCancel : this.textCancel;
    this.textSubmit = 'Save';
    this.textSubmit = s.textSubmit != undefined ? s.textSubmit : this.textSubmit;
    this.onCancel = '';
    this.onCancel = s.onCancel != undefined ? s.onCancel : this.onCancel;
    this.backgroundBoxColor = '';
    this.backgroundBoxColor = s.backgroundBoxColor != undefined ? s.backgroundBoxColor : this.backgroundBoxColor;

    this.BOX_FINAL_TOP = '';
    this.BOX_FINAL = '';

    this.set_box_final = function () {
        this.BOX_FINAL_TOP = '<div id="box_content">\n\
                            <table cellpadding="0" cellspacing="0">\n\
                              <tr>\n\
                                <td class="box_corner_top_left"></td>\n\
                                <td class="box_corner_top_center"></td>\n\
                                <td class="box_corner_top_right"></td>\n\
                              </tr>\n\
                              <tr>\n\
                                <td class="box_middle_left_center"></td>\n\
                                <td class="box_middle_center"' + ( this.backgroundBoxColor != '' ? ' style="background: ' + this.backgroundBoxColor + ';"' : '' ) + '>';
        this.BOX_FINAL_BOTTOM = '</td>\n\
                            <td class="box_middle_right_center"></td>\n\
                          </tr>\n\
                          <tr>\n\
                            <td class="box_corner_bottom_left"></td>\n\
                            <td class="box_corner_bottom_center"></td>\n\
                            <td class="box_corner_bottom_right"></td>\n\
                          </tr>\n\
                        </table>\n\
                      </div>';
    }

    this.set_box_final();

    this.create_box = function () {
        $('body').append('<div id="box_background"></div>');
        $('#box_background').css('height', $('body').css('height'));

        this.BOX_FINAL = this.BOX_FINAL_TOP;
        this.BOX_FINAL += '\n\
                        <div style="width: ' + this.width + 'px;" class="box_middle_center_title">' + this.title + '</div>\n\
                        <div style="padding-top: ' + this.paddingTop + 'px; padding-bottom: ' + this.paddingBottom + 'px; padding-left: ' + this.paddingLeft + 'px; padding-right: ' + this.paddingRight + 'px;' + ( this.height > 0 ? 'height: ' + this.height + 'px; overflow: auto;' : '' ) + '" class="box_container">' + this.content + '</div>\n\
                        <div class="box_actions" align="right">\n\
                          <div style="height: 8px;"><!-- --></div>\n\
                          <input id="box_submit" style="' + ( !this.showSubmit ? 'display: none;' : '' ) + '" type="button" onclick="javascript: ' + this.onsubmit + '();" class="standard_submit" value="' + this.textSubmit + '" />\n\
                          <input style="' + ( !this.showCancel ? 'display: none;' : '' ) + '" type="button" onclick="javascript: closeBox(); ' + ( this.onCancel != '' ? this.onCancel + '()' : '' ) + '" class="standard_cancel" value="' + this.textCancel + '" />\n\
                          \n\
                          </div>\n\
                      ';
        this.BOX_FINAL += this.BOX_FINAL_BOTTOM;


    }

    this.create_box();

    this.display_box = function () {
        $('body').append(this.BOX_FINAL);

        var box_width = Math.floor ( ( $(window).width() - $('#box_content').width() ) / 2 );
        var box_height = Math.floor ( ( $(window).height() - $('#box_content').height() ) / 2 );

        $('#box_content').css({'left': box_width + 'px', 'top': box_height + 'px'});
        $('#box_submit').focus();
    }

    this.display_box();
}

function closeBox() {
    $('#box_background').remove('#box_background');
    $('#box_content').remove();
}