var SITE_URL = 'http://www.studentjibe.com/';
var chats = new Array();
var chat_readers = new Array();
var to_restore = new Array();
var q_im = new Array();
var cq = new Array();
var sec = 5;

function relocate(url) {
  window.location = url;
}

function isSet( variable ){
  return( typeof( variable ) != 'undefined' );
}

function checkEmail(email) {
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if ( !filter.test(email) ) {
    return false;
  } else {
    return true;
  }
}

function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires=" + date.toGMTString();
	} else {
    var expires = "";
  }

  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');

	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
      c = c.substring(1,c.length);
    }

		if (c.indexOf(nameEQ) == 0) {
      return c.substring(nameEQ.length,c.length);
    }
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name, "", -1);
}

function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function unset(array) {
  for ( key in array ) {
    array.splice(key, 1);
  }
  
  return array;
}

function my_substr(text, nr) {
  return text.length > nr ? (text.substr(0, nr - 3) + '...') : text;
}

function utf8_decode (str_data) {
    // Converts a UTF-8 encoded string to ISO-8859-1  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/utf8_decode    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
    // +      input by: Aman Gupta
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Norman "zEh" Fuchs
    // +   bugfixed by: hitwork    // +   bugfixed by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: utf8_decode('Kevin van Zonneveld');
    // *     returns 1: 'Kevin van Zonneveld'    
    var tmp_arr = [],
        i = 0,
        ac = 0,
        c1 = 0,
        c2 = 0,        c3 = 0;
 
    str_data += '';
 
    while (i < str_data.length) {c1 = str_data.charCodeAt(i);
        if (c1 < 128) {
            tmp_arr[ac++] = String.fromCharCode(c1);
            i++;
        } else if (c1 > 191 && c1 < 224) {c2 = str_data.charCodeAt(i + 1);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = str_data.charCodeAt(i + 1);c3 = str_data.charCodeAt(i + 2);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    } 
    return tmp_arr.join('');
}

function str_replace (search, replace, subject, count) {
    // Replaces all occurrences of search in haystack with replace  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/str_replace    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'    
    
    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = r instanceof Array,        sa = s instanceof Array;
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    } 
    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}

function serialize (mixed_value) {
    // Returns a string representation of variable (which can later be unserialized)  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/serialize    // +   original by: Arpad Ray (mailto:arpad@php.net)
    // +   improved by: Dino
    // +   bugfixed by: Andrej Pavlovic
    // +   bugfixed by: Garagoth
    // +      input by: DtTvB (http://dt.in.th/2008-09-16.string-length-in-bytes.html)    // +   bugfixed by: Russell Walker (http://www.nbill.co.uk/)
    // +   bugfixed by: Jamie Beck (http://www.terabit.ca/)
    // +      input by: Martin (http://www.erlenwiese.de/)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
    // +   improved by: Le Torbi (http://www.letorbi.de/)    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
    // +   bugfixed by: Ben (http://benblume.co.uk/)
    // -    depends on: utf8_encode
    // %          note: We feel the main purpose of this function should be to ease the transport of data between php & js
    // %          note: Aiming for PHP-compatibility, we have to translate objects to arrays    // *     example 1: serialize(['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
    // *     example 2: serialize({firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'});
    // *     returns 2: 'a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}'
    var _utf8Size = function (str) {var size = 0,
            i = 0,
            l = str.length,
            code = '';
        for (i = 0; i < l; i++) {code = str.charCodeAt(i);
            if (code < 0x0080) {
                size += 1;
            } else if (code < 0x0800) {
                size += 2;} else {
                size += 3;
            }
        }
        return size;};
    var _getType = function (inp) {
        var type = typeof inp,
            match;
        var key; 
        if (type === 'object' && !inp) {
            return 'null';
        }
        if (type === "object") {if (!inp.constructor) {
                return 'object';
            }
            var cons = inp.constructor.toString();
            match = cons.match(/(\w+)\(/);if (match) {
                cons = match[1].toLowerCase();
            }
            var types = ["boolean", "number", "string", "array"];
            for (key in types) {if (cons == types[key]) {
                    type = types[key];
                    break;
                }
            }}
        return type;
    };
    var type = _getType(mixed_value);
    var val, ktype = ''; 
    switch (type) {
    case "function":
        val = "";
        break;case "boolean":
        val = "b:" + (mixed_value ? "1" : "0");
        break;
    case "number":
        val = (Math.round(mixed_value) == mixed_value ? "i" : "d") + ":" + mixed_value;break;
    case "string":
        val = "s:" + _utf8Size(mixed_value) + ":\"" + mixed_value + "\"";
        break;
    case "array":    case "object":
        val = "a";
/*
            if (type == "object") {
                var objname = mixed_value.constructor.toString().match(/(\w+)\(\)/);                if (objname == undefined) {
                    return;
                }
                objname[1] = this.serialize(objname[1]);
                val = "O" + objname[1].substring(1, objname[1].length - 1);            }
            */
        var count = 0;
        var vals = "";
        var okey;var key;
        for (key in mixed_value) {
            if (mixed_value.hasOwnProperty(key)) {
                ktype = _getType(mixed_value[key]);
                if (ktype === "function") {continue;
                }
 
                okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
                vals += this.serialize(okey) + this.serialize(mixed_value[key]);count++;
            }
        }
        val += ":" + count + ":{" + vals + "}";
        break;case "undefined":
        // Fall-through
    default:
        // if the JS object has a property which contains a null value, the string cannot be unserialized by PHP
        val = "N";break;
    }
    if (type !== "object" && type !== "array") {
        val += ";";
    }return val;
}

function unserialize (data) {
    // Takes a string representation of variable and recreates it  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/unserialize    // +     original by: Arpad Ray (mailto:arpad@php.net)
    // +     improved by: Pedro Tainha (http://www.pedrotainha.com)
    // +     bugfixed by: dptr1988
    // +      revised by: d3x
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)    // +        input by: Brett Zamir (http://brett-zamir.me)
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: Chris
    // +     improved by: James
    // +        input by: Martin (http://www.erlenwiese.de/)    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: Le Torbi
    // +     input by: kilops
    // +     bugfixed by: Brett Zamir (http://brett-zamir.me)
    // -      depends on: utf8_decode    // %            note: We feel the main purpose of this function should be to ease the transport of data between php & js
    // %            note: Aiming for PHP-compatibility, we have to translate objects to arrays
    // *       example 1: unserialize('a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}');
    // *       returns 1: ['Kevin', 'van', 'Zonneveld']
    // *       example 2: unserialize('a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}');    // *       returns 2: {firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'}
    var that = this;
    var utf8Overhead = function (chr) {
        // http://phpjs.org/functions/unserialize:571#comment_95906
        var code = chr.charCodeAt(0);if (code < 0x0080) {
            return 0;
        }
        if (code < 0x0800) {
            return 1;}
        return 2;
    };
 
     var error = function (type, msg, filename, line) {
        throw new that.window[type](msg, filename, line);
    };
    var read_until = function (data, offset, stopchr) {
        var buf = [];var chr = data.slice(offset, offset + 1);
        var i = 2;
        while (chr != stopchr) {
            if ((i + offset) > data.length) {
                error('Error', 'Invalid');}
            buf.push(chr);
            chr = data.slice(offset + (i - 1), offset + i);
            i += 1;
        }return [buf.length, buf.join('')];
    };
    var read_chrs = function (data, offset, length) {
        var buf;
         buf = [];
        for (var i = 0; i < length; i++) {
            var chr = data.slice(offset + (i - 1), offset + i);
            buf.push(chr);
            length -= utf8Overhead(chr);}
        return [buf.length, buf.join('')];
    };
    var _unserialize = function (data, offset) {
        var readdata;var readData;
        var chrs = 0;
        var ccount;
        var stringlength;
        var keyandchrs;var keys;
 
        if (!offset) {
            offset = 0;
        }var dtype = (data.slice(offset, offset + 1)).toLowerCase();
 
        var dataoffset = offset + 2;
        var typeconvert = function (x) {
            return x;};
 
        switch (dtype) {
        case 'i':
            typeconvert = function (x) {return parseInt(x, 10);
            };
            readData = read_until(data, dataoffset, ';');
            chrs = readData[0];
            readdata = readData[1];dataoffset += chrs + 1;
            break;
        case 'b':
            typeconvert = function (x) {
                return parseInt(x, 10) !== 0;};
            readData = read_until(data, dataoffset, ';');
            chrs = readData[0];
            readdata = readData[1];
            dataoffset += chrs + 1;break;
        case 'd':
            typeconvert = function (x) {
                return parseFloat(x);
            };ead_until(data, dataoffset, ';');
            chrs = readData[0];
            readdata = readData[1];
            dataoffset += chrs + 1;
            break;case 'n':
            readdata = null;
            break;
        case 's':
            ccount = read_until(data, dataoffset, ':');chrs = ccount[0];
            stringlength = ccount[1];
            dataoffset += chrs + 2;
 
            readData = read_chrs(data, dataoffset + 1, parseInt(stringlength, 10));chrs = readData[0];
            readdata = readData[1];
            dataoffset += chrs + 2;
            if (chrs != parseInt(stringlength, 10) && chrs != readdata.length) {
                error('SyntaxError', 'String length mismatch');}
 
            // Length was calculated on an utf-8 encoded string
            // so wait with decoding
            readdata = that.utf8_decode(readdata);break;
        case 'a':
            readdata = {};
 
            keyandchrs = read_until(data, dataoffset, ':');chrs = keyandchrs[0];
            keys = keyandchrs[1];
            dataoffset += chrs + 2;
 
            for (var i = 0; i < parseInt(keys, 10); i++) {var kprops = _unserialize(data, dataoffset);
                var kchrs = kprops[1];
                var key = kprops[2];
                dataoffset += kchrs;
                 var vprops = _unserialize(data, dataoffset);
                var vchrs = vprops[1];
                var value = vprops[2];
                dataoffset += vchrs;
                 readdata[key] = value;
            }
 
            dataoffset += 1;
            break;default:
            error('SyntaxError', 'Unknown / Unhandled data type(s): ' + dtype);
            break;
        }
        return [dtype, dataoffset - offset, typeconvert(readdata)];};
 
    return _unserialize((data + ''), 0)[2];
}

function addslashes (str) {
    // Escapes single quote, double quotes and backslash characters in a string with backslashes  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/addslashes    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +   improved by: marrtins
    // +   improved by: Nate
    // +   improved by: Onno Marsman    // +   input by: Denny Wardhana
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Oskar Larsson Högfeldt (http://oskar-lh.name/)
    // *     example 1: addslashes("kevin's birthday");
    // *     returns 1: 'kevin\'s birthday'    
    
    return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

function str_replace (search, replace, subject, count) {
    // Replaces all occurrences of search in haystack with replace
    //
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/str_replace    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'
        var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = r instanceof Array,        sa = s instanceof Array;
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }
    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}

/* ------------------ */
/*
var box = new studentjibe_box({
    width: 400,
    height: 300,
    title: 'Wazzup',
    content: DATA,
    paddingTop: 10,
    paddingBottom: 10,
    paddingLeft: 10,
    paddingRight: 10,
    onsubmit: 'doThis',
    showSubmit: true,
    showCancel: true,
    textSubmit: 'Salveaza',
    textCancel: 'Inchide'
  });
*/
function apply_box() {
  var DATA = '<div>\n\
                <div style="color: red;">Test</div>\n\
                <div style="color: blue;">Test\'er</div>\n\
                <div style="color: red;"><input type="text" id="test" /></div>\n\
              </div>';

  var box = new studentjibe_box({
    width: 400,
    height: 300,
    title: 'Wazzup',
    content: DATA,
    paddingTop: 10,
    paddingBottom: 10,
    paddingLeft: 10,
    paddingRight: 10,
    onsubmit: 'doThis',
    showSubmit: true,
    showCancel: true,
    textSubmit: 'Salveaza',
    textCancel: 'Inchide',
    onCancel: 'cancel_class'
  });
}

function doThis() {
  alert($('#test').val());
}
/* ------------------ */

function class_teacher_select(_obj) {
  var val = $(_obj).val();

  if ( val == '' ) {
    $('#add_teacher').css('display', 'block');
  } else {
    $('#add_teacher').css('display', 'none');
  }
}

function add_class(id, name) {
  $('#course_info').html('Loading...');
  $.ajax({
    data: 'course_id=' + id,
    dataType: 'html',
    type: 'POST',
    url: 'populate_professors',
    success: function (msg) {
      $('#course_info').html('Please select from the course drop down your classes');
      
      var DATA = '<div>\n\
                    <div title="' + name + '" style="font-weight: bold;"><img src="images/icon_accept_24.jpg" alt="" style="float: left; margin-right: 4px;" />' + my_substr(name, 52) + '</div>\n\
                    <div style="color: black; font-weight: bold; line-height: 22px; padding-bottom: 10px; padding-top: 10px;">Add professor</div>\n\
                    <div align="center">\n\
                      <select id="teacher_id" onchange="javascript: class_teacher_select(this);"></select>\n\
                      <div style="height: 5px;"><!-- --></div>\n\
                      <div id="add_teacher" style="display: none">\n\
                        <input onclick="javascript: if ( $(this).val() == \'First name\' ) { $(this).val(\'\'); }" style="height: 18px; width: 170px;" type="text" value="First name" id="prof_first_name" />\n\
                        <input onclick="javascript: if ( $(this).val() == \'Last name\' ) { $(this).val(\'\'); }" style="height: 18px; width: 170px;" type="text" value="Last name" id="prof_last_name" />\n\
                      </div>\n\
                      <input type="hidden" id="class_id" value="' + id + '" />\n\
                    </div>\n\
                  </div>';

      var box = new studentjibe_box({
        width: 400,
        title: 'Add new class',
        content: DATA,
        onsubmit: 'save_class',
        onCancel: 'cancel_class'
      });

      if (  msg == '' ) {
        $('#teacher_id').css('display', 'none');
        $('#add_teacher').css('display', 'block');
      } else {
        $('#teacher_id').append(msg);
      }
    }
  });
}

function save_class() {
  window.location = 'register_step_3?action=add_class&class=' + $('#class_id').val() + '&teacher_first=' + $('#prof_first_name').val() + '&teacher_last=' + $('#prof_last_name').val() + '&teacher_id=' + $('#teacher_id').val();
}
function cancel_class() {
  $('#add_class').css({'color' : '#333333'}).val('Type here your class name...');
}

function register_delete_class(id) {
  var DATA = 'Are you sure you want to remove this class? <input type="hidden" id="class_id" value="' + id + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove class?',
    content: DATA,
    onsubmit: 'remove_class',
    onCancel: 'cancel_class'
  });
}

