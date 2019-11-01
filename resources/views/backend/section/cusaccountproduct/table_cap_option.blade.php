<!-- Add modal customer -->
<div class="modal fade" id="modal-level2" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child">Danh sách option</i>
                    <span id="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-default pull-left" id="addOption"><a
                        class="text-green cursor-pointer posa">
                        <i class="fa fa-plus-square fontsize25"></i>
                    </a></button>

            </div>
            <div class="control-row table-responsive">
                <table class="table table-bordered table-striped table-dynamic table-dynamic-option nowrap"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="100px">id</th>
                            <th class="text-center">Tên option</th>
                            <th class="text-center">Ngày đặt</th>
                            <th class="text-center">Bảo hành(tháng)</th>
                            <th class="text-center" width="200px"></th>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Thoát</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add modal employee  -->