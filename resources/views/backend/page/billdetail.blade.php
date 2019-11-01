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
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$boxtitle}}</h3>
            </div>
            <div>
                <h3>
                    {{$Customer->name}} -
                    <small
                        class="text-muted"> {{$Customer->address . '  -  ' . $Customer->phone . '  -  ' . $Customer->email . '  -    '}}

                        <?php
                            if($bill->status == 0){
                                        echo'
                                        <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                            Chưa xử lí
                                          </div>
                                        ';
                                    }else if($bill->status == 0){
                                        echo'
                                        <div class="badge badge-warning text-wrap" style="width: 6rem;">
                                            Chưa xử lí
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
                    </small>
                </h3>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <caption>{{'Tổng tiền:  ' . number_format($bill->total) . ' VNĐ'}}</caption>
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên Sản Phẩm</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billDetail as $key => $item)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>
                            <?php
                                    $pro = App\Product::find($item->product_id);
                                    if($pro){
                                        echo $pro->name;
                                    }else{
                                        echo App\Accessories::find($item->product_id)->name;
                                    }
                                ?>
                        </td>
                        <td>
                            <?php
                                $pro = App\Product::find($item->product_id);
                                if($pro){
                                    echo '<img src="source/images/'.$pro->image.'" height="75" width="75" />';
                                }else{
                                    $pro = App\Accessories::find($item->product_id);
                                    echo '<img src="source/images/'.$pro->image.'" height="75" width="75" />';
                                }
                            ?>
                        </td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->price) . ' VNĐ'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="btn-group pt-4" role="group" aria-label="Basic example">
            <a href="{{URL::to('process-bill/'.$bill->id)}}"><button type="button" class="ml-3 btn btn-sm btn-warning">Tiếp nhận</button></a>
            <a href="{{URL::to('success-bill/'.$bill->id)}}"><button type="button" class="ml-3 btn btn-sm btn-success">Hoàn tất</button></a>
            <a href="{{URL::to('delete-bill/'.$bill->id)}}"> <button type="button" class="ml-3 btn btn-sm btn-danger">Hủy Đơn hàng</button></a>
            </div>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