function remove_class() {
  window.location = 'register_step_3?action=remove_class&class=' + $('#class_id').val();
}

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
              source: "search_all_users",\n\
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
            <div id="show_image_onsearch" style="position: absolute; margin-top: -19px; margin-left: 230px; display: none;"><img src="images/ajax-loader.gif"/></div>\n\
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
  if ( $('#message_username').val() != '' ) {
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'send_message',
      data: 'to=' + $('#message_username').val() + '&subject=' + $('#message_subject').val() + '&message=' + $('#message_message').val(),
      success: function (msg) {
        var DATA = 'Message was succesfully sent';

        var box = new studentjibe_box({
          width: 400,
          title: 'Message succesfully sent',
          content: DATA,
          showCancel: false,
          onsubmit: 'return_before',
          textSubmit: 'Close',
          backgroundBoxColor : '#FFFFCC'
        });
      }
    });
  }
}
function return_before() {
  window.location = window.location;
}

function comment_post_activity(post_id) {
  if ( $('#comment_' + post_id).css('display') == 'none' ) {
    $('#comment_' + post_id).show();
    $('#comment_' + post_id).find('textarea').focus();
  } else {
    $('#comment_' + post_id).hide();
  }
}

function remove_post_comment(comment_id) {
  comment_id = parseInt(comment_id, 10);
  if ( comment_id > 0 ) {
    $('#comment_post_' + comment_id).fadeOut(500);

    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'remove_comment',
      data: 'comment_id=' + comment_id,
      success: function (msg) {}
    });
  }
}

function remove_post_comment_carpool(comment_id) {
  comment_id = parseInt(comment_id, 10);
  if ( comment_id > 0 ) {
    $('#comment_post_' + comment_id).fadeOut(500);

    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'remove_comment_carpool',
      data: 'comment_id=' + comment_id,
      success: function (msg) {}
    });
  }
}

function love_post(post_id) {
  $('#like_' + post_id).html('Loading...');

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'like_unlike',
    data: 'post_id=' + post_id,
    success: function (msg) {
      var links = '';
      var test = '';
      
      if ( msg == '0' ) {
        $('#like_' + post_id).html('Like');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 1 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : 'white', 'margin-top' : '0px', 'padding': '0px'}).html('');
        } else {
          if ( links == 2 ) {
            test = '';

            $('#love_container_' + post_id).find('a').each(function () {
              if ( $(this).attr('href') != my_link ) {
                test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a> liked this';
              }
            });

            $('#love_container_' + post_id).html(test);
          } else {
            if ( links == 3 ) {
              var tester = new Array();

              var c = 0;
              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  tester[c] = '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  c++;
                }
              });

              $('#love_container_' + post_id).html(tester[0] + ' and ' + tester[1] + ' liked this');
            } else {
              var qqq = $('#love_container_' + post_id).find('a').length;
              var nrr = 0;
              test = '';

              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  if ( nrr < qqq - 1 ) {
                    test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>, ';
                  } else {
                    test += ' and <a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  }
                }

                nrr++;
              });

              test += ' liked this';

              $('#love_container_' + post_id).html(test);
            }
          }
        }
      } else {
        $('#like_' + post_id).html('Unlike');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 0 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : '#F4F4F4', 'margin-top' : '10px', 'padding': '4px'}).html('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> liked this');
        } else {
          if ( links == 1 ) {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> and ');
          } else {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a>, ');
          }
        }
      }
    }
  });
}

function carpool_love_post(post_id) {
  $('#like_' + post_id).html('Loading...');

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'like_unlike_carpool',
    data: 'post_id=' + post_id,
    success: function (msg) {
      var links = '';
      var test = '';
      
      if ( msg == '0' ) {
        $('#like_' + post_id).html('Like');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 1 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : 'white', 'margin-top' : '0px', 'padding': '0px'}).html('');
        } else {
          if ( links == 2 ) {
            test = '';

            $('#love_container_' + post_id).find('a').each(function () {
              if ( $(this).attr('href') != my_link ) {
                test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a> liked this';
              }
            });

            $('#love_container_' + post_id).html(test);
          } else {
            if ( links == 3 ) {
              var tester = new Array();

              var c = 0;
              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  tester[c] = '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  c++;
                }
              });

              $('#love_container_' + post_id).html(tester[0] + ' and ' + tester[1] + ' liked this');
            } else {
              var qqq = $('#love_container_' + post_id).find('a').length;
              var nrr = 0;
              test = '';

              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  if ( nrr < qqq - 1 ) {
                    test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>, ';
                  } else {
                    test += ' and <a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  }
                }

                nrr++;
              });

              test += ' liked this';

              $('#love_container_' + post_id).html(test);
            }
          }
        }
      } else {
        $('#like_' + post_id).html('Unlike');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 0 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : '#F4F4F4', 'margin-top' : '10px', 'padding': '4px'}).html('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> liked this');
        } else {
          if ( links == 1 ) {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> and ');
          } else {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a>, ');
          }
        }
      }
    }
  });
}

function profile_love_post(post_id) {
  $('#like_' + post_id).html('Loading...');

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'like_unlike',
    data: 'post_id=' + post_id,
    success: function (msg) {
      var links = '';
      var test = '';

      if ( msg == '0' ) {
        $('#like_' + post_id).html('Like');
      } else {
        $('#like_' + post_id).html('Unlike');
      }
    }
  });
}

function course_love_post(post_id) {
  $('#like_' + post_id).html('Loading...');

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'like_unlike_course',
    data: 'post_id=' + post_id,
    success: function (msg) {
      var links = '';
      var test = '';

      if ( msg == '0' ) {
        $('#like_' + post_id).html('Like');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 1 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : 'white', 'margin-top' : '0px', 'padding': '0px'}).html('');
        } else {
          if ( links == 2 ) {
            test = '';

            $('#love_container_' + post_id).find('a').each(function () {
              if ( $(this).attr('href') != my_link ) {
                test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a> liked this';
              }
            });

            $('#love_container_' + post_id).html(test);
          } else {
            if ( links == 3 ) {
              var tester = new Array();

              var c = 0;
              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  tester[c] = '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  c++;
                }
              });

              $('#love_container_' + post_id).html(tester[0] + ' and ' + tester[1] + ' liked this');
            } else {
              var qqq = $('#love_container_' + post_id).find('a').length;
              var nrr = 0;
              test = '';

              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  if ( nrr < qqq - 1 ) {
                    test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>, ';
                  } else {
                    test += ' and <a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  }
                }

                nrr++;
              });

              test += ' liked this';

              $('#love_container_' + post_id).html(test);
            }
          }
        }
      } else {
        $('#like_' + post_id).html('Unlike');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 0 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : '#F4F4F4', 'margin-top' : '10px', 'padding': '4px'}).html('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> liked this');
        } else {
          if ( links == 1 ) {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> and ');
          } else {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a>, ');
          }
        }
      }
    }
  });
}

function remove_course_post_comment(comment_id) {
  comment_id = parseInt(comment_id, 10);
  if ( comment_id > 0 ) {
    $('#comment_post_' + comment_id).fadeOut(500);

    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'remove_course_comment',
      data: 'comment_id=' + comment_id,
      success: function (msg) {}
    });
  }
}

$(document).ready(function () {
  $('#school').mouseover(function() {
    $(this).find('.absolute').css('display', 'block');
    $(this).find('.menu_link').attr('class', 'menu_link_selected');
  }).mouseout(function() {
    $(this).find('.absolute').css('display', 'none');
    $(this).find('.menu_link_selected').attr('class', 'menu_link');
  });

  $('#more').mouseover(function() {
    $(this).find('.absolute').css('display', 'block');
    $(this).find('.menu_link').attr('class', 'menu_link_selected');
  }).mouseout(function() {
    $(this).find('.absolute').css('display', 'none');
    $(this).find('.menu_link_selected').attr('class', 'menu_link');
  });

  $('#discussion').mouseover(function() {
    $(this).find('.absolute').css('display', 'block');
    $(this).find('.menu_link').attr('class', 'menu_link_selected');
  }).mouseout(function() {
    $(this).find('.absolute').css('display', 'none');
    $(this).find('.menu_link_selected').attr('class', 'menu_link');
  });

  $('#right_submenu').mouseover(function() {
    $(this).find('.absolute').css('display', 'block');
    //$(this).find('.menu_link').attr('class', 'menu_link_selected');
  }).mouseout(function() {
    $(this).find('.absolute').css('display', 'none');
    //$(this).find('.menu_link_selected').attr('class', 'menu_link');
  });
  
  $('#general_search_button').click(function () {
    if ( $('#general_search').val() != 'Find people and study groups' && trim( $('#general_search').val() ) != '' ) {
      window.location = 'search?q=' + $('#general_search').val();
    }
  });
  
  $('#general_search').focus(function () {
    if ( $(this).val() == 'Search' ) {
      $(this).css('color', '#000000').val('');
    }
  }).blur(function () {
    if ( $(this).val() == '' ) {
      $(this).css('color', '#D2D2D2').val('Search');
    }
  }).autocomplete({
    source: "search_all_items",
    minLength: 2,
    select: function( event, ui ) {
      $(this).unbind('keypress');
      //window.location = 'test?q=' + $(this).val();
      window.location = ui.item.id;
    },
    search: function(){
      $("#show_image_onsearch_g").css("display","block").delay(10000).fadeOut(300);;
    },
    open: function(){
      $("#show_image_onsearch_g").css("display","none");
    }
  }).keypress(function (ev) {
    if ( ev.keyCode == '13' ) {
      window.location = 'search?q=' + $(this).val();
    }
  });
  
  $('#my_notifications').click(function () {
    $('.chats_absolute').hide();
    $('#my_notifications').removeClass().addClass('globe_news_inactive').html('');
    
    if ( $('.notifications_absolute').css('display') == 'block' ) {
      $('.notifications_absolute').hide();
    } else {
      $('.notifications_absolute').html('<div align="center" style="padding-top: 50px; padding-bottom: 50px;"><img width="20" src="images/loader.gif" alt="Loading.." /></div>').show();
      
      $.ajax({
        type: 'POST',
        dataType: 'html',
        url: 'my_notifications',
        success: function (msg) {
          $('.notifications_absolute').html(msg);
        }
      });
    }
  });
  
  $('#my_chats').click(function () {
    $('.notifications_absolute').hide();
    
    if ( $('.chats_absolute').css('display') == 'block' ) {
      $('.chats_absolute').hide();
    } else {
      $('.chats_absolute').html('<div align="center" style="padding-top: 50px; padding-bottom: 50px;"><img width="20" src="images/loader.gif" alt="Loading.." /></div>').show();
      
      print_chat_users();
    }
  });

  
});

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

function exp_decay(i){  
  var interval = 2;
  var rate = 0.10;    
  return ( parseInt(interval * Math.pow((1 + rate), i)) * 1000 );         
}

function check_interval( sec, user_id ) {  
    clearInterval(chat_readers[user_id]);
    chat_readers[user_id] = setInterval("chat_content(\'" + user_id + "\');", exp_decay(sec));
    
    //console.log('%cChat refresh time: ' + exp_decay(sec)/1000 + ' sec', 'color:green; background-color:white'); 
}

function read_this_chat(user_id) {    
  $.ajax({
    type: 'POST',
    dataType: 'html',
    data: 'user_id=' + user_id,
    url: 'read_this_chat'
  });
}

function load_chat(user_id) {    
  $('.chats_absolute').hide();
  
  read_this_chat(user_id);
  
  var max_c = chats.length;
  var chat_id = -1;
  cq[user_id] = true;
  q_im[user_id] = true;
  
  for ( var i = 0; i < max_c; i++ ) {
    if ( chats[i][1] == user_id ) {
      chats[i][6] = 0;
      chat_id = chats[i][3];
    }
  }
  
  get_active_chats();
  
  create_chat_box(user_id, chat_id);
  
  chat_content(user_id);
  //chat_readers[user_id] = setInterval("chat_content(\'" + user_id + "\');", 5000);    
}

function animate_down(user_id) {
  $('#big_t_' + user_id).animate({scrollTop: $('#big_t_' + user_id + ' > #chat_area_' + user_id).outerHeight()}, -2000);
}

var msgLength = null;
function chat_content( user_id ) {    
  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'read_chat',
    data: 'user_id=' + user_id,
    success: function (msg) {            
      if ( msgLength != msg.length ) {
        //console.log('%cChat refresh time: RESET', 'color:green; background-color:white'); 
        sec = 5;
      }      
      msgLength = msg.length;
      $('#chat_area_' + user_id).html(msg); 
      sec++;      
      if ( q_im[user_id] == true ) {          
        if ( cq[user_id] ) {
          var objDiv = document.getElementById("big_t_" + user_id);          
          objDiv.scrollTop = objDiv.scrollHeight;
          cq[user_id] = false;
        } else {
          animate_down(user_id);          
        }        
      check_interval( sec, user_id ); 
      } 
    }        
  });      
}

function read_course_chat(course_id) {
    
  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'read_course_chat',
    data: 'course_id=' + course_id,
    success: function (msg) {
      $('#chat_course_area').html(msg);
      $('#chat_box_text').animate({scrollTop: $('#chat_box_text > #chat_course_area').outerHeight()}, -2000);
    }
  });
}

function close_chat_box (user_id) {  
  clearInterval(chat_readers[user_id]);
  $('#chat_box_' + user_id).remove();
  sec = 5;
  console.log('%cChat closed', 'color:green; background-color:white'); 
  to_restore[user_id] = '';  
  save_restore();
}

function add_chat_message(user_id) {
  var new_message = $('#new_message_' + user_id).val();
  
  if ( trim(new_message) != '' ) {
    $('#new_message_' + user_id).val('').focus();
    
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'new_chat_message',
      data: 'user_id=' + user_id + '&message=' + new_message,
      success: function (msg) {}
    });
  }
  chat_content(user_id);
}

function add_course_chat_message(course_id, user_id) {
  var new_message = $('#new_course_message_' + user_id).val();
  
  if ( trim(new_message) != '' ) {
    $('#new_course_message_' + user_id).val('').focus();
    
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'new_course_chat_message',
      data: 'course_id=' + course_id + '&message=' + new_message,
      success: function (msg) {}
    });
  }
}

