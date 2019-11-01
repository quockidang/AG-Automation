<div class="modal-body">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_vn_edit">
                <form action="{{route('test')}}" enctype="multipart/form-data" class="form-horizontal" id="LevelForm" role="form" data-toggle="validator">
                    <input name="action" id="action">
                    <input name="id" id="id">
                    @csrf
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label ">Mã sản phẩm</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="addMaSV" name="addMaSV" value=""
                                required data-required-error="Tên cấp trường không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Tên sản phẩm</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addTenSV" name="addTenSV" value="" required
                                data-required-error="Tên cấp trường không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addDiaChi" class="col-sm-2 control-label">Detail</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addDiaChi" name="addDiaChi" value="" required
                                data-required-error="Địa chỉ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addDiaChi" class="col-sm-2 control-label">Giá nhỏ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addDiaChi" name="addDiaChi" value="" required
                                data-required-error="Địa chỉ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addPhone" class="col-sm-2 control-label">Giá vừa</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addPhone" name="addPhone" value="" required
                                data-required-error="Số điện thoại không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addPrice" class="col-sm-2 control-label">Giá lớn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addPrice" name="addPrice" value="" required
                                data-required-error="Số điện thoại không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="addPrice" class="col-sm-2 control-label">Mới</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addPrice" name="addPrice" value="" required
                                data-required-error="Số điện thoại không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="addPrice" class="col-sm-2 control-label">image</label>
                        <div class="col-sm-9">
                            <input type="file" name="image" id="exampleInputFile">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="addPrice" class="col-sm-2 control-label">detail_descrip</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="addPrice" name="addPrice" value="" required
                                data-required-error="Số điện thoại không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> 

                    <button type="submit" class="btn btn-success">Add</button>
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
        <i class="fas fa-plus"></i> Lưu</button>
</div>