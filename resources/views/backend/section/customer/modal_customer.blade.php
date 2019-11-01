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
                                    <label for="name" class="col-sm-3 control-label ">Mã</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addMaSV" name="addMaSV"
                                            value="" required data-required-error="Mã không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tài khoản</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addTaiKhoan"
                                            name="addTaiKhoan" value="" required
                                            data-required-error="Tài khoản không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" data-minlength="6" class="form-control"
                                            id="inputPassword" placeholder="Password" name="addPassword"
                                            data-minlength-error="Mật khẩu ít nhất 6 ký tự">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputPasswordConfirm"
                                            data-match="#inputPassword" name="addPasswordConfirm"
                                            data-match-error="Mật khẩu không khớp" placeholder="Confirm">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tên khách hàng</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addTenSV" name="addTenSV" value=""
                                            required data-required-error="Tên khách hàng không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addGender" class="col-sm-3 control-label">Giới tính</label>
                                    <div class="col-sm-9">
                                        <select name="addGender" id='addGender' class="form-control">
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addMail" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" id="addMail" name="addMail"
                                            value="" required data-required-error="Email không được trống.">
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
                                    <label for="addPoint" class="col-sm-3 control-label">Điểm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addPoint" name="addPoint" value=""
                                            required data-required-error="Điểm không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addConfirm" class="col-sm-3 control-label">Xác nhận</label>
                                    <div class="col-sm-9">
                                        <select name="addConfirm" id='addConfirm' class="form-control">
                                            <option value="1">Đã xác nhận</option>
                                            <option value="0">Chưa xác nhận</option>
                                        </select>
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
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->