function create_chat_box(user_id, chat_id) {
  if ( chats.length > 0 ) {
    if ( $('#chat_box_' + user_id).length == 0 ) {
      
      var NEW_BOX = ' <div class="chat_box" id="chat_box_' + user_id + '">\n\
                        <div class="chat_box_title">\n\
                          <a id="close_this_chat_box_' + user_id + '" onclick="javascript: close_chat_box(\'' + user_id + '\');" class="chat_box_close" href="javascript: void(0);">x</a>\n\
                          <a id="minimize_this_chat_box_' + user_id + '" class="chat_box_close" style="margin-right: -2px;" href="javascript: void(0);">_</a>\n\
                          <a class="chat_box_title_a" href="user/' + chats[chat_id][7] + '-' + user_id + '">' + chats[chat_id][0] + '</a>\n\
                          \n\
                        </div>\n\
                        <div class="chat_box_middle">\n\
                          <div id="big_t_' + user_id + '" style="overflow: auto; height: 215px;">\n\
                            <div onmouseout="javascript: q_im[' + user_id + '] = true;" onmouseover="javascript: q_im[' + user_id + '] = false;" id="chat_area_' + user_id + '"></div>\n\
                          </div>\n\
                        </div>\n\
                        <div class="chat_box_bottom">\n\
                          <input onkeypress="javascript: if ( event.keyCode == \'13\' ) { add_chat_message(\'' + user_id + '\'); }" onfocus="javascript: if ( $(this ).val() == \'Enter your message\' ) { $(this).val(\'\'); }" id="new_message_' + user_id + '" class="chat_box_bottom_input" type="text" value="Enter your message" />\n\
                        </div>\n\
                      </div>';
      
      $('body').append(NEW_BOX);
      
      $('#chat_box_' + user_id).hover(
        function(){
          $('#chat_box_' + user_id + ' > .chat_box_title').css('background-color', '#f0f0f0');},          
        function(){
          $('#chat_box_' + user_id + ' > .chat_box_title').css('background-color', '#F5F5F5');}
      );
      
            
      if ( $('#chat_box_' + user_id).css('top') == '-1px' || $('#chat_box_' + user_id).css('left') == '-1px' ) {
        //var box_width = Math.floor ( ( $(window).width() - $('#chat_box_' + user_id).width() ) / 2 );
        //var box_height = Math.floor ( ( $(window).height() - $('#chat_box_' + user_id).height() ) / 2 );
       
        var chats_active = 0;        
        $('.chat_box').each(function(){
          chats_active++;       
        });
      
        var box_width =  $(window).width() - $('#chat_box_' + user_id).width() - (253 * chats_active) + 253;                         
        var box_height = $(window).height() - $('#chat_box_' + user_id).height() - 3; 
        
        $('#chat_box_' + user_id).css({ 'left' : box_width + 'px', 'top': box_height + 'px', 'position':'fixed'  });
       
        $('#minimize_this_chat_box_' + user_id).click(function(){
          if ( $('#minimize_this_chat_box_' + user_id).html() == '_' ) {
            $('#chat_box_'+ user_id + '  > .chat_box_middle').hide();
            $('#chat_box_'+ user_id + '  > .chat_box_bottom').hide();
            $('#minimize_this_chat_box_' + user_id).html('+');
            $('#chat_box_' + user_id).css({ 'left' : box_width + 'px', 'top': 258 + box_height + 'px', 'position':'fixed' });
          } else
          if ( $('#minimize_this_chat_box_' + user_id).html() == '+' ) {
            $('#chat_box_'+ user_id + '  > .chat_box_middle').show();
            $('#chat_box_'+ user_id + '  > .chat_box_bottom').show();
            $('#minimize_this_chat_box_' + user_id).html('_');  
            $('#chat_box_' + user_id).css({ 'left' : box_width + 'px', 'top': box_height + 'px', 'position':'fixed'  });
          }
        });
        

        to_restore[user_id] = box_height + '-' + box_width;
        save_restore();
      }      
      
//      $('#chat_box_' + user_id).draggable({handle: '.chat_box_title', containment: 'body', stop: function (event, ui) {
//        to_restore[user_id] = $(this).css('top') + '-' + $(this).css('left');
//        
//        save_restore();
//      }});
    }
  }
}

function save_restore() {
  createCookie('__b', str_replace(';', "###", serialize(to_restore)), 2);
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

function get_notifications() {
  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'my_new_notifications',
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

function discussion_love_post(post_id) {
  $('#like_' + post_id).html('Loading...');

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'like_unlike_discussion',
    data: 'post_id=' + post_id,
    success: function (msg) {
      var links = '';
      var test = '';

      if ( msg == '0' ) {
        $('#like_' + post_id).html('Like');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 1 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : 'white', 'margin-top' : '0px', 'padding': '0px'}).html('');
        } else {
          if ( links == 2 ) {
            test = '';

            $('#love_container_' + post_id).find('a').each(function () {
              if ( $(this).attr('href') != my_link ) {
                test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a> liked this';
              }
            });

            $('#love_container_' + post_id).html(test);
          } else {
            if ( links == 3 ) {
              var tester = new Array();

              var c = 0;
              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  tester[c] = '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  c++;
                }
              });

              $('#love_container_' + post_id).html(tester[0] + ' and ' + tester[1] + ' liked this');
            } else {
              var qqq = $('#love_container_' + post_id).find('a').length;
              var nrr = 0;
              test = '';

              $('#love_container_' + post_id).find('a').each(function () {
                if ( $(this).attr('href') != my_link ) {
                  if ( nrr < qqq - 1 ) {
                    test += '<a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>, ';
                  } else {
                    test += ' and <a class="user_link" style="font-weight: normal;" href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
                  }
                }

                nrr++;
              });

              test += ' liked this';

              $('#love_container_' + post_id).html(test);
            }
          }
        }
      } else {
        $('#like_' + post_id).html('Unlike');

        links = $('#love_container_' + post_id).find('a').length;

        if ( links == 0 ) {
          $('#love_container_' + post_id).css({'font-size' : '11px', 'background' : '#F4F4F4', 'margin-top' : '10px', 'padding': '4px'}).html('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> liked this');
        } else {
          if ( links == 1 ) {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a> and ');
          } else {
            $('#love_container_' + post_id).prepend('<a class="user_link" style="font-weight: normal;" href="' + my_link + '">You</a>, ');
          }
        }
      }
    }
  });
}

function remove_discussion_post_comment(comment_id) {
  comment_id = parseInt(comment_id, 10);
  if ( comment_id > 0 ) {
    $('#comment_post_' + comment_id).fadeOut(500);

    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'remove_discussion_comment',
      data: 'comment_id=' + comment_id,
      success: function (msg) {}
    });
  }
}

function view_all_colleagues_in_course(course_id) {
  var DATA = '<div>\n\
                <div style="text-align: center; font-size: 11px; line-height: 80px;">Loading...</div>\n\
              </div>';
  
  var box = new studentjibe_box({
            width: 420,
            title: 'Loading colleagues in course',
            content: DATA,
            showSubmit: false,
            showCancel: false
          });

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'get_all_course_colleagues',
    data: 'course_id=' + course_id,
    success: function (msg) {
      closeBox();

      var box = new studentjibe_box({
          width: 440,
          title: 'Colleagues in course',
          content: msg,
          showSubmit: false,
          showCancel: true,
          textCancel: 'Close'
        });
    }
  });
}

function add_new_course_date(course_id) {
  var hours = '';
  var my_hours = 0;
  var my_day = 'am';

  for ( var i = 0; i <= 23; i++ ) {
    my_day = i < 12 ? 'am' : 'pm';
    my_hours = i >= 13 ? ( i - 12 ) : i;
    hours += '<option value="' + i + ':00">' + my_hours + ':00 ' + my_day + '</option>';
    hours += '<option value="' + i + ':30">' + my_hours + ':30 ' + my_day + '</option>';
  }
  
  var DATA = '<div>\n\
                <table>\n\
                  <tr>\n\
                    <td>\n\
                      Date\n\
                    </td>\n\
                    <td>\n\
                      <input readonly id="date" style="width: 130px;" class="date-pick" type="text" />\n\
                      <img style="padding-top: 4px;" height="16" src="images/icon_course_date.jpg" alt="" />\n\
                      <select id="hour">\n\
                        ' + hours + '\n\
                      </select>\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td>\n\
                      Title\n\
                    </td>\n\
                    <td>\n\
                      <input id="title" type="text" style="width: 180px;" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td width="90">\n\
                      Description\n\
                    </td>\n\
                    <td>\n\
                      <textarea id="description" style="width: 280px; height: 80px;"></textarea>\n\
                    </td>\n\
                  </tr>\n\
                </table>\n\
                <input id="course_id_b" type="hidden" value="' + course_id + '" style="width: 180px;" />\n\
              </div>';

  var box = new studentjibe_box({
              width: 420,
              title: 'Add new date',
              content: DATA,
              showSubmit: true,
              showCancel: true,
              textCancel: 'Cancel',
              textSubmit: 'Add date',
              onsubmit: 'add_date'
            });

//  Date.firstDayOfWeek = 0;
//  Date.format = 'dd.mm.yyyy';

  $('.date-pick').datepicker({ dateFormat: 'dd.mm.yy' })
}

function add_date() {
  var title = $('#title').val();
  var description = $('#description').val();
  var date = $('#date').val();
  var hour = $('#hour').val();

  var error = false;
  if ( trim(title) == '' ) {
    error = true;
    $('#title').css('background', '#FFCCCC');
  } else {
    $('#title').css('background', '#FFFFFF');
  }

  if ( trim(description) == '' ) {
    error = true;
    $('#description').css('background', '#FFCCCC');
  } else {
    $('#description').css('background', '#FFFFFF');
  }

  if ( trim(date) == '' ) {
    error = true;
    $('#date').css('background', '#FFCCCC');
  } else {
    $('#date').css('background', '#FFFFFF');
  }

  if ( !error ) {
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'insert_course_date',
      data: 'course_id=' + $('#course_id_b').val() + '&title=' + title + '&description=' + description + '&date=' + date + '&hour=' + hour,
      success: function (msg) {
        window.location = window.location;
      }
    });
  }
}

function view_all_courses_date(course_id) {
  var DATA = '<div>\n\
                <div style="text-align: center; font-size: 11px; line-height: 80px;">Loading...</div>\n\
              </div>';

  var box = new studentjibe_box({
            width: 420,
            height: 300,
            title: 'View all dates',
            content: DATA,
            showSubmit: false,
            showCancel: true,
            textCancel: 'Close'
          });

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'get_all_course_dates',
    data: 'course_id=' + course_id,
    success: function (msg) {
      $('.box_container').html(msg);
    }
  });
}

function view_all_files_in_course(course_id) {
  var DATA = '<div>\n\
                <div style="text-align: center; font-size: 11px; line-height: 80px;">Loading...</div>\n\
              </div>';

  var box = new studentjibe_box({
            width: 410,
            height: 300,
            title: 'Files in course',
            content: DATA,
            showSubmit: false,
            showCancel: true,
            textCancel: 'Close'
          });

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'get_all_course_files',
    data: 'course_id=' + course_id,
    success: function (msg) {
      $('.box_container').html(msg);
    }
  });
}

function read_unread_message(message_id, _obj) {
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
    url: 'message_read_unread',
    data: 'action=read_unread&message_id=' + message_id
  });
}

function delete_message(message_id, method) {
  $('#message_item_' + message_id).fadeOut(500);
  
  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'message_delete',
    data: 'action=remove&message_id=' + message_id + '&me=' + method
  });
}

function populate_courses() {
  var department = $('#departments').val();
  
  $.ajax({
    type: "POST",
    url: "get_courses",
    data: "action=get_courses&department=" + department,
    success: function(msg){
      $('#departments_courses').html(msg);
    }
  });
}

function add_edit_class(id, name) {
  $('#course_info').html('Loading...');
  $.ajax({
    data: 'course_id=' + id,
    dataType: 'html',
    type: 'POST',
    url: 'populate_professors',
    success: function (msg) {
      $('#course_info').html('Please select from the course drop down your classes');

      var DATA = '<div>\n\
                    <div style="font-weight: bold;"><img src="images/icon_accept_24.jpg" alt="" style="float: left; margin-right: 4px;" />' + name + '</div>\n\
                    <div style="color: black; font-weight: bold; line-height: 22px; padding-bottom: 10px; padding-top: 10px;">Add professor</div>\n\
                    <div align="center">\n\
                      <select id="teacher_id" onchange="javascript: class_teacher_select(this);"></select>\n\
                      <div style="height: 5px;"><!-- --></div>\n\
                      <div id="add_teacher" style="display: none">\n\
                        <input onclick="javascript: if ( $(this).val() == \'First name\' ) { $(this).val(\'\'); }" style="height: 18px; width: 170px;" type="text" value="First name" id="prof_first_name" />\n\
                        <input onclick="javascript: if ( $(this).val() == \'Last name\' ) { $(this).val(\'\'); }" style="height: 18px; width: 170px;" type="text" value="Last name" id="prof_last_name" />\n\
                      </div>\n\
                      <input type="hidden" id="class_id" value="' + id + '" />\n\
                    </div>\n\
                  </div>';

      var box = new studentjibe_box({
        width: 400,
        title: 'Add new class',
        content: DATA,
        onsubmit: 'save_edit_class',
        onCancel: 'cancel_edit_class'
      });

      if (  msg == '' ) {
        $('#teacher_id').css('display', 'none');
        $('#add_teacher').css('display', 'block');
      } else {
        $('#teacher_id').append(msg);
      }
    }
  });
}

function save_edit_class() {
  window.location = 'edit_profile_2?action=add_class&class=' + $('#class_id').val() + '&teacher_first=' + $('#prof_first_name').val() + '&teacher_last=' + $('#prof_last_name').val() + '&teacher_id=' + $('#teacher_id').val();
}
function cancel_edit_class() {
  $('#add_class').css({'color' : '#333333'}).val('Type here your class name...');
}

function edit_delete_class(id) {
  var DATA = 'Are you sure you want to remove this class? <input type="hidden" id="class_id" value="' + id + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove class?',
    content: DATA,
    onsubmit: 'remove_edit_class',
    onCancel: 'cancel_edit_class'
  });
}

function remove_edit_class() {
  window.location = 'edit_profile_2?action=remove_class&class=' + $('#class_id').val();
}

function upload_article() {
  $('.news_article_add').toggle();
}

function delete_article(article_id) {
  var DATA = 'Are you sure you want to remove this report? <input type="hidden" id="article_id" value="' + article_id + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove article?',
    content: DATA,
    onsubmit: 'remove_article',
    textCancel: 'No',
    textSubmit: 'Yes'
  });
}

function remove_article() {
  var article_id = $('#article_id').val();
  article_id = parseInt(article_id, 10);

  if ( article_id > 0 ) {
    window.location = str_replace('/article/', '/edit_article/', window.location) + '&action=delete';
  }
}

function news_right(action) {
  if ( action == 1 )  {
    $('#right_news_link_box2').removeAttr('style');
    $('#right_news_link_box1').attr('style', 'background: #E8FAFE');
    $('.right_news_box2').hide();
    $('.right_news_box1').show();
  } else {
    $('#right_news_link_box1').removeAttr('style');
    $('#right_news_link_box2').attr('style', 'background: #E8FAFE');
    $('.right_news_box1').hide();
    $('.right_news_box2').show();
  }
}

