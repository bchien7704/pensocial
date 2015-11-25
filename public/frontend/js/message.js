$(document).ready(function () {



        $('#conversation_search').focus(function () {
            if ( $(this).val() == 'Search conversation...' ) {
                $(this).css('color', '#000000').val('');
            }
        }).blur(function () {
            if ( $(this).val() == '' ) {
                $(this).css('color', '#D2D2D2').val('Search conversation...');
            }
        }).keypress(function (event) {
            if ( event.keyCode == '13' ) {
                window.location = '/message/'+ $("#reply_for_id").val() +'?item=' + $(this).val();
            }
        });



    $('#messages_search').focus(function () {
        if ( $(this).val() == 'Search messages...' ) {
            $(this).css('color', '#000000').val('');
        }
    }).blur(function () {
        if ( $(this).val() == '' ) {
            $(this).css('color', '#D2D2D2').val('Search messages...');
        }
    }).keypress(function (event) {
        if ( event.keyCode == '13' ) {
            window.location = '/message?option=message&item=' + $(this).val();
        }
    });
    $('#sent_messages_search').focus(function () {
        if ( $(this).val() == 'Search messages...' ) {
            $(this).css('color', '#000000').val('');
        }
    }).blur(function () {
        if ( $(this).val() == '' ) {
            $(this).css('color', '#D2D2D2').val('Search messages...');
        }
    }).keypress(function (event) {
        if ( event.keyCode == '13' ) {
            window.location = '/message?option=send-message&item=' + $(this).val();
        }
    });

    //$("#view_sent_messages").click(function(){
    //    $("#display_sent_messages").show();
    //    $("#display_messages").hide();
    //});
    //$("#view_messages").click(function(){
    //    $("#display_sent_messages").hide();
    //    $("#display_messages").show();
    //});
});
function send_message_user(user_name) {
//alert(user_name);
//                select: function(e, ui) {\n\
//                    var friend = ui.item.value,\n\
//                        span = $("<span>").text(friend),\n\
//                        a = $("<a>").addClass("remove").attr({\n\
//                            href: "javascript:",\n\
//                            title: "Remove " + friend\n\
//                        }).text("x").appendTo(span);\n\
//                        span.insertBefore("#message_username");\n\
//                },\n\
//                change: function() {\n\
//                    $("#message_username").val("");\n\
//                }\n\

    var DATA = '\n\
      <script>\n\
        $(document).ready(function(){\n\
          $("#message_username").focus(function(){\n\
            $(this).css("border","1px solid #000");\n\
          }).blur(function(){\n\
            $(this).css("border","1px solid #ccc");\n\
          }).autocomplete({\n\
              source: "/user/searchallusers",\n\
              minLength: 2, \n\
                search: function(){\n\
                  $("#show_image_onsearch").css("display","block").delay(10000).fadeOut(300);\n\
                }, \n\
                open: function(){\n\
                   $("#show_image_onsearch").css("display","none");\n\
                }\n\
          });\n\
        });\n\
      </script>\n\
      <table border="0">\n\
        <tr>\n\
          <td class="input_new_text">To</td>\n\
          <td>\n\
            <input class="input_new_message" type="text" id="message_username" value="' + ( user_name != '' ? user_name + '" readonly ' : '"' ) + ' />\n\
            <div id="show_image_onsearch" class="show_image_onsearch"></div>\n\
          </td>\n\
        </tr>\n\
        <tr>\n\
          <td class="input_new_text">Subject</td>\n\
          <td><input class="input_new_message" type="text" id="message_subject" /></td>\n\
        </tr>\n\
        <tr>\n\
          <td class="input_new_text">Message</td>\n\
          <td><textarea style="height: 80px;" class="input_new_message" id="message_message"></textarea></td>\n\
        </tr>\n\
      </table>';

    var box = new studentjibe_box({
        width: 400,
        title: 'Send message ' + ( user_name != '' ? ' to ' + user_name : '' ),
        content: DATA,
        onsubmit: 'message_user(); closeBox',
        onCancel: 'cancel_class',
        textSubmit: 'Send'
    });
}

function message_user() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    if ( $('#message_username').val() != '' ) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '/message/sendmessage',
            data:{_token: CSRF_TOKEN,to:$('#message_username').val(),subject:$('#message_subject').val(),message:$('#message_message').val()} ,
            success: function (msg) {


                var box = new studentjibe_box({
                    width: 400,
                    title: 'Message succesfully sent',
                    content: msg,
                    showSubmit : false,
                    textCancel:'Close',
                    onCancel: 'cancel_class',
                    backgroundBoxColor : '#FFFFCC'
                });
            }
        });
    }
}

function read_unread_message(message_id, _obj) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    if ( $(_obj).attr('class') == 'messages_item_right_unread_link' ) {
        $(_obj).attr('class', 'messages_item_right_read_link').attr('title', 'Mare Unread');
        $('#message_item_' + message_id).css('background', 'white');
    } else {
        $(_obj).attr('class', 'messages_item_right_unread_link').attr('title', 'Mare Read');
        $('#message_item_' + message_id).css('background', '#EEF8FD');
    }

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: 'message/messagereadunread',
        data: {_token: CSRF_TOKEN,messageId:message_id}
    });
}

function delete_message(message_id, method) {
    $('#message_item_' + message_id).fadeOut(500);

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: 'message/messageremove',
        data: {_token: CSRF_TOKEN,id:message_id,me:method}
    });
}