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
                                <input type="hidden" name="idcustomer" id="idcustomer">
                                <input type="hidden" name="email" id="email">

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label ">Mã hóa đơn</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addMaSV" name="addMaSV"
                                            value="" required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addMail" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addMail" name="addMail"
                                            value="" required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tên khách hàng</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addTenSV" name="addTenSV" value=""
                                            required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addDiaChi" class="col-sm-3 control-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addDiaChi" name="addDiaChi" value=""
                                            required data-required-error="Địa chỉ không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addPhone" class="col-sm-3 control-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addPhone" name="addPhone" value=""
                                            required data-required-error="Số điện thoại không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addDate" class="col-sm-3 control-label">Ngày đặt</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input disabled type="text" class="form-control datepicker" name="addDate"
                                                id="addDate" value="" required
                                                data-required-error="Ngày sinh không được trống."
                                                data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                        </div>
                                        <!-- /.input group -->
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addPrice" class="col-sm-3 control-label">Giá</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addPrice" name="addPrice"
                                            value="" required data-required-error="Giá không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addPayment" class="col-sm-3 control-label">Hình thức thanh toán</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addPayment" name="addPayment"
                                            value="" required
                                            data-required-error="Hình thức thanh toán không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addStatus" class="col-sm-3 control-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <select name="addStatus" id='addStatus' class="form-control">
                                            <option value="0">Chưa xử lý</option>
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Đã xử lý</option>
                                        </select>
                                    </div>
                                </div>

                                @isset($staff)
                                <div class="form-group" id='nvht'   >
                                    <label for="addStaff" class="col-sm-3 control-label">Nhân viên hỗ trợ</label>
                                    <div class="col-sm-9">
                                        <select name="addStaff" id='addStaff' class="form-control">
                                            @foreach ($staff as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endisset

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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->