function new_carpool() {
  
  var DATA = '\
<div>\n\
  <table border="0" cellpadding="6">\n\
    <tr>\n\
      <td colspan="2" style="line-height: 22px;">\n\
        <div style="font-size: 15px; font-weight: bold;">From:</div>\n\
      </td>\n\
      <td style="line-height: 22px;">\n\
      </td>\n\
      <td colspan="2" style="line-height: 22px;">\n\
        <div style="font-size: 15px; font-weight: bold;">To:</div>\n\
      </td>\n\
    </tr>\n\
    <tr>\n\
      <td style="line-height: 22px;">\n\
        <b>City</b> or <b>Location</b> <br />\n\
        <input id="start_city" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 160px;" type="text" />\n\
      </td>\n\
      <td style="line-height: 22px;">\n\
        <b>State</b> <br />\n\
        <select id="starting_state" style="border: 1px solid #D5D5D5; height: 20px; width: 80px;">\n\
          ' + us_states + '\n\
        </select>\n\
      </td><td><div style="width: 40px;"></div></td>\n\
      <td style="line-height: 22px;">\n\
        <b>City</b> or <b>Location</b> <br />\n\
        <input id="destination_city" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 160px;" type="text" />\n\
      </td>\n\
      <td style="line-height: 22px;">\n\
        <b>State</b> <br />\n\
        <select id="destination_state" style="border: 1px solid #D5D5D5; height: 20px; width: 80px;">\n\
          ' + us_states + '\n\
        </select>\n\
      </td>\n\
    </tr>\n\
    <tr>\n\
      <td style="line-height: 22px;">\n\
        Date <br />\n\
        <input readonly id="datepicker" class="date-pick" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" />\n\
        <img style="padding-top: 4px;" height="16" src="images/icon_course_date.jpg" alt="" />\n\
      </td>\n\
      <td colspan="3" style="line-height: 22px;" align="center">\n\
        Time <br />\n\
        <select id="time" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
          ' + times + '\n\
        </select>\n\
      </td>\n\
      <td style="line-height: 22px;">\n\
        Prefered gender <br />\n\
        <select id="gender" style="border: 1px solid #D5D5D5; height: 20px; width: 80px;">\n\
          <option value=""></option>\n\
          <option value="0">Male</option>\n\
          <option value="1">Female</option>\n\
        </select>\n\
      </td>\n\
    </tr>\n\
    <tr>\n\
      <td colspan="5" style="padding-top: 10px;">\n\
        <textarea id="content_carpool" style="border: 1px solid #D5D5D5; height: 60px; width: 570px; padding: 5px;"></textarea>\n\
      </td>\n\
    </tr>\n\
  </table>\n\
</div>';

  var box = new studentjibe_box({
    width: 635,
    title: 'Add new carpool',
    content: DATA,
    onsubmit: 'add_new_carpool',
    textSubmit: 'Post'
  });

//  Date.firstDayOfWeek = 0;
//  Date.format = 'dd.mm.yyyy';

  $('#datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
}

function add_new_carpool() {
//  var offer_type = 0;
//  var subject = '';
  var date = $('#datepicker').val();
  var time = $('#time').val();
  var gender = $('#gender').val();
//  var returning_time = '';
  var starting_state = $('#starting_state').val();
  var start_city = $('#start_city').val();
  var destination_state = $('#destination_state').val();
  var destination_city = $('#destination_city').val();
  var content_carpool = $('#content_carpool').val();

  var error = false;
//  if ( trim(subject) == '' ) {
//    error = true;
//    $('#subject').css('border', '1px solid red');
//  } else {
//    $('#subject').css('border', '1px solid #D5D5D5');
//  }

  if ( trim(date) == '' ) {
    error = true;
    $('#datepicker').css('border', '1px solid red');
  } else {
    $('#datepicker').css('border', '1px solid #D5D5D5');
  }

  if ( trim(starting_state) == '' ) {
    error = true;
    $('#starting_state').css('border', '1px solid red');
  } else {
    $('#starting_state').css('border', '1px solid #D5D5D5');
  }

  if ( trim(start_city) == '' ) {
    error = true;
    $('#start_city').css('border', '1px solid red');
  } else {
    $('#start_city').css('border', '1px solid #D5D5D5');
  }

  if ( trim(destination_state) == '' ) {
    error = true;
    $('#destination_state').css('border', '1px solid red');
  } else {
    $('#destination_state').css('border', '1px solid #D5D5D5');
  }

  if ( trim(destination_city) == '' ) {
    error = true;
    $('#destination_city').css('border', '1px solid red');
  } else {
    $('#destination_city').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $.ajax({
      data: 'date=' + date + '&time=' + time + '&gender=' + gender + '&starting_state=' + starting_state + '&start_city=' + start_city + '&destination_state=' + destination_state + '&destination_city=' + destination_city + '&content_carpool=' + content_carpool,
      dataType: 'html',
      url: 'post_carpool',
      type: 'POST',
      success: function () {
        window.location = window.location;
      }
    });
  }
}

function remove_carpool(carpool_id, page) {
  var DATA = 'Are you sure you want to remove this announcement? <input type="hidden" id="carpool_id" value="' + carpool_id + '" /> <input type="hidden" id="page_id" value="' + page + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove carpool?',
    content: DATA,
    onsubmit: 'remove_carpool_now',
    textCancel: 'No',
    textSubmit: 'Yes'
  });
}

function remove_carpool_now() {
  var carpool_id = $('#carpool_id').val();
  carpool_id = parseInt(carpool_id, 10);
  var page = $('#page_id').val();

  if ( carpool_id > 0 ) {
    window.location = 'carpool?page=' + page + '&action=delete&rsvp=yes&carpool_id=' + carpool_id;
  }
}

function edit_carpool(carpool_id, page) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading carpool...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'carpool_id=' + carpool_id + '&action=load',
    dataType: 'html',
    url: 'update_carpool',
    type: 'POST',
    success: function (msg) {
      var data = msg.split('/@#');

      closeBox();

      var DATA = '<div>\n\
                    <table>\n\
                      <tr>\n\
                        <td colspan="4" style="padding-bottom: 10px;">\n\
                          <input' + ( data[0] == '0' ? ' checked' : '' ) + ' name="type" id="box_c_offer" type="radio" /> Offer ride\n\
                          <input' + ( data[0] == '1' ? ' checked' : '' ) + ' name="type" type="radio" /> Need ride\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td style="line-height: 22px; padding-bottom: 10px;" colspan="4">\n\
                          Subject <br />\n\
                          <input id="subject" value="' + data[1] + '" style="border: 1px solid #D5D5D5; height: 18px; width: 500px;" type="text" />\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td style="line-height: 22px;">\n\
                          Date <br />\n\
                          <input value="' + data[2] + '" readonly id="date" class="date-pick" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" />\n\
                          <img style="padding-top: 4px;" height="16" src="images/icon_course_date.jpg" alt="" />\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Time <br />\n\
                          <select id="time" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                            ' + times + '\n\
                          </select>\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Prefered gender <br />\n\
                          <select id="gender" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                            <option value=""></option>\n\
                            <option value="0">Male</option>\n\
                            <option value="1">Female</option>\n\
                          </select>\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Returning time <br />\n\
                          <select id="returning_time" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                            <option value=""></option>\n\
                            <option value="1 day">1 day</option>\n\
                            <option value="2 days">2 days</option>\n\
                            <option value="3 days">3 days</option>\n\
                            <option value="4 days">4 days</option>\n\
                            <option value="5 days">5 days</option>\n\
                            <option value="6 days">6 days</option>\n\
                            <option value="A week">A week</option>\n\
                            <option value="Two weeks">Two weeks</option>\n\
                            <option value="Three weeks">Three weeks</option>\n\
                            <option value="A month">A month</option>\n\
                            <option value="Three months">Three months</option>\n\
                          </select>\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td style="line-height: 22px;">\n\
                          Starting point <br />\n\
                          <select id="starting_state" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                            ' + us_states + '\n\
                          </select>\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Start city <br />\n\
                          <input id="start_city" value="' + data[7] + '" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" />\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Destination <br />\n\
                          <select id="destination_state" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                            ' + us_states + '\n\
                          </select>\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Destination city <br />\n\
                          <input id="destination_city" value="' + data[9] + '" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" />\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td colspan="4" style="padding-top: 10px;">\n\
                          <textarea id="content_carpool" style="border: 1px solid #D5D5D5; height: 120px; width: 600px;">' + data[10] + '</textarea>\n\
                        </td>\n\
                      </tr>\n\
                    </table>\n\
                    <input type="hidden" id="carpool_id" value="' + carpool_id + '" />\n\
                  </div>';

      var box = new studentjibe_box({
        width: 644,
        title: 'Update carpool',
        content: DATA,
        onsubmit: 'update_carpool',
        textSubmit: 'Update'
      });

      Date.firstDayOfWeek = 0;
      Date.format = 'dd.mm.yyyy';

      $('.date-pick').datepicker({ dateFormat: 'dd.mm.yy' });
      $('#time').selectOptions( data[3] );
      $('#gender').selectOptions( data[4] );
      $('#returning_time').selectOptions( data[5] );
      $('#starting_state').selectOptions( data[6] );
      $('#destination_state').selectOptions( data[8] );
    }
  });
}

function update_carpool() {
  var offer_type = $('#box_c_offer').attr('checked') == true ? 0 : 1;
  var subject = $('#subject').val();
  var date = $('#date').val();
  var time = $('#time').val();
  var gender = $('#gender').val();
  var returning_time = $('#returning_time').val();
  var starting_state = $('#starting_state').val();
  var start_city = $('#start_city').val();
  var destination_state = $('#destination_state').val();
  var destination_city = $('#destination_city').val();
  var content_carpool = $('#content_carpool').val();
  var carpool_id = $('#carpool_id').val();

  var error = false;
  if ( trim(subject) == '' ) {
    error = true;
    $('#subject').css('border', '1px solid red');
  } else {
    $('#subject').css('border', '1px solid #D5D5D5');
  }

  if ( trim(date) == '' ) {
    error = true;
    $('#date').css('border', '1px solid red');
  } else {
    $('#date').css('border', '1px solid #D5D5D5');
  }

  if ( trim(starting_state) == '' ) {
    error = true;
    $('#starting_state').css('border', '1px solid red');
  } else {
    $('#starting_state').css('border', '1px solid #D5D5D5');
  }

  if ( trim(start_city) == '' ) {
    error = true;
    $('#start_city').css('border', '1px solid red');
  } else {
    $('#start_city').css('border', '1px solid #D5D5D5');
  }

  if ( trim(destination_state) == '' ) {
    error = true;
    $('#destination_state').css('border', '1px solid red');
  } else {
    $('#destination_state').css('border', '1px solid #D5D5D5');
  }

  if ( trim(destination_city) == '' ) {
    error = true;
    $('#destination_city').css('border', '1px solid red');
  } else {
    $('#destination_city').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $.ajax({
      data: 'carpool_id=' + carpool_id + '&action=save&offer_type=' + offer_type + '&subject=' + subject + '&date=' + date + '&time=' + time + '&gender=' + gender + '&returning_time=' + returning_time + '&starting_state=' + starting_state + '&start_city=' + start_city + '&destination_state=' + destination_state + '&destination_city=' + destination_city + '&content_carpool=' + content_carpool,
      dataType: 'html',
      url: 'update_carpool',
      type: 'POST',
      success: function () {
        window.location = window.location;
      }
    });
  }
}

function search_carpool() {
  window.location = 'carpool?page=1&q=' + $('#q_carpool').val() + '&date_=' + $('#q_date_val').val() + '&stp=' + $('#q_starting_point').val() + '&stc=' + $('#q_starting_city').val() + '&t=' + $('#q_time').val() + '&enp=' + $('#q_ending_point').val() + '&enc=' + $('#q_ending_city').val() + '&q_type=' + type;
}

function add_bulletin_board() {
  var error = false;
  var new_content = $('#new_content').val();
  var new_department = $('#new_department').val();

  if ( new_content == '' ) {
    error = true;
    $('#new_content').css('border', '1px solid red');
  } else {
    $('#new_content').css('border', '1px solid #D5D5D5');
  }

  if ( new_department == '' ) {
    error = true;
    $('#new_department').css('border', '1px solid red');
  } else {
    $('#new_department').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $('#new_board').submit();
  }
}

function load_class_grade (course_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading grades...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });

  $.ajax({
    data: 'course_id=' + course_id + '&action=load_grade',
    dataType: 'html',
    url: 'grades_actions',
    type: 'POST',
    success: function (msg) {
      closeBox();
      
      var DATA = msg;

      var box = new studentjibe_box({
        width: 700,
        title: 'Grades info',
        content: DATA,
        onsubmit: 'save_grade_info',
        textSubmit: 'Save',
        textClose: 'Close'
      });
    }
  });
}

function calculate_grade() {
  var sum1 = new Array();
  var sum2 = new Array();

  sum1[1] = 0;sum1[2] = 0;sum1[3] = 0;sum1[4] = 0;sum1[5] = 0;sum1[6] = 0;
  sum2[1] = 0;sum2[2] = 0;sum2[3] = 0;sum2[4] = 0;sum2[5] = 0;sum2[6] = 0;

  for ( var i = 1; i <= 10; i++ ) {
    if ( $('#grades_div_id_' + i).css('display') == 'block' ) {
      for ( var j = 1; j <= 6; j++ ) {
        sum1[j] += parseInt( $('#input' + i + j + '1').val(), 10 );
        sum2[j] += parseInt( $('#input' + i + j + '2').val(), 10 );
      }
    }
  }

  var average1 = sum2[1] > 0 ? ( sum1[1] / sum2[1]).toFixed(2) * 100 : 0.00;
  var average2 = sum2[2] > 0 ? ( sum1[2] / sum2[2]).toFixed(2) * 100 : 0.00;
  var average3 = sum2[3] > 0 ? ( sum1[3] / sum2[3]).toFixed(2) * 100 : 0.00;
  var average4 = sum2[4] > 0 ? ( sum1[4] / sum2[4]).toFixed(2) * 100 : 0.00;
  var average5 = sum2[5] > 0 ? ( sum1[5] / sum2[5]).toFixed(2) * 100 : 0.00;
  var average6 = sum2[6] > 0 ? ( sum1[6] / sum2[6]).toFixed(2) * 100 : 0.00;

  $('#average1').html( average1.toFixed(2) );
  $('#average2').html( average2.toFixed(2) );
  $('#average3').html( average3.toFixed(2) );
  $('#average4').html( average4.toFixed(2) );
  $('#average5').html( average5.toFixed(2) );
  $('#average6').html( average6.toFixed(2) );

  var weight1 = parseInt($('#weight1').val(), 10);
  var weight2 = parseInt($('#weight2').val(), 10);
  var weight3 = parseInt($('#weight3').val(), 10);
  var weight4 = parseInt($('#weight4').val(), 10);
  var weight5 = parseInt($('#weight5').val(), 10);
  var weight6 = parseInt($('#weight6').val(), 10);
  
  // validate weights
  if ( weight1 > 100 ) { $('#weight1').val(100); weight1 = 100; }
  if ( weight2 > 100 ) { $('#weight2').val(100); weight2 = 100; }
  if ( weight3 > 100 ) { $('#weight3').val(100); weight3 = 100; }
  if ( weight4 > 100 ) { $('#weight4').val(100); weight4 = 100; }
  if ( weight5 > 100 ) { $('#weight5').val(100); weight5 = 100; }
  if ( weight6 > 100 ) { $('#weight6').val(100); weight6 = 100; }

  var total1 = ( average1 * weight1 ) / 100;
  var total2 = ( average2 * weight2 ) / 100;
  var total3 = ( average3 * weight3 ) / 100;
  var total4 = ( average4 * weight4 ) / 100;
  var total5 = ( average5 * weight5 ) / 100;
  var total6 = ( average6 * weight6 ) / 100;

  $('#total1').html( total1.toFixed(2) );
  $('#total2').html( total2.toFixed(2) );
  $('#total3').html( total3.toFixed(2) );
  $('#total4').html( total4.toFixed(2) );
  $('#total5').html( total5.toFixed(2) );
  $('#total6').html( total6.toFixed(2) );

  var final_grade = total1 + total2 + total3 + total4 + total5 + total6;

  $('#final_grade').html( final_grade.toFixed(2) );
}

