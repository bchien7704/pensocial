@extends('frontend/shared/one_column')

@section('content')
    {!! HTML::script('frontend/js/message.js') !!}
    <div class="site_width ">
        <div class="site_content message_detail">
            <div class="site_content_left">
                <div>
                    <div class="standard_page_title">{!! $messageDetail->subject.'('.$messageDetail->full_name.')' !!}</div>

                    <div class="messages_cont">
                        <div class="right messages_cont_right">
                            <input class="messages_search" id="conversation_search" type="text" value="" />
                        </div>

                        <div class="messages_cont_left">
                            <a class="messages_back_message" href="{!! route('message') !!}">Back messages</a>
                        </div>

                        <div class="clear"><!-- --></div>
                    </div>
                </div>
                <div class="messages_item" style="cursor: default;">
                    <div class="messages_item_left">
                        <a href="#">
                            @if($messageDetail->photo)
                                <img class="{!! $messageDetail->online==1?'avatar_online':'avatar_offline'!!}"
                                     src="{!! url($messageDetail->photo . $messageDetail->file_name) !!}"
                                     alt=""/>
                            @else
                                <img class="{!! $messageDetail->online==1?'avatar_online':'avatar_offline'!!}"
                                     src="{!! url('assets/images/default.png') !!}"  alt=""
                                    />
                            @endif
                        </a>
                    </div>
                    <div class="messages_item_center" style="width: 380px;">
                        <div class="messages_item_center_title"><a class="user_link" href="">{!! $messageDetail->full_name !!}</a></div>

                        <div class="messages_item_center_content">
                         {!! $messageDetail->content !!}
                        </div>
                    </div>
                    <div class="messages_item_center2 right" ><?php echo aproximate_time($messageDetail->time, $messageDetail->created_at); ?></div>

                    <div class="clear"><!-- --></div>
                </div>

                @foreach($replyMessages as $reply)
                <div class="messages_item {!! $reply->reply_to!=0 ?'reply_item':'' !!}" style="cursor: default;">
                    <div class="messages_item_left">
                        <a href="#">
                            @if($reply->photo)
                                <img class="{!! $reply->online==1?'avatar_online':'avatar_offline'!!}"
                                     src="{!! url($reply->photo . $reply->file_name) !!}"
                                     alt="" />
                            @else
                                <img class="{!! $reply->online==1?'avatar_online':'avatar_offline'!!}"
                                     src="{!! url('assets/images/default.png') !!}" alt=""
                                    />
                            @endif
                        </a>
                    </div>
                    <div class="messages_item_center" style="{!! $reply->reply_to !=0 ? ' width: 320px;' : ' width: 380px;'!!}">
                        <div class="messages_item_center_title"><a style="font-size: 13px;" class="user_link" href="#">{!! $reply->full_name !!}</a></div>

                        <div class="messages_item_center_content">
                            {!! $reply->content !!}
                        </div>
                    </div>
                    <div class="messages_item_center2" style="float: right; color: #ccc;"><?php echo aproximate_time($reply->time, $reply->created_at); ?></div>

                    <div class="clear"><!-- --></div>
                </div>
                 @endforeach

                <div style="background-color: #f8f8f8; padding-bottom: 20px;">
                    {!! Form::open( array( 'route' => array('message.reply',base64_encode($messageDetail->id)))) !!}
                        <div class="content_reply" >
                            <input type="hidden" name="replay_subject" value="'Re: ' .{!! $messageDetail->subject !!} " />
                            <input type="hidden" id="reply_for_id" name="reply_for_id" value="{!! base64_encode($messageDetail->id) !!} " />
                            Quick reply: <input class="messages_reply"  type="text" name="message" />
                            <input name="reply" type="submit" value="Reply" />
                        </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="clear"><!-- --></div>
        </div>
    </div>
    </div>
@stop