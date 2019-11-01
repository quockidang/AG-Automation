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
                        <a class="pl-3" href="{{URL::to('/show-cart-admin/'.$idCustomer)}}"><button
                                class="btn btn-success">Xem Giỏ Hàng</button></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class=" table-borderless">
                            <div>
                                <h4>Danh sách bộ Kit</h4>
                            </div>
                            <input style="width: 20%" class="form-control mr-sm-2" name="search" id="search_kit"
                                type="search" placeholder="Tìm kiếm bộ kit">
                            <table class="table table-sm table-hover table-borderless table-striped b-t b-light">

                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <th scope="col">Giá</th>

                                        <th scope="col"> Hinh ảnh sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody id="all_kit">
                                    @foreach($Products as $key => $product)

                                    <tr>
                                        <th class="align-middle" scope="row">{{ $key + 1}}</td>
                                        <td class="align-middle">{{ $product->name}}</td>
                                        <td class="align-middle">
                                            {{number_format($Totals[$key]) . ' VNĐ'}}
                                        </td>
                                        <td class="align-middle"><img src="{{asset('source/images/'.$product->image)}}"
                                                height="75" width="75" /></td>
                                        <td class="align-middle">
                                            <form action="{{URL::to('add-kit-cart-admin/'.$product->id)}}"
                                                method="post">
                                                {{ csrf_field() }}
                                                <?php
                                                        echo '<input hidden type="text" name="total" value="'.$Totals[$key].'">';
                                                        echo '<input hidden type="text" name="idCustomer" value="'.$idCustomer.'">';
                                                    ?>
                                                <div class="row">
                                                    <div class="form-group ">
                                                        <input type="number" minlength="3" maxlength="100" name="qty">
                                                    </div>
                                                    <div class="form-group ml-5">
                                                        <button type="submit" class="btn btn-primary">Thêm Vào Giỏ
                                                            hàng</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class=" table-borderless">
                            <div>
                                <h4>Danh sách Sản Phẩm</h4>
                            </div>
                            <input style="width: 20%" class="form-control mr-sm-2" name="search" id="search_product"
                                type="search" placeholder="Tìm kiếm Sản Phảm">
                            <table class="table table-sm table-hover table-borderless table-striped b-t b-light">

                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th> Hinh ảnh sản phẩm</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody id="all_product">
                                    @foreach($Productsss as $key => $acc)
                                    <tr>
                                        <td  class="align-middle">{{ $key}}</td>
                                        <td class="align-middle">{{ $acc->name}}</td>
                                        <td class="align-middle">
                                            {{ $acc->price}}

                                        </td>
                                        <td class="align-middle"><img src="{{asset('source/images/'.$acc->image)}}" height="75" width="75" />
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{URL::to('add-kit-cart-admin/'.$acc->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input hidden type="text" class="idCustomer" name="idCustomer"
                                                    value="{{$idCustomer}}">
                                                <div class="row">
                                                    <div class="form-group ">
                                                        <input type="number" minlength="3" maxlength="100" name="qty">
                                                    </div>
                                                    <div class="form-group ml-5">
                                                        <button type="submit" class="btn btn-primary">Thêm Vào Giỏ
                                                            hàng</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class=" table-borderless">
                            <div>
                                <h4>Danh sách phụ kiện</h4>
                            </div>
                            <input style="width: 20%" class="form-control mr-sm-2" name="search" id="search_accessories"
                                type="search" placeholder="Tìm kiếm phụ kiện">
                            <table class="table table-sm table-hover table-borderless table-striped b-t b-light">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th> Hinh ảnh sản phẩm</th>
                                        <th>Số lượng</th>


                                    </tr>
                                </thead>
                                <tbody id="all_accessories">

                                    @foreach($accessories as $key => $a)
                                    <tr>
                                        <td  class="align-middle">{{ $key + 1}}</td>
                                        <td class="align-middle">{{ $a->name}}</td>
                                        <td class="align-middle">{{ number_format($a->price) . ' VNĐ'}}</td>
                                        <td class="align-middle"><img src="{{asset('source/images/'.$a->image)}}" height="75" width="75" /></td>
                                        <td class="align-middle">
                                            <form action="{{URL::to('add-accessories-to-cart/'.$a->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input hidden type="text" class="idCustomer" name="idCustomer"
                                                    value="{{$idCustomer}}">
                                                <div class="row">
                                                    <div class="form-group ">
                                                        <input type="number" minlength="3" maxlength="100" name="qty">
                                                    </div>
                                                    <div class="form-group ml-5">
                                                        <button type="submit" class="btn btn-primary">Thêm Vào Giỏ
                                                            hàng</button>
                                                    </div>
                                                </div>
                                            </form>
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

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$mess = Session::get('message');
if($mess){
    echo '<input class="message" type="text" hidden value="'.$mess.'"/>';
    Session::put('message', null);
}

?>
@endsection

@section('script')


<script>
    var notifi = $('.message').val();
    if(notifi != null){
        var notification = alertify.notify(notifi, 'success', 5, function(){  console.log('dismissed'); });
    }

</script>

<script>
    $('#search_kit').on('keyup',function(){
            $value = $(this).val();
            $idCustomer = $('.idCustomer').val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-kit') }}',
                data: {
                    'search': $value,
                    'idCustomer': $idCustomer
                },
                success:function(data){
                    $('#all_kit').html(data);
                }
            });
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script>
    $('#search_product').on('keyup',function(){
                $value = $(this).val();
                $idCustomer = $('.idCustomer').val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search-product') }}',
                    data: {
                        'search': $value,
                        'idCustomer': $idCustomer
                    },
                    success:function(data){
                        $('#all_product').html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script>
    $('#search_accessories').on('keyup',function(){
                    $value = $(this).val();
                    $idCustomer = $('.idCustomer').val();
                    $.ajax({
                        type: 'get',
                        url: '{{ URL::to('search-accessories') }}',
                        data: {
                            'search': $value,
                            'idCustomer': $idCustomer
                        },
                        success:function(data){
                            $('#all_accessories').html(data);
                        }
                    });
                })
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
