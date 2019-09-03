<div class="x_panel_heading">
    <h3 class="x_title">
        <i class="fa fa-bullhorn"></i> <strong>FLASH NEWS</strong>
    </h3>
</div>
<div class="panel-body">
    <h4>{{ strip_tags($this->bulletin->flash_news()->text, '<strong><em>') }}</h4>
</div>