function save_grade_info() {
  var sum1 = '';
  var sum2 = '';
  var weight = '';

  for ( var i = 1; i <= 10; i++ ) {
    if ( $('#grades_div_id_' + i).css('display') == 'block' ) {
      for ( var j = 1; j <= 6; j++ ) {
        sum1 += parseInt( $('#input' + i + j + '1').val(), 10 ) + ';';
        sum2 += parseInt( $('#input' + i + j + '2').val(), 10 ) + ';';
      }
    }
  }
  
  for ( i = 1; i <= 6; i++ ) {
    weight += $('#weight' + i).val() + ';';
  }

  $.ajax({
    data: 'course_id=' + $('#course_id').val() + '&action=save_grade&weight=' + weight + '&grades1=' + sum1 + '&grades2=' + sum2 + '&final_grade=' + $('#final_grade').html(),
    dataType: 'html',
    url: 'grades_actions',
    type: 'POST',
    success: function (msg) {
      closeBox();
      window.location = window.location;
    }
  });
}

function new_grade_row() {
  var c = 0;
  for ( var i = 1; i <= 10; i++ ) {
    if ( $('#grades_div_id_' + i).css('display') == 'block' ) {
      c++;
    }
  }

  c++;

  if ( c <= 10 ) {
    $('#grades_div_id_' + c).css('display',  'block');
  }

  if ( c > 9 ) {
    $('#new_grade_row_id').hide();
  }
}

function add_reminder_class(course_id) {
  var DATA = '<div>\n\
                <table>\n\
                  <tr>\n\
                    <td colspan="4" style="line-height: 22px;">\n\
                      Subject <br />\n\
                      <input id="subject_reminder" style="border: 1px solid #D5D5D5; height: 20px; width: 400px;" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td style="line-height: 22px;">\n\
                      Date <br />\n\
                      <input readonly id="date" class="date-pick" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" />\n\
                      <img style="padding-top: 4px;" height="16" src="images/icon_course_date.jpg" alt="" />\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Time <br />\n\
                      <select id="time" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                        ' + times + '\n\
                      </select>\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td colspan="4" style="padding-top: 10px;">\n\
                      <textarea id="content_carpool" style="border: 1px solid #D5D5D5; height: 120px; width: 400px;"></textarea>\n\
                      <input id="course_id" type="hidden" value="' + course_id + '" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td colspan="4" style="line-height: 22px;">\n\
                      Remember me <br />\n\
                      <select id="remember_reminder" style="border: 1px solid #D5D5D5; height: 22px; width: 130px;">\n\
                        <option value="0">Don\'t remind me</option>\n\
                        <option value="1">1 day before</option>\n\
                        <option value="2">2 days before</option>\n\
                        <option value="3">3 days before</option>\n\
                      </select>\n\
                    </td>\n\
                  </tr>\n\
                </table>\n\
              </div>';

  var box = new studentjibe_box({
    width: 440,
    title: 'Add new reminder',
    content: DATA,
    onsubmit: 'add_new_reminder'
  });

  Date.firstDayOfWeek = 0;
  Date.format = 'dd.mm.yyyy';

  $('.date-pick').datepicker({ dateFormat: 'dd.mm.yy' })
}

function add_new_reminder() {
  var course_id = $('#course_id').val();
  var date = $('#date').val();
  var time = $('#time').val();
  var content_myclass = $('#content_carpool').val();
  var subject = $('#subject_reminder').val();
  var remember = $('#remember_reminder').val();

  var error = false;
  if ( trim(subject) == '' ) {
    error = true;
    $('#subject_reminder').css('border', '1px solid red');
  } else {
    $('#subject_reminder').css('border', '1px solid #D5D5D5');
  }
  
  if ( trim(date) == '' ) {
    error = true;
    $('#date').css('border', '1px solid red');
  } else {
    $('#date').css('border', '1px solid #D5D5D5');
  }

  if ( trim(content_myclass) == '' ) {
    error = true;
    $('#content_carpool').css('border', '1px solid red');
  } else {
    $('#content_carpool').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $.ajax({
      data: 'action=add_new_reminder&course_id=' + course_id + '&date=' + date + '&time=' + time + '&content=' + content_myclass + '&subject=' + subject + '&remeber=' + remember,
      dataType: 'html',
      url: 'grades_actions',
      type: 'POST',
      success: function () {
        window.location = window.location;
      }
    });
  }
}

function edit_my_classes_remember(course_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading reminder...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'course_id=' + course_id + '&action=load_reminder',
    dataType: 'html',
    url: 'grades_actions',
    type: 'POST',
    success: function (msg) {
      var data = msg.split('/@#');

      closeBox();
      var DATA = '<div>\n\
                    <table>\n\
                      <tr>\n\
                        <td colspan="4" style="line-height: 22px;">\n\
                          Subject <br />\n\
                          <input id="subject_reminder" style="border: 1px solid #D5D5D5; height: 20px; width: 400px;" value="' + data[2] + '" />\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td style="line-height: 22px;">\n\
                          Date <br />\n\
                          <input readonly id="date" class="date-pick" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" value="' + data[1] + '" />\n\
                          <img style="padding-top: 4px;" height="16" src="images/icon_course_date.jpg" alt="" />\n\
                        </td>\n\
                        <td style="line-height: 22px;">\n\
                          Time <br />\n\
                          <select id="time" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                            ' + times + '\n\
                          </select>\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td colspan="4" style="padding-top: 10px;">\n\
                          <textarea id="content_carpool" style="border: 1px solid #D5D5D5; height: 120px; width: 400px;">' + data[0] + '</textarea>\n\
                          <input id="course_id" type="hidden" value="' + course_id + '" />\n\
                        </td>\n\
                      </tr>\n\
                      <tr>\n\
                        <td colspan="4" style="line-height: 22px;">\n\
                          Remember me <br />\n\
                          <select id="remember_reminder" style="border: 1px solid #D5D5D5; height: 22px; width: 130px;">\n\
                            <option value="0">Don\'t remind me</option>\n\
                            <option value="1">1 day before</option>\n\
                            <option value="2">2 days before</option>\n\
                            <option value="3">3 days before</option>\n\
                          </select>\n\
                        </td>\n\
                      </tr>\n\
                    </table>\n\
                  </div>';

      var box = new studentjibe_box({
        width: 440,
        title: 'Update reminder',
        content: DATA,
        onsubmit: 'add_new_reminder'
      });

      Date.firstDayOfWeek = 0;
      Date.format = 'dd.mm.yyyy';

      $('.date-pick').datepicker({ dateFormat: 'dd.mm.yy' });
      $('#time').selectOptions(data[3]);
      $('#remember_reminder').selectOptions(data[4]);
    }
  });
}

function getmap() {
  var map;
  var geocoder;
  var dest = new google.maps.LatLng(40.792133,-77.853931);
  var address = $('#ap_street').val()+', '+$('#ap_city').val()+', '+$('#ap_state').val()+' '+$('#ap_code').val();
  geocoder = new google.maps.Geocoder();
  var myOptions = {
    center: dest,
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("on_map"),
      myOptions);
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          animation: google.maps.Animation.DROP,
          position: results[0].geometry.location
      });
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });
}


function new_apartment() {
  var DATA = '<div>\n\
                <table>\n\
                  <tr>\n\
                    <td colspan="4" style="padding-bottom: 10px;">\n\
                      <input checked name="type" id="box_a_offer" type="radio" /> Sublet\n\
                      <input name="type" type="radio" /> Roommate\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td style="line-height: 22px; padding-bottom: 10px;" colspan="4">\n\
                      Property name <br />\n\
                      <input id="complex" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 500px;" type="text" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td style="line-height: 22px;">\n\
                      Street <br />\n\
                      <input id="ap_street" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" onchange="javascript: getmap();" />\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      City <br />\n\
                      <input id="ap_city" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" onchange="javascript: getmap();" />\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      State <br />\n\
                      <select id="ap_state" style="border: 1px solid #D5D5D5; height: 20px; width: 60px;" onchange="javascript: getmap();">\n\
                        '+states+
                      '</select>\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Zip code <br />\n\
                      <input id="ap_code" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 60px;" type="text" onchange="javascript: getmap();" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td style="line-height: 22px;">\n\
                      Distance from campus <br />\n\
                      <input id="distance" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 130px;" type="text" />\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Prefered gender <br />\n\
                      <select id="gender" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                        <option value="2">Either</option>\n\
                        <option value="0">Male</option>\n\
                        <option value="1">Female</option>\n\
                      </select>\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Bedrooms <br />\n\
                      <input id="bedrooms" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 60px;" type="text" />\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Bathrooms <br />\n\
                      <input id="bathrooms" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 60px;" type="text" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td style="line-height: 22px;">\n\
                      Furnished <br />\n\
                      <select id="furnished" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                        <option value="Not specified">Not specified</option>\n\
                        <option value="Yes">Yes</option>\n\
                        <option value="No">No</option>\n\
                      </select>\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Parking <br />\n\
                      <select id="parking" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                        <option value="Not specified">Not specified</option>\n\
                        <option value="Yes">Yes</option>\n\
                        <option value="No">No</option>\n\
                      </select>\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Utilities <br />\n\
                      <select id="utilities" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                        <option value="Not specified">Not specified</option>\n\
                        <option value="Included">Included</option>\n\
                        <option value="Not Included">Not Included</option>\n\
                      </select>\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Rent <br />\n\
                      $ <input id="price" value="0.00" style="border: 1px solid #D5D5D5; height: 18px; width: 80px; text-align: center; font-size: 14px; font-weight: bold;" type="text" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td colspan="2" style="padding-top: 10px;">\n\
                      <textarea id="content" style="border: 1px solid #D5D5D5; height: 100px; width: 300px;"></textarea>\n\
                    </td>\n\
                    <td colspan="2" style="padding-top: 10px;">\n\
                      <div id="on_map" style="height: 100px; width: 280px;"></div>\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td colspan="4" style="padding-top: 10px; line-height: 22px;">\n\
                      Upload images <span id="image_status"></span><br />\n\
                      <input type="file" id="fileToUpload" name="fileToUpload" onchange="javascript: upload_apartment_image();" />\n\
                      <div style="height: 10px;"><!-- --></div>\n\
                      <div id="uploaded_images" style="width: 600px;"></div>\n\
                    </td>\n\
                  </tr>\n\
                </table>\n\
              </div>';

  var box = new studentjibe_box({
    width: 642,
    title: 'Add new apartment',
    content: DATA,
    onsubmit: 'add_new_apartment',
    onCancel: 'remove_all_apt_images'
  });
}

function remove_all_apt_images() {
  $.ajax ({
    url: 'remove_apartment_images',
    dataType: 'html',
    type: 'POST',
    success: function (msg) {
    }
  });
}

function add_new_apartment() {
  var offer_type = $('#box_a_offer').attr('checked') == true ? 0 : 1;
  var street = $('#ap_street').val();
  var city = $('#ap_city').val();
  var state = $('#ap_state').val();
  var code = $('#ap_code').val();
  var distance = $('#distance').val();
  var gender = $('#gender').val();
  var bedrooms = parseInt( $('#bedrooms').val(), 10 );
  var bathrooms = parseInt( $('#bathrooms').val(), 10 );
  var furnished = $('#furnished').val();
  var parking = $('#parking').val();
  var utilities = $('#utilities').val();
  var price = parseFloat( $('#price').val(), 10 );
  var content = $('#content').val();
  var complex = $('#complex').val();
  var title = "title";

  var error = false;
  if ( trim(complex) == '' ) {
    error = true;
    $('#complex').css('border', '1px solid red');
  } else {
    $('#complex').css('border', '1px solid #D5D5D5');
  }
  
  if ( trim(street) == '' ) {
    error = true;
    $('#ap_street').css('border', '1px solid red');
  } else {
    $('#ap_street').css('border', '1px solid #D5D5D5');
  }
  
  if ( trim(city) == '' ) {
    error = true;
    $('#ap_city').css('border', '1px solid red');
  } else {
    $('#ap_city').css('border', '1px solid #D5D5D5');
  }

  if ( trim(code) == '' ) {
    error = true;
    $('#ap_code').css('border', '1px solid red');
  } else {
    $('#ap_code').css('border', '1px solid #D5D5D5');
  }

  if ( trim(distance) == '' ) {
    error = true;
    $('#distance').css('border', '1px solid red');
  } else {
    $('#distance').css('border', '1px solid #D5D5D5');
  }
  
  if ( price == 0 ) {
    error = true;
    $('#price').css('border', '1px solid red');
  } else {
    $('#price').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $.ajax({
      data: 'offer_type=' + offer_type + '&title=' + title + '&street=' + street + '&city=' + city + '&state=' + state + '&code=' + code + '&distance=' + distance + '&gender=' + gender + '&bedrooms=' + bedrooms + '&bathrooms=' + bathrooms + '&furnished=' + furnished + '&parking=' + parking + '&utilities=' + utilities + '&price=' + price + '&content=' + content + '&complex=' + complex,
      dataType: 'html',
      url: 'post_apartment',
      type: 'POST',
      success: function (msg) {
        if (msg == 'done') {
          window.location = window.location;
        } else if (msg == 'errin') {
          alert("error insert rows");
        } else {
          alert("unexpected error");
        }        
      }
    });
  }
}

function upload_apartment_image() {
  $('#image_status').html(' (Loading...):');

  $.ajaxFileUpload ({
    url: 'upload_apartment_image',
    secureuri: false,
    fileElementId: 'fileToUpload',
    dataType: 'json',
    success: function (data, status) {
      $('#image_status').empty();
      $('#fileToUpload').empty();

      var img_id = $('.rem_ap_im').length;
      $('#uploaded_images').append('<div id="img_' + img_id + '" class="rem_ap_im left" style="padding-left: 5px; font-size: 11px;">&raquo; ' + data.msg + ' <a class="standard_cancel_link" href="javascript: void(0);" onclick="javascript: remove_apartment_image(\'' + data.msg + '\', \'' + img_id + '\');">X</a></div>');
    },
    error: function (data, status, e) {
      alert(e);
    }
  });

  return false;
}

function remove_apartment_image(image, id) {
  $.ajax({
    data: 'image=' + image,
    dataType: 'html',
    url: 'remove_apartment_image',
    type: 'POST',
    success: function () {
      $('#img_' + id).fadeOut(500);
    }
  });
}

