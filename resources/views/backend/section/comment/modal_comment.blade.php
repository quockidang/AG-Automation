<!-- /.box-footer -->
<div class="box-footer">
    <form id="LevelForm"  method="post">
        <div class="input-group">
            <input hidden type="text" name="cap_id" id="cap_id" value="{{$capid}}">
            <div class="col-sm-12">
                <textarea required type="text" class="form-control" id="addComment" name="addComment"
                    style="height: 200px;"></textarea>
            </div>
            <span class="input-group-btn">
                <button class="btn btn-success btn-flat">Send</button>
            </span>
        </div>
    </form>
</div>
<!-- /.box-footer -->
<div class="control-row body-comment" id='body-comment'>
    @foreach ($comment as $item)
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
                    <span class="username"><a href="#">{{$item->user->name}}</a></span>
                    <span class="description">{{ date('H:i:s d-m-Y', strtotime($item->date)) }}</span>
                </div>
                <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    {!!$item->comment!!}
            </div>
        </div>
        <!-- /.box -->
    </div>
    @endforeach
</div>

