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
                                echo '<input id="message1" type="text"  value="'.$mess.'"/>';
                                Session::put('message', null);
                            }
                        ?>
            <div class="table-responsive table-borderless">
                    <table class="table table-hover table-borderless table-striped b-t b-light">
                      <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Phụ kiện</th>

                            <th>Giá</th>
                            <th> Hinh ảnh</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($optionModel as $key => $product)
                          <tr>
                          <td>{{ $key + 1}}</td>
                            <td>{{ $product->name}}</td>

                            <td>{{ $product->price}}</td>
                            <td><img src="{{asset('source/images/'.$product->image)}}" height="75" width="75"/></td>
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
