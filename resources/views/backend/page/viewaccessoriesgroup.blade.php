@extends('backend.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{$titleheader}}
      <small>advanced tables</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{$boxtitle}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
                <?php
                $mess = Session::get('message');
                if($mess){
                    echo '<input class="message" type="text" hidden value="'.$mess.'"/>';
                    Session::put('message', null);
                }
            ?>
            <a class="text-green cursor-pointer posa" href="{{URL::to('/view-add-accessory-group')}}">
                <button type="button" class="btn btn-success">Thêm</button>
            </a>
            <div class="table-responsive table-borderless">
                    <table class="table table-hover table-borderless table-striped b-t b-light">
                      <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Nhóm Phụ kiện</th>
                            <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($accessoriesGroup as $key => $group)
                          <tr>
                          <td>{{ $key + 1}}</td>
                            <td>{{ $group->name}}</td>
                            <td>

                                <a href="{{URL::to('/edit-accessory-group/'.$group->id)}}" class="active" ui-toggle-class=""><button type="button" class="btn btn-primary">Thêm Phụ kiện vào nhóm</button></a>
                                <a href="{{URL::to('/delete-group-accessory/'.$group->id)}}" onclick="return confirm('Are you sure to delete?')" class="active" ui-toggle-class=""><button type="button" class="btn btn-danger">Xóa Nhóm Phụ kiện</button></a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


@section('script')

<script>
    var notifi = $('.message').val();
    if(notifi != null){
        var notification = alertify.notify(notifi, 'success', 5, function(){  console.log('dismissed'); });
    }

</script>

@endsection
