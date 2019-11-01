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
                <div class="table-responsive table-borderless">
                        <table class="table table-hover table-borderless table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th> Hinh ảnh sản phẩm</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $product->name}}</td>
                                    <td>
                                        <?php
                                $cate = $product->ProductType()->first();
                                echo $cate->categories_name;
                            ?>
                                    </td>
                                    <td>
                                        <?php
                                            $total = 0;
                                            $AccessoriesId = App\ListAccessories::where('accessories_group_id', $product->accessory_group_id)
                                                                                ->get('accessories_id');
                                            $AccessoriesId = 

                                        ?>

                                    </td>
                                    <td><img src="{{asset('source/images/'.$product->image)}}" height="75"
                                            width="75" /></td>




                                    <td>
                                       Thêm vào giỏ hàng
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