function load_apartment(apartment_id) {
  $('#apartment_map').css('display','none');
  $('#apartment_loader').css('display','block');
  $('#apartment_loader').html('<div align="center" style="padding-top: 100px; padding-bottom: 200px;"><img src="images/loader.gif" alt="Loading" title="Loading" /></div>');
  $.ajax({
    data: 'apartment_id=' + apartment_id,
    dataType: 'html',
    url: 'show_apartments',
    type: 'POST',
    success: function (msg) {
      $('#apartment_loader').html(msg);
      
    }
  });
}

function submit_apartment_comment(apartment_id) {
  var apartment_comment = $('#apartment_comment').val();

  if ( trim(apartment_comment) != '' ) {
    $.ajax({
      data: 'action=add&apartment_id=' + apartment_id + '&apartment_comment=' + apartment_comment,
      dataType: 'html',
      url: 'comment_apartment_actions',
      type: 'POST',
      success: function (msg) {
        load_apartment(apartment_id)
      }
    });
  }
}

function remove_apartment_comment(apartment_id, comment_id) {
  $.ajax({
    data: 'action=remove&apartment_id=' + apartment_id + '&comment_id=' + comment_id,
    dataType: 'html',
    url: 'comment_apartment_actions',
    type: 'POST',
    success: function (msg) {
      $('#apt_comment_id_' + comment_id).fadeOut(500);
    }
  });
}

function remove_apartment(apartment_id) {
  var DATA = 'Are you sure you want to remove this apartment? <input type="hidden" id="apartment_id" value="' + apartment_id + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove apartment?',
    content: DATA,
    onsubmit: 'remove_apartment_forever(); closeBox',
    textSubmit: 'Yes',
    textCancel: 'No'
  });
}

function remove_apartment_forever () {
  var apartment_id = $('#apartment_id').val();

  $.ajax({
    data: 'action=remove_apt&apartment_id=' + apartment_id,
    dataType: 'html',
    url: 'comment_apartment_actions',
    type: 'POST',
    success: function (msg) {
      window.location = window.location;
    }
  });
}

function load_apts (apts, page) {
  $('#apartment_map').css('display','block');
  $('#apartment_loader').css('display','none');
  $('#apartment_load_container .inner').html('<div align="center" style="padding-top: 100px; padding-bottom: 100px;"><img src="images/loader.gif" alt="Loading" title="Loading" /></div>');
  $('.site_apartments_right').css({'border':'none','border-top': '3px solid #DEDEDE'});
  $('#apt_type').val(apts);
  
  var x = $(".search_apartment_input").length ? $('.search_apartment_input').val() : '';

  $.ajax({
    data: 'action=no&type=' + apts + '&page=' + page + '&q=' + x,
    dataType: 'html',
    url: 'load_apartments',
    type: 'GET',
    success: function (msg) {
      $('#apartment_load_container .inner').html(msg);
    }
  });
}
function sort_apts (sort, page) {
  $('#apartment_map').css('display','block');
  $('#apartment_loader').css('display','none');
  $('#apartment_load_container .inner').html('<div align="center" style="padding-top: 100px; padding-bottom: 100px;"><img src="images/loader.gif" alt="Loading" title="Loading" /></div>');
  
  var apts = $('#apt_type').val();
  
  var x = $(".search_apartment_input").length ? $('.search_apartment_input').val() : '';

  $.ajax({
    data: 'action=no&sort='+sort+'&type=' + apts + '&page=' + page + '&q=' + x,
    dataType: 'html',
    url: 'sort_apartments',
    type: 'GET',
    success: function (msg) {
      $('#apartment_load_container .inner').html(msg);
    }
  });
}

function new_swap() {
  var DATA = '<div>\n\
                <form id="addme_carpool" action="" method="post" enctype="multipart/form-data">\n\
                <table>\n\
                  <tr>\n\
                    <td colspan="4" style="padding-bottom: 10px;">\n\
                      &rsaquo; Please keep in mind that your listing will be deleted after a period of 45 days \n\
                    </td>\n\
                  </tr>\n\
                  <input value="2" name="type" type="hidden" id="box_c_offer" />\n\
                  <!--\n\
                  <tr>\n\
                    <td colspan="4" style="padding-bottom: 10px;">\n\
                      I want to \n\
                      <input value="0" checked name="type" id="box_c_offer" type="radio" /> Swap\n\
                      <input value="1" name="type" id="box_c_offer2" type="radio" /> Share\n\
                      <input value="2" name="type" type="radio" /> Deal\n\
                    </td>\n\
                  </tr>\n\
                  -->\n\
                  <tr>\n\
                    <td style="line-height: 22px; padding-bottom: 10px;" colspan="4">\n\
                      Title <br />\n\
                      <input name="subject" id="subject" value="" style="border: 1px solid #D5D5D5; height: 18px; width: 500px;" type="text" />\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td style="line-height: 22px;">\n\
                      Image <br />\n\
                      <input type="file" name="image" />\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Category <br />\n\
                      <select id="category" name="category" style="border: 1px solid #D5D5D5; height: 20px; width: 130px;">\n\
                        ' + categories + '\n\
                      </select>\n\
                    </td>\n\
                    <td style="line-height: 22px;">\n\
                      Price <br />\n\
                      <input name="price" id="price" value="0.00" style="border: 1px solid #D5D5D5; height: 18px; width: 100px; font-weight: bold; text-align: center; font-size: 16px;" type="text" />\n\
                    </td>\n\
                    <td style="line-height: 22px;"></td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td colspan="4" style="padding-top: 10px;">\n\
                      <textarea id="content_swap" name="content_swap" style="border: 1px solid #D5D5D5; height: 120px; width: 600px;"></textarea>\n\
                    </td>\n\
                  </tr>\n\
                </table>\n\
                <input type="hidden" name="new_swap" value="new_swap" />\n\
                </form>\n\
              </div>';

  var box = new studentjibe_box({
    width: 640,
    title: 'Add new sell',
    content: DATA,
    onsubmit: 'add_new_swap'
  });
}

function add_new_swap() {
  //var offer_type = $('#box_c_offer').attr('checked') == true ? 0 : ( $('#box_c_offer').attr('checked') == true ? 1 : 2 );
  var offer_type = $('#box_c_offer').val();
  var subject = $('#subject').val();
  var category = $('#category').val();
  var content_swap = $('#content_swap').val();

  var error = false;
  if ( trim(subject) == '' ) {
    error = true;
    $('#subject').css('border', '1px solid red');
  } else {
    $('#subject').css('border', '1px solid #D5D5D5');
  }

  if ( trim(category) == '' ) {
    error = true;
    $('#category').css('border', '1px solid red');
  } else {
    $('#category').css('border', '1px solid #D5D5D5');
  }

  if ( trim(content_swap) == '' ) {
    error = true;
    $('#content_swap').css('border', '1px solid red');
  } else {
    $('#content_swap').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $('#addme_carpool').submit();
  }
}

function remove_swap(swap_id, page) {
  var DATA = 'Are you sure you want to remove this item? <input type="hidden" id="swap_id" value="' + swap_id + '" /> <input type="hidden" id="page_id" value="' + page + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove item?',
    content: DATA,
    onsubmit: 'remove_swap_now',
    textCancel: 'No',
    textSubmit: 'Yes'
  });
}

function remove_swap_now() {
  var swap_id = $('#swap_id').val();
  swap_id = parseInt(swap_id, 10);
  //var page = $('#page_id').val();

  if ( swap_id > 0 ) {
    window.location = window.location + '&action=delete&rsvp=yes&swap_id=' + swap_id;
  }
}

function new_professor() {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 60px; font-weight: bold;">You can tie add a new professor using your \'My classes\' section of your profile. <a class="standard_cancel_link" style="font-weight: bold;" href="' + SITE_URL + 'edit_profile_2">Go there now.</a></div>';

  var box = new studentjibe_box({
    width: 580,
    title: 'Add new professor',
    content: DATA,
    showSubmit: false,
    textCancel: 'Close'
  });
}

function choose_grade(number, identify) {
  $('.grade_' + number).css({'color' : '#0863B6', 'background' : 'white'});
  $('#gr_' + number + '_' + identify).css({'color' : 'white', 'background' : '#0863B6'});

  $('#my_grade_' + number).val(identify);
}

function get_courses() {
  var DATA = '';
  
  for ( var i in selected_courses ) {
    DATA += '<option value="' + selected_courses[i][0] + '">' + selected_courses[i][1] +'</option>';
  }
  
  return DATA;
}

function grade_professor(professor_id) {  
   
  var DATA ='<script type="text/javascript">\n\
              $(document).ready(function() {\n\
                $("#sliderPers").slider({ value: '+ myPers +', animate: true, range: "min", step: 10, change : function(event, ui){\n\
                                               $("#absSliderPers").css("display","block").html( parseInt( $(this).slider("option", "value") / 10) + "<img id=\'jessus\' src=\'images/emoticons/smile_"+ parseInt( $(this).slider("option", "value") / 10) +".png\'/>" );}  });\n\
                $("#sliderDiff").slider({ value: '+ myDiff +', animate: true, range: "min", step: 10, change : function(event, ui){\n\
                                               $("#absSliderDiff").css("display","block").html( parseInt( $(this).slider("option", "value") / 10) + "<img id=\'jessus\' src=\'images/emoticons/smile_"+ parseInt( $(this).slider("option", "value") / 10) +".png\'/>" );}  });\n\
                $("#sliderClar").slider({ value: '+ myClar +', animate: true, range: "min", step: 10, change : function(event, ui){\n\
                                               $("#absSliderClar").css("display","block").html( parseInt( $(this).slider("option", "value") / 10) + "<img id=\'jessus\' src=\'images/emoticons/smile_"+ parseInt( $(this).slider("option", "value") / 10) +".png\'/>" );}  });\n\
                $("#sliderAtte").slider({ value: '+ myAtte +', animate: true, range: "min", step: 10, change : function(event, ui){\n\
                                               $("#absSliderAtte").css("display","block").html( parseInt( $(this).slider("option", "value") / 10) + "<img id=\'jessus\' src=\'images/emoticons/smile_"+ parseInt( $(this).slider("option", "value") / 10) +".png\'/>" );}  });\n\
                $("#sliderHelp").slider({ value: '+ myHelp +', animate: true, range: "min", step: 10, change : function(event, ui){\n\
                                               $("#absSliderHelp").css("display","block").html( parseInt( $(this).slider("option", "value") / 10) + "<img id=\'jessus\' src=\'images/emoticons/smile_"+ parseInt( $(this).slider("option", "value") / 10) +".png\'/>" );}  });\n\
              });\n\
            </script>';
  
  if ( typeof( course_name ) != undefined && typeof( course_id ) != undefined ) {
    DATA += '\n\
              <div class="select_a_course">\n\
                <div class="select_a_course_title">Course</div>\n\
                <div class="select_a_course_input">\n\
                  <div class="select_a_course_input2" >' + course_name + '</div>\n\
                  <input id="course_id_val" type="hidden" value="' + course_id + '" />\n\
                </div>\n\
                <div class="clear"></div>\n\
              </div>';
  } else if ( typeof( selected_courses ) != undefined ) {
    DATA += '\n\
              <div class="select_a_course">\n\
                <div class="select_a_course_title">Course</div>\n\
                <div class="select_a_course_input">\n\
                  <select id="course_id_val">\n\
                    <option value="0">Select a course</option>\n\
                    ' + get_courses() + '\n\
                  </select>\n\
                </div>\n\
                <div class="clear"></div>\n\
              </div>';
  }  
  
    DATA += '\n\
              <div class="overall_rating">\n\
                <div class="overall_rating_title">Overall rating for ' + professor_name + '</div> \n\
                <div class="overall_rating_like"><a class="ld_1" id="ld_1_1" onclick="javascript: choose_like_dislike(1, 1);" href="javascript: void(0);" style="background: url(images/like_prof_inv.png) no-repeat;">Like</a></div>\n\
                <div class="overall_rating_like"><a class="ld_1" id="ld_1_2" onclick="javascript: choose_like_dislike(1, 2);" href="javascript: void(0);" style="background: url(images/unlike_prof_inv.png) no-repeat;">Dislike</a></div>';
  if ( already_graded != false ) { 
    DATA +=    '<div class="overall_rating_like" id="delete_grade"><a onclick="javascript: delete_professor_grade('+ already_graded +');" href="javascript: void(0);" style="padding-left: 5px; font-weight: bold; background-color: red; color: #fff;">Delete your grade</a></div>';
  }
    DATA +=    '<div class="clear"></div>\n\
                <input type="hidden" id="my_like_dislike_1" value="0" />\n\
                <div class="clear"></div>\n\
              </div>\n\
              <div class="select_a_course">\n\
                <table style="width: 580px;" >\n\
                  <tr>\n\
                    <td colspan="5">\n\
                      <span id="prof_grade_error"></span>\n\
                    </td>\n\
                  </tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Personality\n\
                    </td>\n\
                    <td>\n\
                      <div style="padding: 5px;">\n\
                        <div id="sliderPers"></div>\n\
                        <div id="absSliderPers" class="absSlider"></div>\n\
                      </div>\n\
                    </td>\n\
                  <td></td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_1" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Difficulty\n\
                    </td>\n\
                    <td>\n\
                      <div style="padding: 5px;">\n\
                        <div id="sliderDiff"></div>\n\
                        <div id="absSliderDiff" class="absSlider"></div>\n\
                      </div>\n\
                    </td>\n\
                    <td></td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_2" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Clarity\n\
                    </td>\n\
                    <td>\n\
                      <div style="padding: 5px;">\n\
                        <div id="sliderClar"></div>\n\
                        <div id="absSliderClar" class="absSlider"></div>\n\
                      </div>\n\
                    </td>\n\
                    <td></td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_3" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Attendance\n\
                    </td>\n\
                    <td>\n\
                      <div style="padding: 5px;">\n\
                        <div id="sliderAtte"></div>\n\
                        <div id="absSliderAtte" class="absSlider"></div>\n\
                      </div>\n\
                    </td>\n\
                    <td></td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_4" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Helpfulness\n\
                    </td>\n\
                    <td>\n\
                      <div style="padding: 5px;">\n\
                        <div id="sliderHelp"></div>\n\
                        <div id="absSliderHelp" class="absSlider"></div>\n\
                      </div>\n\
                    </td>\n\
                    <td></td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_5" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                </table>\n\
              </div>\n\
              <div>\n\
                <table style="width: auto;">\n\
                  <tr>\n\
                    <td colspan="5" style="font-weight: bold; line-height: 22px;">\n\
                      Write a comment <br />\n\
                      <textarea id="comment" style="border: 1px solid #D5D5D5; height: 80px; width: 660px; padding: 5px;">'+ myComment +'</textarea>\n\
                    </td>\n\
                  </tr>\n\
                  <input type="hidden" id="professor_id" value="' + professor_id + '" />\n\
                </table>\n\
              </div>';

  var box = new studentjibe_box({
    width: 708,
    title: 'Grade professor',
    content: DATA,
    onsubmit: 'add_new_professor_grade'
  });
}

