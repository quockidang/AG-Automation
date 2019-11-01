@extends('layouts.app')
@section('content')
<div class="album py-5 bg-light">
    <div class="container">
            <div>
                    <h4>Danh sách Bộ Kit</h4>
                </div>
      <div class="row">
          @foreach ($Products as $item)
          <div class="col-md-4">
                <div class="card mb-4 shadow-sm">

                <img width="300px" height="300px" src="{{asset('source/images/'.$item->image)}}" alt="{{$item->name}}" srcset="">
                  <div class="card-body">
                  <p class="card-text">{{$item->name}}</p>
                  <p>Phụ kiện kèm theo</p>
                  <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">


                  <?php
                        $AccressoriesID = App\ListAccessories::where('accessories_group_id', $item->accessory_group_id)->get('accessories_id');
                        $accessories = App\Accessories::whereIn('id', $AccressoriesID)
                                    ->get();

                       foreach ($accessories as $key => $value) {
                           # code...
                           //echo '<p class="pl-2" id="list-item-1">'.$value->name.'</p> ';
                            echo $value->name . '. ';
                       }
                    ?>
                     </div>
                    <div>
                        {{number_format($item->price) . ' VND'}}
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <a href="{{URL::to('/view-detail/'.$item->id)}}"><button type="button" class="btn btn-sm btn-outline-secondary">Xem Chi Tiết</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          @endforeach

    </div>

    <div>
            <h4>Danh sách Sản Phẩm Rời</h4>
        </div>
<div class="row">
  @foreach ($Productsss as $item)
  <div class="col-md-4">
        <div class="card mb-4 shadow-sm">

        <img width="300px" height="300px" src="{{asset('source/images/'.$item->image)}}" alt="{{$item->name}}" srcset="">
          <div class="card-body">
          <p class="card-text">{{$item->name}}</p>

            <div>
                {{number_format($item->price) . ' VND'}}
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                    <a href="{{URL::to('add-to-carrt-product/'.$item->id)}}"><button type="button" class=" m-1 btn btn-sm btn-primary">Thêm Vào Giỏ hàng</button></a>
              <a href="{{URL::to('/view-detail-one-product/'.$item->id)}}"><button type="button" class="btn btn-sm btn-outline-secondary">Xem Chi Tiết</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endforeach

</div>

    <div>
            <h4>Danh sách phụ kiện</h4>
    </div>
    <div class="row">
            @foreach ($Accressories as $item)
            <div class="col-md-3">
                  <div class="card mb-3 shadow-sm">

                  <img width= "auto"
                  height="225px" src="{{asset('source/images/'.$item->image)}}" alt="{{$item->name}}" srcset="">
                    <div class="card-body">
                    <p class="card-text">{{$item->name}}</p>
                      <div>
                          {{number_format($item->price) . ' VND'}}
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                                <a href="{{URL::to('add-to-carrt/'.$item->id)}}"><button type="button" class=" m-1 btn btn-sm btn-primary">Thêm Vào Giỏ hàng</button></a>
                        <a href="{{URL::to('/view-detail-accessories/'.$item->id)}}"><button type="button" class="m-1 btn btn-sm btn-outline-secondary">Xem Chi Tiết</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach

      </div>
  </div>
  <?php
  $mess = Session::get('message');
  if($mess){
      echo '<input class="message" type="text" hidden value="'.$mess.'"/>';
      Session::put('message', null);
  }

  ?>
@endsection
@section('scriptclient')
<script>
var notifi = $('.message').val();
if(notifi != null){
    var notification = alertify.notify(notifi, 'success', 5, function(){  console.log('dismissed'); });
}

</script>
@endsection
