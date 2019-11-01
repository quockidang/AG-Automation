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
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Mã</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addId" name="addId" value=""
                                            required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addName" name="addName" value=""
                                            required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addSize" name="addSize" value=""
                                            required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Số lượng</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addQty" name="addQty" value=""
                                            required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Giá</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="addPrice" name="addPrice" value=""
                                            required data-required-error="Tên cấp trường không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Topping</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select2-hidden-accessible" multiple=""
                                        data-placeholder="Select a State" style="width: 100%;" name="Topping[]" id="Topping" tabindex="-1"
                                        aria-hidden="true">
                                        {{-- @foreach ($topping as $item)
                                            <option value="{{$item->id}}" data-price="{{$item->price}}">{{$item->name}}</option>
                                        @endforeach --}}
                                        </select>   
                                    </div>
                                </div>
                                <!-- /.form-group -->



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