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
                <?php
                $mess = Session::get('message');
                if($mess){
                    echo '<input class="message" type="text" hidden value="'.$mess.'"/>';
                    Session::put('message', null);
                }
            ?>
            <div class="row">
                    <a title="Thêm mới khách hàng" class="text-green cursor-pointer posa col-md-4" href="{{URL::to('/view-add-customer')}}">
                        <button type="button" class="btn btn-success">Thêm</button>
                    </a>
                    <div class="form-group col-md-4">
                            <input class="form-control mr-sm-2" name="search" id="search_customer" type="search" placeholder="Tìm kiếm">
                    </div>
            </div>


            <div class="table-responsive table-borderless">
                    <table class="table table-hover table-borderless table-striped b-t b-light">
                      <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Khách hàng</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Địa Chỉ</th>
                            
                            <th scope="col">Số ĐT</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($Customers as $key => $customer)
                          <tr>
                          <th  scope="row">{{ $key + 1}}</td>
                            <td class="align-middle">{{ $customer->name}}</td>
                            <td class="align-middle">
                                {{$customer->gender}}
                            </td>
                            <td class="align-middle">{{$customer->address}}</td>

                            <td class="align-middle">{{$customer->phone}}</td>
                            <td class="align-middle">
                                <a title="Hiệu chỉnh thông tin khách hàng" href="{{URL::to('/edit-customer/'.$customer->id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o fontsize25" style="color: #3c8dbc;" aria-hidden="true"></i></a>
                                <a title="Xem các đơn hàng" href="{{URL::to('/view-all-bill-admin/'.$customer->id)}}"><i class="fa  fa-eye fontsize25" style="text-align: center;
                                    padding-top: 11px;"></i></a>
                                <a title="Tạo đơn hàng" href="{{URL::to('/create-bill-admin/'.$customer->id)}}"><i class="fa fa-shopping-cart fontsize25" style="text-align: center;
                                    padding-top: 11px;"></i></a>
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
        $('#search_customer').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-customer') }}',
                data: {
                    'search': $value
                },
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

<script>
    var notifi = $('.message').val();
    if(notifi != null){
        var notification = alertify.notify(notifi, 'success', 5, function(){  console.log('dismissed'); });
    }

</script>
@endsection
