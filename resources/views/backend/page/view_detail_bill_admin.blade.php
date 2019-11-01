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
                            <th>STT</th>
                            <th>Sản Phẩm</th>
                            <th>Hình Ảnh</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($detail as $key => $val)
                          <tr>
                          <td>{{ $key + 1}}</td>
                            <td>
                                <?php
                                    $product = App\Product::where('id', $val->product_id)->first();
                                    if($product)
                                    {
                                        echo $product->name;
                                    }else {
                                        # code...
                                        $product = App\Accessories::where('id', $val->product_id)->first();
                                        echo $product->name;
                                    }

                                ?>
                            </td>
                            <td>
                            <?php
                                    $product = App\Product::where('id', $val->product_id)->first();
                                    if($product)
                                    {
                                        echo '<img src="source/images/'.$product->image.'"  height="75" width="75"/>';
                                    }else {
                                        # code...
                                        $product = App\Accessories::where('id', $val->product_id)->first();
                                        echo '<img src="source/images/'.$product->image.'"  height="75" width="75"/>';
                                    }

                                ?>
                            </td>
                            <td>{{$val->quantity}}</td>
                            <td>{{number_format($val->price) . ' VNĐ' }}</td>

                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="row">
                        <div class="col-md-8">
                  <div>
                        <h4>Thêm Ghi Chú</h4>
                            <form method="post" action="{{URL::to('add-note-admin/'. $id)}}">
                            @csrf
                            <div class="form-group">
                                <textarea type="text" name="content" class="form-control form-control-sm"></textarea>

                            </div>
                            <div class="form-group">
                                <input type="submit"  class="btn btn-primary" value="Thêm" />
                            </div>
                        </form>
                  </div>


                            <div class="card">
                                <div class="card-body">

                                    <h4>Danh sách Ghi Chú</h4>

                                    @foreach ($AllNoteById as $item)
                                    <div class="display-comment">
                                          <?php
                                                echo '<div class="display-comment" style="background-color: #E0D486">
                                                        <strong>
                                                        '.$item->created_by. '--'. $item->created_at .'
                                                        </strong>
                                                        <p>'.$item->content.'</p>
                                                        </div>
                                                    ';
                                          ?>

                                        </div>
                                    @endforeach



                                </div>
                            </div>
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
    if(notifi != null){
        var notification = alertify.notify(notifi, 'success', 5, function(){  console.log('dismissed'); });
    }

</script>
@endsection

