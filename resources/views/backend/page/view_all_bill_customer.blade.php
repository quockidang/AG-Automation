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

            <div class="table-responsive table-borderless">
                    <table class="table table-hover table-borderless table-striped b-t b-light">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ngày tạo</th>
                            <th>Danh sách sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($bill as $key => $val)
                          <tr>
                          <td>{{ $val->id}}</td>
                            <td>{{ $val->created_at}}</td>


                            <th>
                                <?php
                                    $detail = App\BillDetailAdmin::where('bill_id', $val->id)->get();
                                    foreach ($detail as $key => $value) {
                                        # code...
                                        $product = App\Product::where('id', $value->product_id)->first();
                                        if($product)
                                        {
                                            echo '<p>'.$product->name.'</p>';
                                        }else {
                                            # code...
                                            $product = App\Accessories::where('id', $value->product_id)->first();
                                            echo '<p>'.$product->name.'</p>';
                                        }

                                    }
                                ?>
                            </th>
                            <td>{{number_format($val->total_price) . ' VNĐ'}}</td>
                            <td>
                                    <a title="Xem chi tiết đơn hàng" href="{{URL::to('/view-detail-bill-admin/'.$val->id)}}"><i class="fa  fa-eye fontsize25" style="text-align: center;
                                        padding-top: 11px;"></i></a>
                                    <a title="Kết xuất PDF" href="{{URL::to('/export-PDF-bill/' . $val->id)}}" ><input class="ml-3 btn btn-sm btn-primary" type="button" value="Kết xuất PDF"></a>
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