function clearSliderPers(){
  $('#comment').val('');
  $( "#sliderPers" ).slider( "option", "value", 0 );
}
function clearSliderDiff(){
  $( "#sliderDiff" ).slider( "option", "value", 0 );
}
function clearSliderAtte(){
  $( "#sliderAtte" ).slider( "option", "value", 0 );
}
function clearSliderHelp(){
  $( "#sliderHelp" ).slider( "option", "value", 0 );
}
function clearSliderClar(){
  $( "#sliderClar" ).slider( "option", "value", 0 );
}
function backToProfRate() {
  window.location = window.location;
}

function delete_professor_grade(row_id) {
  $.ajax({
    data: 'row_id=' + row_id,
    dataType: 'html',
    url: 'delete_professor_grade',
    type: 'POST',
    success: function (msg) {
      if (msg == 'done') {
        //$('#prof_grade_error').css({'color' : 'green', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Your grade was deleted');
        $('#delete_grade').fadeOut(1000);
        
        setTimeout("clearSliderPers()", 500);
        setTimeout("clearSliderDiff()", 600);
        setTimeout("clearSliderClar()", 700);
        setTimeout("clearSliderAtte()", 800);
        setTimeout("clearSliderHelp()", 900);          
          
        setTimeout("backToProfRate()", 1500);
                  
      } else {
        $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Error delete grade');
      }
    }
  });
}
  

function add_new_professor_grade() {   
  var comment = $('#comment').val();
  var my_grade_5 = $( "#sliderHelp" ).slider( "option", "value" );
  var my_grade_4 = $( "#sliderAtte" ).slider( "option", "value" );
  var my_grade_3 = $( "#sliderClar" ).slider( "option", "value" );
  var my_grade_2 = $( "#sliderDiff" ).slider( "option", "value" );
  var my_grade_1 = $( "#sliderPers" ).slider( "option", "value" );
    //alert (my_grade_1 + ',  ' + my_grade_2 + ',  ' + my_grade_3 + ',  ' + my_grade_4);
  var selected_course = $("#course_id_val").val();
  var like_dislike = parseInt( $('#my_like_dislike_1').val(), 10 );
  var professor_id = $("#professor_id").val();
  
    
  var error = false;
//  if ( trim(comment) == '' ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please add your comment');
//  }
    
//  if ( my_grade_5 == 0 ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the professor on his helpfulness');
//  }
//
//  if ( my_grade_4 == 0 ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the professor on his attendance');
//  }
//
//  if ( my_grade_3 == 0 ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the professor on his clarity');
//  }
//
//  if ( my_grade_2 == 0 ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the professor on his difficulty');
//  }
//
//  if ( my_grade_1 == 0 ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the professor on his personality');
//  }

//  if ( like_dislike == 0 ) {
//    error = true;
//    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please select if you like or not this professor');
//  }

  if ( selected_course == '0' ) {
    error = true;
    $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please select a course for professor');
  }
      
  if ( !error ) {
    $('#prof_grade_error').empty();

    $.ajax({
      data: 'professor_id=' + professor_id + '&my_grade_1=' + my_grade_1 + '&my_grade_2=' + my_grade_2 + '&my_grade_3=' + my_grade_3 + '&my_grade_4=' + my_grade_4 + '&my_grade_5=' + my_grade_5 + '&comment=' + comment + '&like_dislike=' + like_dislike + '&selected_course=' + selected_course,
      dataType: 'html',
      url: 'grade_professor',
      type: 'POST',
      success: function (msg) {
        if (msg == 'errval') {
          $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Unexpected error: value error (no course, no professor or slide error)');
        } else if ( msg == 'notallow' ) {
          $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; You can not grade this professor');
        } else if ( msg == 'added' ) {
          $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; You have already graded this professor for this course');
        } else if ( msg == 'errin' ) {
          $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; MySql error: insert > professors_grades');
        } else if ( msg == 'errup' ) {
          $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; MySql error: update > professors');  
        } else { //if ( msg == 'done' ) {
          window.location = window.location;
        }// else {
//          $('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; ' + msg);
//          //$('#prof_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Unexpected error: possibly no course or professor selected');
//        }
      }
    });
  }
}


function choose_course_grade(number, identify) {
  $('.grade_' + number).css({'color' : '#0863B6', 'background' : 'white'});
  $('#gr_' + number + '_' + identify).css({'color' : 'white', 'background' : '#0863B6'});

  $('#my_grade_' + number).val(identify);
}

function choose_like_dislike(number, identify) {
  $('.ld_' + number).css({'color' : '#0863B6', 'background-color' : 'white'});
  $('#ld_' + number + '_' + identify).css({'color' : 'white', 'background-color' : '#0863B6'});

  $('#my_overall_grade').val(identify);
  $('#my_like_dislike_1').val(identify);
}

function grade_course(course_id) {    
  var DATA = '\n\
                <div class="select_a_course">\n\
                  <div class="select_a_course_title">Course</div>\n\
                  <div class="select_a_course_input">\n\
                    <div class="select_a_course_input2" >' + course_name + '</div>\n\
                    <input id="course_id_val" type="hidden" value="' + course_id + '" />\n\
                  </div>\n\
                  <div class="clear"></div>\n\
                </div>\n\
                <div>\n\
                <div class="overall_rating">\n\
                  <div class="overall_rating_title">Overall rating for course</div> \n\
                  <div class="overall_rating_like"><a class="ld_1" id="ld_1_1" onclick="javascript: choose_like_dislike(1, 1);" href="javascript: void(0);" style="padding: 5px 0; text-align: center; width: 60px; font-size: 12px;">Easy</a></div>\n\
                  <div class="overall_rating_like"><a class="ld_1" id="ld_1_2" onclick="javascript: choose_like_dislike(1, 2);" href="javascript: void(0);" style="padding: 5px 0; text-align: center; width: 60px; font-size: 12px;">Fair</a></div>\n\
                  <div class="overall_rating_like"><a class="ld_1" id="ld_1_3" onclick="javascript: choose_like_dislike(1, 3);" href="javascript: void(0);" style="padding: 5px 0; text-align: center; width: 60px; font-size: 12px;">Hard</a></div>';
  if ( already_graded != false ) { 
      DATA +=    '<div class="overall_rating_like" id="delete_course_grade"><a onclick="javascript: delete_course_grade('+ already_graded +');" href="javascript: void(0);" style="padding-left: 5px; font-weight: bold; background-color: red; color: #fff;">Delete your grade</a></div>';      
  }
      DATA +=    '<div class="clear"></div>\n\
                  <input type="hidden" id="my_overall_grade" value="0" />\n\
                </div>\n\
                <table>\n\
                  <tr>\n\
                    <td colspan="5">\n\
                      <span id="course_grade_error"></span>\n\
                    </td>\n\
                  </tr>\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Homework\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_2_1" class="grade_2" onclick="javascript: choose_course_grade(2, 1);" href="javascript: void(0);">Easy</a>\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_2_2" class="grade_2" onclick="javascript: choose_course_grade(2, 2);" href="javascript: void(0);">Neutral</a>\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_2_3" class="grade_2" onclick="javascript: choose_course_grade(2, 3);" href="javascript: void(0);">Hard</a>\n\
                    </td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_2" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Exam\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_3_1" class="grade_3" onclick="javascript: choose_course_grade(3, 1);" href="javascript: void(0);">Easy</a>\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_3_2" class="grade_3" onclick="javascript: choose_course_grade(3, 2);" href="javascript: void(0);">Neutral</a>\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_3_3" class="grade_3" onclick="javascript: choose_course_grade(3, 3);" href="javascript: void(0);">Hard</a>\n\
                    </td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_3" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td width="150" style="font-weight: bold; padding-left: 50px;">\n\
                      Quiz\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_4_1" class="grade_4" onclick="javascript: choose_course_grade(4, 1);" href="javascript: void(0);">Easy</a>\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_4_2" class="grade_4" onclick="javascript: choose_course_grade(4, 2);" href="javascript: void(0);">Neutral</a>\n\
                    </td>\n\
                    <td>\n\
                      <a id="gr_4_3" class="grade_4" onclick="javascript: choose_course_grade(4, 3);" href="javascript: void(0);">Hard</a>\n\
                    </td>\n\
                  </tr>\n\
                  <input type="hidden" id="my_grade_4" value="0" />\n\
                  <tr><td style="height: 10px;"></td></tr>\n\
                  <tr>\n\
                    <td colspan="5" style="font-weight: bold; line-height: 22px;">\n\
                      Write a comment <br />\n\
                      <textarea id="comment" style="border: 1px solid #D5D5D5; height: 60px; width: 660px;"></textarea>\n\
                    </td>\n\
                  </tr>\n\
                  <input type="hidden" id="course_id" value="' + course_id + '" />\n\
                </table>\n\
              </div>';

  var box = new studentjibe_box({
    width: 700,
    title: 'Grade course',
    content: DATA,
    onsubmit: 'add_new_course_grade'
  });
}

function backToCourseRate() {
  window.location = window.location;
}

function delete_course_grade(row_id) {
  $.ajax({
    data: 'row_id=' + row_id,
    dataType: 'html',
    url: 'delete_course_grade',
    type: 'POST',
    success: function (msg) {
      if (msg == 'done') {
        $('#course_grade_error').css({'color' : 'green', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Your grade was deleted');
        $('#delete_course_grade').fadeOut(1000);
        
        setTimeout("backToCourseRate()", 1500);
                  
      } else {
        $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Error delete grade');
      }
    }
  });
} 

function add_new_course_grade() {
  var comment = $('#comment').val();
  var my_overall_grade = parseInt( $('#my_overall_grade').val(), 10 );
  var my_grade_4 = parseInt( $('#my_grade_4').val(), 10 );
  var my_grade_3 = parseInt( $('#my_grade_3').val(), 10 );
  var my_grade_2 = parseInt( $('#my_grade_2').val(), 10 );
  var my_grade_1 = parseInt( $('#my_grade_1').val(), 10 );

  var error = false;
//  if ( trim(comment) == '' ) {
//    error = true;
//    $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please add your comment');
//  }
  
  if ( my_overall_grade == 0 || my_overall_grade > 3 ) {
    error = true;
    $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please select overall grade for the course');
  }

//  if ( my_grade_4 == 0 || my_grade_4 > 4 ) {
//    error = true;
//    $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the course on it\'s quiz');
//  }
//
//  if ( my_grade_3 == 0 || my_grade_3 > 4 ) {
//    error = true;
//    $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the course on it\'s exam');
//  }
//
//  if ( my_grade_2 == 0 || my_grade_2 > 4 ) {
//    error = true;
//    $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the course on it\'s homework');
//  }

//  if ( my_grade_1 == 0 || my_grade_1 > 9 ) {
//    error = true;
//    $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Please grade the course');
//  }

  if ( !error ) {
    $('#course_grade_error').empty();

    $.ajax({
      data: 'course_id=' + $('#course_id').val() + '&my_grade_1=' + my_grade_1 + '&my_grade_2=' + my_grade_2 + '&my_grade_3=' + my_grade_3 + '&my_grade_4=' + my_grade_4 + '&my_overall_grade=' + my_overall_grade + '&comment=' + comment,
      dataType: 'html',
      url: 'grade_course',
      type: 'POST',
      success: function (msg) {
        if ( msg == 'added' ) {
          $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; You have already voted for this course');
        } else if ( msg == 'errin' ) {
          $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; MySql Error: error insert rows');
        } else if ( msg == 'error' ) {
          $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Unexpected Error: new_grade_course > error');
        } else if ( msg == 'done' ) {
          window.location = window.location;
        } else {
          $('#course_grade_error').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; Unexpected Error');          
        }
      }
    });
  }
}

function recommend_course(id) {
  $.ajax({
    type: "POST",
    url: "recommend_course",
    data: "id="+id
  }).done(function( msg ) {
    if ( msg == 'no' ) {
      var DATA = '<div style="font-size: 11px;">You must attend this course in order to be able to recommend it</div>';
      var box = new studentjibe_box({
        width: 450,
        title: 'Can\'t recommend course!',
        content: DATA,
        showSubmit: false,
        textCancel: 'Close'
      });
    } else {
      window.location = window.location;
    }
  });
}

function dont_grade_professor() {
  var DATA = '<div style="font-size: 11px;">You must attend a course with this professor in order to be able to rate him</div>';

  var box = new studentjibe_box({
    width: 450,
    title: 'Can\'t grade professor.. yet!',
    content: DATA,
    showSubmit: false,
    textCancel: 'Close'
  });
}

function view_all_comment_likes(comment_id, comment_type) {
  var DATA = '<div>\n\
                <div style="text-align: center; font-size: 11px; line-height: 80px;">Loading...</div>\n\
              </div>';
  
  var box = new studentjibe_box({
            width: 420,
            title: 'Comment likes',
            content: DATA,
            showSubmit: false,
            showCancel: true,
            textCancel: 'Close'
          });

  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: 'comment_like_users',
    data: 'comment_type=' + comment_type + '&comment_id=' + comment_id,
    success: function (msg) {
      $('.box_container').html(msg);
    }
  });
}

function like_unlike_comment(_obj, comment_id, nrs, comment_type) {
  nrs = parseInt(nrs, 10);
  var persons = '';
  
  if ( $(_obj).html() == 'Unlike' ) {
    nrs--;
    
    if ( nrs > 1 ) {
      persons = nrs + ' persons like this';
    } else {
      if ( nrs == 1 ) {
        persons = '1 person likes this';
      } else {
        persons = 'Nobody likes this';
      }
    }
    
    $('#likeunlike_' + comment_id).html(persons);
    
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'comment_likeunlike_users',
      data: 'comment_type=' + comment_type + '&comment_id=' + comment_id
    });
    
    $(_obj).html('Like');
  } else {
    nrs++;
    if ( nrs > 1 ) {
      persons = nrs + ' persons like this';
    } else {
      if ( nrs == 1 ) {
        persons = '1 person likes this';
      }
    }
    
    $('#likeunlike_' + comment_id).html(persons);
    
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'comment_likeunlike_users',
      data: 'comment_type=' + comment_type + '&comment_id=' + comment_id
    });
    
    $(_obj).html('Unlike');
  }
}

function like_unlike_comment_carpool(_obj, comment_id, nrs, comment_type) {
  nrs = parseInt(nrs, 10);
  var persons = '';
  
  if ( $(_obj).html() == 'Unlike' ) {
    nrs--;
    
    if ( nrs > 1 ) {
      persons = nrs + ' persons like this';
    } else {
      if ( nrs == 1 ) {
        persons = '1 person likes this';
      } else {
        persons = 'Nobody likes this';
      }
    }
    
    $('#likeunlike_' + comment_id).html(persons);
    
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'comment_likeunlike_users_carpool',
      data: 'comment_type=' + comment_type + '&comment_id=' + comment_id
    });
    
    $(_obj).html('Like');
  } else {
    nrs++;
    if ( nrs > 1 ) {
      persons = nrs + ' persons like this';
    } else {
      if ( nrs == 1 ) {
        persons = '1 person likes this';
      }
    }
    
    $('#likeunlike_' + comment_id).html(persons);
    
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: 'comment_likeunlike_users_carpool',
      data: 'comment_type=' + comment_type + '&comment_id=' + comment_id
    });
    
    $(_obj).html('Unlike');
  }
}

