<!-- Add modal customer -->
<div class="modal fade" id="modal-level3" data-backdrop="static">
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
                            <form class="form-horizontal" id="LevelOption" role="form" data-toggle="validator">
                                <input hidden name="action" id="action">
                                <input hidden type="hidden" name="id" id="id">
                                <input type="hidden" name="cap_id" id="cap_id">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Option của sản phẩm</label>
                                    <div class="col-sm-9">
                                        <select name="addOptionId" id="addOptionId" class="form-control">
                                            @foreach ($product as $item)
                                            <option value="{{ $item->id}}">{{ $item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Ngày đặt option</label>
                                    <div class="col-sm-9">
                                        <input required type="date" class="form-control" id="addNgayOption"
                                            name="addNgayOption" value=""
                                            data-required-error="Ngày đặt không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Bảo hành(tháng)</label>
                                    <div class="col-sm-9">
                                        <input required type="number" class="form-control" id="addBaoHanhOption"
                                            name="addBaoHanhOption" value="0"
                                            data-required-error="Bảo hành không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Ghi chú</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addGhiChuOption"
                                            name="addGhiChuOption" value="">
                                        <div class="help-block with-errors"></div>
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
                <button type="button" class="btn btn-primary" id="OptionBtn"
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i>Lưu</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add modal employee  -->