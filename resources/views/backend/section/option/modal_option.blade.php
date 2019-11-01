<!-- Add modal customer -->
<div class="modal fade" id="modal-level" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span id="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="LevelForm" role="form" data-toggle="validator">
                                <input hidden name="action" id="action">
                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label ">Mã phụ kiện</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="addMaSP" name="addMaSP" value=""
                                            data-required-error="Mã phụ kiện không được trống.">
                                            <div class="help-block with-errors"></div>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tên phụ kiện</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addTenSP" name="addTenSP" value=""
                                            required data-required-error="Tên phụ kiện không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addDiaChi" class="col-sm-3 control-label">Giá</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="addPrice" name="addPrice" value=""
                                            required data-required-error="Giá phụ kiện không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addImage" class="col-sm-3 control-label">Hình ảnh</label>
                                    <div class="col-sm-9">
                                        <img class="size120 imagefile" src="" alt="">
                                        <input required type="hidden" id="addImage" name="addImage" class="form-control"
                                            data-required-error="Hình ảnh không được trống.">
                                        <button id="browseserver" class="button-a button-a-background">Browse
                                            Server</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="LevelBtn"
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i>Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->