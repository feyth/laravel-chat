@if($message->from_user == \Auth::user()->id)
    <div class="conversation msg_container" data-message-id="{{ $message->id }}">
        <div class="head">
            <div class="chat_avatar">
                <img src="/chat/images/usr_avatar.png">
            </div>

            <div class="name_time">
                <div>
                    <h4>{{ $message->fromUser->name }}</h4>
                    <p><time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time></p>
                </div>
                <span class="email">{{ $message->fromUser->email }}</span>
            </div>
            <!-- end /.name_time -->
        </div>
        <!-- end /.head -->

        <div class="body">
            <p>
                {!! $message->content !!}
            </p>
        </div>
        <!-- end /.body -->
    </div>
    <!-- end /.conversation -->

@else
    <div class="conversation msg_container" data-message-id="{{ $message->id }}">
        <div class="head">
            <div class="chat_avatar">
                <img src="/chat/images/user-avatar.png">
            </div>

            <div class="name_time">
                <div>
                    <h4>{{ $message->fromUser->name }}</h4>
                    <p><time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time></p>
                </div>
                <span class="email">{{ $message->fromUser->email }}</span>
            </div>
            <!-- end /.name_time -->
        </div>
        <!-- end /.head -->

        <div class="body">
            <p>
                {!! $message->content !!}
            </p>
        </div>
        <!-- end /.body -->
    </div>
    <!-- end /.conversation -->
@endif
