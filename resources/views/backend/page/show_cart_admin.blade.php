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
                            $Contents = Cart::getContent();
                        ?>
                        <div class="row">
                                <a class="text-green cursor-pointer posa " href="{{URL::to('/save-cart-admin/'.Session::get('idCustomer'))}}">
                                    <button type="button" class="btn btn-success">Tạo đơn hàng</button>
                                </a>
                                <a class="text-green cursor-pointer posa ml-5" href="{{URL::to('/create-bill-admin/'.Session::get('idCustomer'))}}">
                                    <button type="button" class="btn btn-primary">Tiếp Tục mua hàng</button>
                                </a>
                        </div>
                        <div class="table-responsive table-borderless">
                            <table class="table table-hover table-borderless table-striped b-t b-light">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Số Lượng</th>

                                        <th> Hinh ảnh</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Contents as $key => $Content)
                                    <tr>
                                        <td>{{ $key}}</td>
                                        <td>{{ $Content->name}}</td>
                                        <td>
                                           {{$Content->quantity}}
                                        </td>

                                        <td><img src="{{asset('source/images/'.$Content->attributes->image)}}" height="75"
                                                width="75" /></td>
                                                <td>{{number_format($Content->quantity * $Content->price). ' VNĐ'}}</td>
                                            <td>
                                            <a title="Xóa sản phẩm này" href="{{URL::to('/delete-cart-admin/'.$Content->id)}}"><i class="fa fa-trash"></i></a>
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

