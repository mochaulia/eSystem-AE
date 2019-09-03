<marquee direction="left">
    @foreach ($this->bulletin->running_text() as $running_text)
    <img src="{{ images_base64('icon/esystem.png') }}"> {{ strip_tags($running_text->text) }}
    @endforeach
</marquee>