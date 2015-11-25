@extends('frontend/shared/one_column')

@section('content')
    {!! HTML::script('frontend/js/message.js') !!}
    <div class="site_width">
        <div class="site_content" style="margin: 0 auto; width: 635px; padding-top: 20px; padding-bottom: 100px;">
            <div id="display_sent_messages" class="site_content_left display_sent_messages">
                <div>
                    <div class="standard_page_title">Sent Message</div>
                    <div class="messages_cont">
                        <div class="left">
                            {!! Form::text('sent_messages_search', null, array('class'=>'messages_search', 'id' => 'sent_messages_search', 'placeholder'=>'Search message', 'value'=>Input::old('sent_messages_search'))) !!}
                        </div>
                        <div style="float: right; margin-left: 5px;">
                            <a id="view_messages" class="messages_new_message" href="/message/?option=message">Message</a>
                        </div>
                        <div class="right">
                            <a class="messages_new_message" href="javascript: void(0);"
                               onclick="javascript: send_message_user('');">New message</a>
                        </div>
                        <div class="clear"><!-- --></div>
                    </div>
                    <div style="padding: 0 0 15px 10px; font-size: 13px;">
                        {!! $sendMessages->count()>0  ? 'Messages sent to' : '' !!}

                    </div>
                </div>
                @if(count($sendMessages))
                    <?php $i = 0; ?>
                    @foreach($sendMessages as $message)
                        <?php $onclick = ' onclick="javascript: window.location = \'/message/' . base64_encode($message->id) . '\';"';?>
                        <div style="background-color:{!! $message->read=='0' ? 'EEF8FD' : $countReplyMessage[$i]>0? '#FFFFE1;"' : ''!!} "
                             class="messages_item" id="message_item_{!! $message->id !!}">
                            <div class="messages_item_left" {!! $onclick !!}>
                                @if($message->photo)
                                    <img style="border: 1px solid {!! $message->online==1?'00CC00': 'EAEAEA' !!}; padding: 1px;"
                                         src="{!! url($message->photo . $article->file_name) !!}" width="55" height="55"
                                         alt="" border="0"/>
                                @else
                                    <img style="border: 1px solid {!! $message->online==1?'00CC00': 'EAEAEA' !!}; padding: 1px;"
                                         src="{!! url('assets/images/default.png') !!}" width="55" height="55" alt=""
                                         border="0"/>
                                @endif
                            </div>
                            <div class="messages_item_center" {!! $onclick !!}>
                                <div class="messages_item_center_title">
                                    <a style="font-size: 13px;" class="user_link" href="javascript: void(0);">
                                        {!! $message->full_name !!}
                                    </a>
                                </div>

                                <div class="messages_item_center_content">
                                    {!! my_substr($message->content,250) !!}
                                </div>
                            </div>
                            <div class="messages_item_center2"
                                 <?php echo $onclick; ?> style="padding-right: 5px;">{!! aproximate_time($message->time, $message->created_at) !!} </div>
                            <div class="messages_item_right">

                            </div>

                            <div class="clear"><!-- --></div>
                        </div>
                    @endforeach
                    {!! $sendMessages->appends(['option' => 'send-message'])->render() !!}
                @endif
            </div>

            <div class="clear"><!-- --></div>
        </div>
    </div>
@stop