function remove_my_classes_remember(id) {
  var DATA = 'Are you sure you want to remove this reminder? <input type="hidden" id="reminder_id" value="' + id + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove class?',
    content: DATA,
    onsubmit: 'remove_remember_my_classes',
    textSubmit: 'Yes',
    textCancel: 'No'
  });
}

function remove_remember_my_classes() {
  window.location = 'my_classes?action=remove&remember=' + $('#reminder_id').val();
}

function edit_apartment(apartment_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading apartment...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'apartment_id=' + apartment_id + '&action=load',
    dataType: 'html',
    url: 'update_apartment',
    type: 'POST',
    success: function (msg) {
      closeBox();

      var DATA = msg;

      var box = new studentjibe_box({
        width: 644,
        title: 'Update apartment',
        content: DATA,
        onsubmit: 'apply_update_carpool',
        textSubmit: 'Update'
      });
    }
  });
}

function apply_update_carpool() {
  var apartment_id = $('#apartment_id').val();
  var offer_type = $('#box_a_offer').attr('checked') == true ? 0 : 1;
  var title = $('#title').val();
  var distance = $('#distance').val();
  var gender = $('#gender').val();
  var bedrooms = parseInt( $('#bedrooms').val(), 10 );
  var bathrooms = parseInt( $('#bathrooms').val(), 10 );
  var furnished = $('#furnished').val();
  var parking = $('#parking').val();
  var utilities = $('#utilities').val();
  var price = parseFloat( $('#price').val(), 10 );
  var content = $('#content').val();
  var complex = $('#complex').val();

  var error = false;
  if ( trim(title) == '' ) {
    error = true;
    $('#title').css('border', '1px solid red');
  } else {
    $('#title').css('border', '1px solid #D5D5D5');
  }

  if ( trim(distance) == '' ) {
    error = true;
    $('#distance').css('border', '1px solid red');
  } else {
    $('#distance').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $.ajax({
      data: 'action=update&apartment_id=' + apartment_id + '&offer_type=' + offer_type + '&title=' + title + '&distance=' + distance + '&gender=' + gender + '&bedrooms=' + bedrooms + '&bathrooms=' + bathrooms + '&furnished=' + furnished + '&parking=' + parking + '&utilities=' + utilities + '&price=' + price + '&content=' + content + '&complex=' + complex,
      dataType: 'html',
      url: 'update_apartment',
      type: 'POST',
      success: function () {
        window.location = window.location;
      }
    });
  }
}

function view_carpool(carpool_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading entry...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'carpool_id=' + carpool_id + '&action=view',
    dataType: 'html',
    url: 'view_carpool',
    type: 'POST',
    success: function (msg) {
      closeBox();

      var DATA = msg;

      var box = new studentjibe_box({
        width: 644,
        height: 500,
        title: 'View Carpool',
        content: DATA,
        showSubmit: false,
        textCancel: 'Close'
      });
    }
  });
}

function submit_carpool_comment() {
  var message = $('#comment_text').val();
  var carpool_id = $('#carpool_id').val();
  
  if ( trim(message) != '' ) {
    $('#comment_message').html('Adding...');
    $.ajax({
      data: 'carpool_id=' + carpool_id + '&message=' + message + '&action=add_comment',
      dataType: 'html',
      url: 'view_carpool',
      type: 'POST',
      success: function (msg) {
        closeBox();
        
        view_carpool(carpool_id);
      }
    });
  }
}

function view_swap(swap_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading entry...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'swap_id=' + swap_id + '&action=view',
    dataType: 'html',
    url: 'view_swap',
    type: 'POST',
    success: function (msg) {
      closeBox();

      var DATA = msg;

      var box = new studentjibe_box({
        width: 644,
        height: 500,
        title: 'View Sell',
        content: DATA,
        showSubmit: false,
        textCancel: 'Close'
      });
    }
  });
}

function submit_swap_comment() {
  var message = $('#comment_text').val();
  var swap_id = $('#swap_id').val();
  
  if ( trim(message) != '' ) {
    $('#comment_message').html('Adding...');
    $.ajax({
      data: 'swap_id=' + swap_id + '&message=' + message + '&action=add_comment',
      dataType: 'html',
      url: 'view_swap',
      type: 'POST',
      success: function (msg) {
        closeBox();
        
        view_swap(swap_id);
      }
    });
  }
}

function edit_swap(swap_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading entry...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'swap_id=' + swap_id + '&action=view',
    dataType: 'html',
    url: 'edit_swap',
    type: 'POST',
    success: function (msg) {
      closeBox();

      var DATA = msg;

      var box = new studentjibe_box({
        width: 640,
        title: 'Edit Sell',
        content: DATA,
        showSubmit: true,
        textCancel: 'Cancel',
        textSubmit: 'Save',
        onsubmit: 'update_swap'
      });
    }
  });
}

function update_swap() {
  var offer_type = $('#box_c_offer').val();
  var subject = $('#subject').val();
  var category = $('#category').val();
  var content_swap = $('#content_swap').val();

  var error = false;
  if ( trim(subject) == '' ) {
    error = true;
    $('#subject').css('border', '1px solid red');
  } else {
    $('#subject').css('border', '1px solid #D5D5D5');
  }

  if ( trim(category) == '' ) {
    error = true;
    $('#category').css('border', '1px solid red');
  } else {
    $('#category').css('border', '1px solid #D5D5D5');
  }

  if ( trim(content_swap) == '' ) {
    error = true;
    $('#content_swap').css('border', '1px solid red');
  } else {
    $('#content_swap').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $('#addme_carpool').submit();
  }
}

function edit_bulletin_board(bb_id) {
  var DATA = '<div style="font-size: 11px; text-align: center; line-height: 30px;">Loading...</div>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Loading entry...',
    content: DATA,
    showCancel: false,
    showSubmit: false
  });
  
  $.ajax({
    data: 'bb_id=' + bb_id + '&action=view',
    dataType: 'html',
    url: 'edit_bb',
    type: 'POST',
    success: function (msg) {
      closeBox();

      var DATA = msg;

      var box = new studentjibe_box({
        width: 403,
        title: 'Edit Bulletin Board',
        content: DATA,
        showSubmit: true,
        textCancel: 'Cancel',
        textSubmit: 'Save',
        onsubmit: 'update_bb'
      });
    }
  });
}

function update_bb() {
  var error = false;
  var new_content = $('#new_content').val();
  var new_department = $('#new_department').val();

  if ( new_content == '' ) {
    error = true;
    $('#new_content').css('border', '1px solid red');
  } else {
    $('#new_content').css('border', '1px solid #D5D5D5');
  }

  if ( new_department == '' ) {
    error = true;
    $('#new_department').css('border', '1px solid red');
  } else {
    $('#new_department').css('border', '1px solid #D5D5D5');
  }

  if ( !error ) {
    $('#new_board').submit();
  }
}

function remove_bb(bb_id) {
  var DATA = 'Are you sure you want to remove this bulletin board? <form action="" method="POST" id="del_bb"><input type="hidden" name="bb_id" value="' + bb_id + '" /> <input type="hidden" name="remove_bb" value="remove" /></form>';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove class?',
    content: DATA,
    onsubmit: 'remove_bb_final',
    textSubmit: 'Delete'
  });
}

function remove_bb_final() {
  $('#del_bb').submit();
}

function popup_info_chat() {
  if ( !readCookie('__c') ) {
    createCookie('__c', 'yes', 365);
    
    var DATA = '<img src="images/tutorial_new_message.jpg" alt="" />';

    var box = new studentjibe_box({
      width: 550,
      title: 'New message(s)',
      content: DATA,
      showSubmit: false,
      textCancel: 'Thanks!'
    });
  }
}

function remove_file_course(post_id) {
  var DATA = 'Are you sure you want to remove this file? <input type="hidden" id="activity_id" value="' + post_id + '" />';

  closeBox();
  
  var box = new studentjibe_box({
    width: 400,
    title: 'Remove file?',
    content: DATA,
    onsubmit: 'remove_file',
    textSubmit: 'Delete'
    //onCancel: 'cancel_class'
  });
}

function remove_file() {
  window.location = window.location + '&action=remove_course_file&activity_id=' + $('#activity_id').val();
}

function remove_file_course_comment(post_id) {
  var DATA = 'Are you sure you want to remove this file? <input type="hidden" id="activity_id" value="' + post_id + '" />';

  closeBox();

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove file?',
    content: DATA,
    onsubmit: 'remove_file_comment',
    textSubmit: 'Delete'
    //onCancel: 'cancel_class'
  });
}

function remove_file_comment() {
  window.location = window.location + '&action=remove_course_comment_file&activity_id=' + $('#activity_id').val();
}

function remove_file_classes(post_id) {
  var DATA = 'Are you sure you want to remove this file? <input type="hidden" id="activity_id" value="' + post_id + '" />';

  closeBox();
  
  var box = new studentjibe_box({
    width: 400,
    title: 'Remove file?',
    content: DATA,
    onsubmit: 'remove_cl_file',
    textSubmit: 'Delete'
    //onCancel: 'cancel_class'
  });
}

function remove_cl_file() {
  window.location = window.location + '?action=remove_course_file&activity_id=' + $('#activity_id').val();
}

function remove_file_classes_comment(post_id) {
  var DATA = 'Are you sure you want to remove this file? <input type="hidden" id="activity_id" value="' + post_id + '" />';

  closeBox();

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove file?',
    content: DATA,
    onsubmit: 'remove_cl_file_comment',
    textSubmit: 'Delete'
    //onCancel: 'cancel_class'
  });
}

function remove_cl_file_comment() {
  window.location = window.location + '?action=remove_course_comment_file&activity_id=' + $('#activity_id').val();
}

function remove_date_course(post_id) {
  var DATA = 'Are you sure you want to remove this date? <input type="hidden" id="date_id" value="' + post_id + '" />';

  closeBox();

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove date?',
    content: DATA,
    onsubmit: 'remove_date',
    textSubmit: 'Delete'
    //onCancel: 'cancel_class'
  });
}

function remove_date() {
  window.location = window.location + '&action=remove_course_date&date_id=' + $('#date_id').val();
}

function add_edit_class_mini(id, name) {
  $('#course_info').html('Loading...');
  $.ajax({
    data: 'course_id=' + id,
    dataType: 'html',
    type: 'POST',
    url: 'populate_professors',
    success: function (msg) {
      $('#course_info').html('Please select from the course drop down your classes');

      var DATA = '<div>\n\
                    <div style="font-weight: bold;"><img src="images/icon_accept_24.jpg" alt="" style="float: left; margin-right: 4px;" />' + name + '</div>\n\
                    <div style="color: black; font-weight: bold; line-height: 22px; padding-bottom: 10px; padding-top: 10px;">Add professor</div>\n\
                    <div align="center">\n\
                      <select id="teacher_id" onchange="javascript: class_teacher_select(this);"></select>\n\
                      <div style="height: 5px;"><!-- --></div>\n\
                      <div id="add_teacher" style="display: none">\n\
                        <input onclick="javascript: if ( $(this).val() == \'First name\' ) { $(this).val(\'\'); }" style="height: 18px; width: 170px;" type="text" value="First name" id="prof_first_name" />\n\
                        <input onclick="javascript: if ( $(this).val() == \'Last name\' ) { $(this).val(\'\'); }" style="height: 18px; width: 170px;" type="text" value="Last name" id="prof_last_name" />\n\
                      </div>\n\
                      <input type="hidden" id="class_id" value="' + id + '" />\n\
                    </div>\n\
                  </div>';

      var box = new studentjibe_box({
        width: 400,
        title: 'Add new class',
        content: DATA,
        onsubmit: 'save_edit_class_mini',
        onCancel: 'cancel_edit_class_mini'
      });

      if (  msg == '' ) {
        $('#teacher_id').css('display', 'none');
        $('#add_teacher').css('display', 'block');
      } else {
        $('#teacher_id').append(msg);
      }
    }
  });
}

function save_edit_class_mini() {
  window.location = 'modify_courses.php?action=add_class&class=' + $('#class_id').val() + '&teacher_first=' + $('#prof_first_name').val() + '&teacher_last=' + $('#prof_last_name').val() + '&teacher_id=' + $('#teacher_id').val();
}

function cancel_edit_class_mini() {
  $('#add_class').css({'color' : '#333333'}).val('Type here your class name...');
}

function edit_delete_class_mini(id) {
  var DATA = 'Are you sure you want to remove this class? <input type="hidden" id="class_id" value="' + id + '" />';

  var box = new studentjibe_box({
    width: 400,
    title: 'Remove class?',
    content: DATA,
    onsubmit: 'remove_edit_class_mini',
    onCancel: 'cancel_edit_class_mini'
  });
}

function remove_edit_class_mini() {
  window.location = 'modify_courses.php?action=remove_class&class=' + $('#class_id').val();
}

function add_new_vote_review(id) {
  var vote = $("#thevote_" + id).html();
  var addvote = parseInt(vote) + 1;
  
  $.ajax({
      data: 'id=' + id + '&addvote=' + addvote,
      dataType: 'html',
      url: 'vote_review_up',
      type: 'POST',
      success: function (msg) {
        if ( msg == 'added' ) {
          $('#error_multiple_vote').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; You have already voted for this review');          
          $('#error_multiple_vote').fadeOut(7000);
        } else {
          $("#thevote_" + id).html(parseInt(addvote));
          $("#vote_up_" + id + " img").addClass("img_voted");
          $("#vote_down_" + id + " img").addClass("img_voted");
        }
      }
    });
}

function remove_vote_review(id) {
  var vote = $("#thevote_" + id).html();
  var remvote = parseInt(vote) - 1;
  
  $.ajax({
      data: 'id=' + id + '&remvote=' + remvote,
      dataType: 'html',
      url: 'vote_review_down',
      type: 'POST',
      success: function (msg) {
        if ( msg == 'added' ) {
          $('#error_multiple_vote').css({'color' : 'red', 'font-size' : '11px', 'display' : 'block', 'padding-bottom' : '10px'}).html('&middot; You have already voted for this review');          
          $('#error_multiple_vote').fadeOut(7000);
        } else {
          $("#thevote_" + id).html(parseInt(remvote));
          $("#vote_up_" + id + " img").addClass("img_voted");
          $("#vote_down_" + id + " img").addClass("img_voted");
        }
      }
    });
}

function add_remove_class(id, action) {

 if ( action == 'add' || action == 'remove'){

        var dataString = 'course_id='+ id + '&action='+action;

        $.ajax
        ({
        type: "POST",
        url: "includes/ajax/add_remove_course.php",
        data: dataString,
        cache: false,
        success: function()
        {
                window.location.reload();
        }
        });
 }

}


