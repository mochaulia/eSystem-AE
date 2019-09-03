<!-- Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="fa fa-close" aria-hidden="true"></span>
    </button>
    <h4 class="modal-title" id="myModalLabel" style="text-align:center;">{{ $product->name }}</h4>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <img class="img-responsive" src="{{ $product->thumbnail }}">
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 h4">
                <table class="">
                    <tr>
                        <th class="th_p">PIC:</th>
                        <td>{{ $product->pic_name }}</td>
                    </tr>
                    <tr>
                        <th class="th_p">Years:</th>
                        <td>{{ $product->years }}</td>
                    </tr>
                    <tr>
                        <th class="th_p">Status:</th>
                        <td>{{ $product->status }}</td>
                    </tr>
                    <tr>
                        <th class="th_p">Status HAKI:</th>
                        <td>{{ $product->status_haki }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 h4" style="margin-top:40px;">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#desc" aria-controls="desc" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <li role="presentation">
                        <a href="#tool" aria-controls="tools" role="tab" data-toggle="tab">Tools</a>
                    </li>
                    <li role="presentation">
                        <a href="#package" aria-controls="package" role="tab" data-toggle="tab">Workpack</a>
                    </li>
                    <li role="presentation">
                        <a href="#team" aria-controls="team" role="tab" data-toggle="tab">Teams</a>
                    </li>
                    <li role="presentation">
                        <a href="#client" aria-controls="clients" role="tab" data-toggle="tab">Client</a>
                    </li>
                </ul>
                <div class="tab-content" style="margin-top:20px;">
                    <div role="tabpanel" class="tab-pane fade in active" id="desc">{{ $product->description }}</div>
                    <div role="tabpanel" class="tab-pane fade" id="tool">{{ $product->tools }}</div>
                    <div role="tabpanel" class="tab-pane fade" id="package">{{ $product->workpack }}</div>
                    <div role="tabpanel" class="tab-pane fade" id="team">{{ $product->teams }}</div>
                    <div role="tabpanel" class="tab-pane fade" id="client">
                        <img style="width:100px;" src="{{ images_base64($this->clients_model->select(array('id' => $product->id_client))->logo) }}">
                        {{ $this->clients_model->select(array('id' => $product->id_client))->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
<!-- eof modal content -->