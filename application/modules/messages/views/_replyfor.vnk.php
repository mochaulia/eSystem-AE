<div class="sender-info">
    <div class="row">
        <div class="col-md-12">
            <strong>{{ (!$mine) ? user($msg->id_from)->first_name . ' ' . user($msg->id_from)->last_name : 'Me'}}</strong>
            @if (!$mine)
                <span>({{ user($msg->id_from)->email }})</span>
            @endif
            to <strong>{{ ($mine) ? user($msg->id_to)->first_name . ' ' . user($msg->id_to)->last_name : 'Me'}}</strong>
            @if ($mine)
                <span>({{ user($msg->id_to)->email }})</span>
            @endif
        </div>
    </div>
</div>
<div class="view-mail" style="margin-top:20px;">
    {{ $msg->text }}
</div>
@if ($msg->reply_for)
    <span style="margin-bottom:10px;display:block;">
        <code><em>this message is reply for</em>
            <a href="#" class="showReplyFor" data-reply-id="{{ $msg->reply_for }}">this message</a>
        </code>
    </span>
    <div id="replyForDiv{{ $msg->reply_for }}" style="margin-bottom:10px;"></div>
@endif