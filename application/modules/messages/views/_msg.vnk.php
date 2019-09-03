@if (!$inboxes)
    <p class="text-center">No messages found.</p>
@else
    @foreach ($inboxes as $msg)
        <a href="#" class="readMsg" data-id="{{ $msg->id }}">
            <div class="mail_list">
                <div class="left">
                    <i class="{{ (($msg->is_read == 0) && !$mine) ? 'fa fa-circle' : '' }}"></i> 
                    <i class="{{ (($msg->is_read == 1) && $mine) ? 'fa fa-eye' : '' }}"></i> 
                </div>
                <div class="right">
                    <h3>{{ (!$mine) ? user($msg->id_from)->first_name . ' ' . user($msg->id_from)->last_name : 'Me' }} <small>{{ relative_date(strtotime($msg->timestamp)) }}</small></h3>
                    <span {{ (($msg->is_read == 0) && !$mine) ? 'style="font-weight: bold"' : '' }}>
                        <p>{{ substr(strip_tags($msg->text), 0, 40) }}...</p>
                    </span>
                </div>
            </div>
        </a>
    @endforeach
@endif