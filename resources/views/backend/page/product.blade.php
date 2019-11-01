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
                        <a class="text-green cursor-pointer posa" href="{{URL::to('/viewaddproduct')}}">
                            <button type="button" class="btn btn-success">Thêm</button>
                        </a>

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
                                        <td>{{ number_format($product->price) . ' VNĐ'}}</td>
                                        <td><img src="{{asset('source/images/'.$product->image)}}" height="75"
                                                width="75" /></td>




                                        <td>
                                            <a href="{{URL::to('/view-detail-product/'.$product->id)}}"> <i
                                                    class="fa fa-info-circle fontsize25" aria-hidden="true"></i></a>
                                            <a href="{{URL::to('/edit-product/'.$product->id)}}" class="active"
                                                ui-toggle-class=""><i class="fa fa-pencil-square-o fontsize25"
                                                    aria-hidden="true"></i></a>
                                            <a href="{{URL::to('/delete-product/'.$product->id)}}"
                                                onclick="return confirm('Are you sure to delete?')" class="active"
                                                ui-toggle-class=""><i class="fa fa-trash fontsize25"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="toast mt-3">
                            <div class="toast-header">
                                Toast Header
                            </div>
                            <div class="toast-body">
                                Some text inside the toast body
                            </div>
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
        if(notifi != null || notifi != undefined){
            var notification = alertify.notify(notifi, 'success', 5, function(){  console.log('dismissed'); });
        }

    </script>


@endsection
