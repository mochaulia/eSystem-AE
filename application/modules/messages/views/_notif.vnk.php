@if (!$messages)
    <li>
        <p class="text-center">No messages found</p>
    </li>
@else
    @foreach ($messages as $msg)
        <li>
            <a href="{{ site_url('messages/inbox?read=' . url_encode($msg->id)) }}">
                <span class="image">
                    <img src="{{ images(user($msg->id_from)->avatar) }}" alt="Profile Image" />
                </span>
                <span>
                    <span>{{ user($msg->id_from)->first_name }} {{ user($msg->id_from)->last_name }}</span>
                    <span class="time">{{ relative_date(strtotime($msg->timestamp)) }}</span>
                </span>
                <span class="message">
                    {{ substr(strip_tags($msg->text), 0, 20) }}...
                </span>
            </a>
        </li>
    @endforeach
@endif
<li>
    <div class="text-center">
        <a href="{{ site_url('messages/inbox') }}">
            <strong>See All Inbox</strong>
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</li>