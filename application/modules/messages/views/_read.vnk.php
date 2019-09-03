<div class="inbox-body">
    <div class="mail_heading row">
        <div class="col-md-8">
            <div class="btn-group">
                <button class="btn btn-sm btn-primary" type="button" {{ ($mine) ? 'disabled' : '' }}
                        data-msg-id="{{ $msg->id }}"
                        data-from-id="{{ $msg->id_from }}"
                        data-toggle="modal"
                        data-target="#modalCompose">
                    <i class="fa fa-reply"></i> Reply
                </button>
                <button class="btn btn-sm btn-default" type="button"
                        data-msg-id="{{ $msg->id }}"
                        data-toggle="modal"
                        data-target="#modalDelete">
                    <i class="fa fa-trash-o"></i>
                </button>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <p class="date"> {{ relative_date(strtotime($msg->timestamp)) }}</p>
        </div>
        <div class="col-md-12">
            <h4> {{ $msg->subject }}</h4>
        </div>
    </div>
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
    <div class="view-mail" style="margin-top:10px;">
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
    <div class="btn-group">
        <button class="btn btn-sm btn-primary" type="button" {{ ($mine) ? 'disabled' : '' }}
                data-msg-id="{{ $msg->id }}"
                data-from-id="{{ $msg->id_from }}"
                data-toggle="modal"
                data-target="#modalCompose">
            <i class="fa fa-reply"></i> Reply
        </button>
        <button class="btn btn-sm btn-default" type="button"
                data-msg-id="{{ $msg->id }}"
                data-toggle="modal"
                data-target="#modalDelete">
            <i class="fa fa-trash-o"></i>
        </button>
    </div>
</div>