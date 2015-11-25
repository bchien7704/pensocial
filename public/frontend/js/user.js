var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(e) {
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    get_notifications();
    get_count_message();

    setInterval("get_notifications()", 20000);
    setInterval("get_count_message()", 20000);

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#my_notifications').click(function () {
        $('.chats_absolute').hide();
        $('#my_notifications').removeClass().addClass('globe_news_inactive').html('');

        if ($('.notifications_absolute').css('display') == 'block') {
            $('.notifications_absolute').hide();
        } else {
            $('.notifications_absolute').html('<div align="center" style="padding-top: 50px; padding-bottom: 50px;"><img width="20" src="images/loader.gif" alt="Loading.." /></div>').show();

            $.ajax({
                type: 'POST',
                data: {_token: CSRF_TOKEN},
                dataType: 'html',
                url: '/user/notification',
                success: function (msg) {
                    $('.notifications_absolute').html(msg);
                }
            });
        }
    });

})
function get_notifications() {
    $.ajax({
        type: 'POST',
        data: {_token: CSRF_TOKEN},
        dataType: 'html',
        url: '/user/countnewnotification',
        success: function (msg) {
            var notifications = parseInt(msg, 10);

            if ( notifications > 0 ) {
                $('#my_notifications').removeClass().addClass('globe_news_active').html(notifications);
            } else {
                $('#my_notifications').removeClass().addClass('globe_news_inactive').html('');
            }
        }
    });
}

function get_chats() {
    unset(chats);

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: 'my_new_chats',
        success: function (msg) {
            //alert(msg); return;

            eval(msg);

            get_active_chats();

            print_chat_users();

            read_restore();
        }
    });
}

function unset(array) {
    for ( key in array ) {
        array.splice(key, 1);
    }

    return array;
}
function get_active_chats() {
    var max_c = chats.length;
    var max_s = 0;
    for ( var i = 0; i < max_c; i++ ) {
        if ( chats[i][6] == '1' ) {
            max_s++;
        }
    }

    if ( max_s > 0 ) {
        $('#my_chats').removeClass().addClass('chat_box_active').html(max_s);
        popup_info_chat();
    } else {
        $('#my_chats').removeClass().addClass('chat_box_inactive').html('');
    }
}

function print_chat_users() {
    var max_c = chats.length;
    var DISPLAY_DATA = '';

    if ( max_c == 0 ) {
        DISPLAY_DATA = '<div style="font-size: 11px; color: #333333; line-height: 80px; text-align: center;">No users online</div>';
    }

    for ( var i = 0; i < max_c; i++ ) {
        DISPLAY_DATA += '<div' + ( chats[i][6] == '1' ? ' style="background: lightyellow;"' : '' ) + ' class="mychat_item" onclick="javascript: load_chat(\'' + chats[i][1] + '\');">\n\
                      <div class="mychat_item_left"><a href="javascript: void(0);"><img style="border: 1px solid #00CC00; padding: 1px;" src="' + chats[i][5] + '" width="26" height="26" alt="" border="0" /></a></div>\n\
                      <div class="mychat_item_right">\n\
                        <div><a class="user_link" href="javascript: void(0);">' + chats[i][0] + '</a></div>\n\
                        <div class="mychat_item_right_text">' + chats[i][4] + '</div>\n\
                      </div>\n\
                      \n\
                      <div class="clear"><!-- --></div>\n\
                    </div>';
    }

    $('.chats_absolute').html(DISPLAY_DATA);
}


function read_restore() {
    var restore = readCookie('__b');
    var restore1 = new Array();

    restore1 = unserialize(str_replace("###", ';', restore));

    var count = 0;
    for ( var e in restore1 ) {
        count++;
    }

    if ( restore1 != null ) {
        to_restore = restore1;
    }

    if ( restore1 != null ) {
        if ( count > 0 ) {
            var values = new Array();
            for ( var key in restore1 ) {
                if ( restore1[key] != '' ) {
                    load_chat(key);

                    values = restore1[key].split('-');

                    $('#chat_box_' + key).css({'top' : values[0], 'left' : values[1]});
                }
            }
        }
    }
}

function get_count_message()
{
    $.ajax({
        type: 'POST',
        data: {_token: CSRF_TOKEN},
        dataType: 'html',
        url: '/message/countnewmessage',
        success: function (msg) {
            var notifications = parseInt(msg, 10);

            if ( notifications > 0 ) {
                $('.count_news_message').html(notifications).show();
            } else {
                $('.count_news_message').html('').hide();
            }
        }
    });
}