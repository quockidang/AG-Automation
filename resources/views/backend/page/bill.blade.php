@extends('backend.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{$titleheader}}
    
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


            <div class="table-responsive table-borderless">
                <table class="table table-hover table-borderless table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Khách Hàng</th>
                            <th scope="col">Ngày Đặt hàng</th>
                            <th scope="col">Tổng Tiền</th>
                            <th scope="col"> Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Bills as $key => $item)
                            <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>
                                <?php
                                    echo App\Customer::find($item->customer_id)->name;
                                ?>

                            </td>
                            <td>{{$item->date_order}}</td>
                            <td>{{number_format($item->total) . ' VNĐ'}}</td>
                            <td>

                                <?php
                                    if($item->status == 0){
                                        echo'
                                        <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                            Chưa xử lí
                                          </div>
                                        ';
                                    }else if($item->status == 1){
                                        echo'
                                        <div class="badge badge-warning text-wrap" style="width: 6rem;">
                                            đã tiếp nhận
                                          </div>
                                        ';
                                    }else{
                                        echo'
                                        <div class="badge badge-success text-wrap" style="width: 6rem;">
                                            hoàn tất
                                          </div>
                                        ';
                                    }
                                ?>

                            </td>
                            <td>
                                <a href="{{URL::to('/view-bill-detail/'.$item->id)}}"><button type="button" class="ml-3 btn btn-sm btn-warning">Xem chi tiết</button></a>
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
    @include('backend.modal_confirm_delete')
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')
<script src="js/backend/bill.js"></script>
@endsection
