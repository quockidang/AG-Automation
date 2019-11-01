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
                                    <label for="name" class="col-sm-3 control-label ">loại sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addType" name="addType"
                                            value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label ">Mã sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addMaSP" name="addMaSP"
                                            value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addTenSP" name="addTenSP" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addImage" class="col-sm-3 control-label">Hình ảnh</label>
                                    <div class="col-sm-9">
                                        <img class="size120 imagefile" src="" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addDetail" class="col-sm-3 control-label">Chi tiết</label>
                                    <div class="col-sm-9">
                                        <textarea disabled type="text" class="form-control" id="addDetail"
                                            name="addDetail" value="" style="height:100px;"> </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addDiaChi" class="col-sm-3 control-label">Giá</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addPrice" name="addPrice" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nhóm phụ kiện</label>
                                    <div class="col-sm-9">
                                        <select disabled class="form-control select2 select2-hidden-accessible" multiple=""
                                            data-placeholder="Select a State" style="width: 100%;" name="Customization[]"
                                            id="Customization" tabindex="-1" aria-hidden="true">
                                            @foreach ($customization as $item)
                                            <option value="{{$item->id}}">{{$item->name}}
                                            </option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addPrice" class="col-sm-3 control-label">Mới</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addNew" name="addNew" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addPrice" class="col-sm-3 control-label">Mô tả chi tiết</label>
                                    <div class="col-sm-9">
                                        <textarea disabled type="text" class="form-control" id="addDetailDecrip"
                                            name="addDetailDecrip" value="" style="height: 200px;"> </textarea>
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
                    <i class="fas fa-plus"></i>Chỉnh sửa sản phẩm</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->