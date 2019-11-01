@extends('layouts.app')
@section('content')
<div class="album py-5 bg-light">

    <div class="container">
        <div class="row">
            <div class=" col-md-4 card-deck mb-3 text-center">
                <div class="card mb-4 shadow-sm">
                    <img width="300px" height="300px" src="{{asset('source/images/'.$Product->image)}}"
                        alt="{{$Product->name}}" srcset="">

                </div>
            </div>

            <div class="col-md-8 mb-3">
                <div class="header-product">
                    <h4>{{$Product->name}}</h4>
                </div>
                <div class="title">
                    <p>
                        {{$Product->detail}}
                    </p>
                    <p>Giá:<span>{{number_format($Product->price) . ' VNĐ'}}</span></p>
                    <!--
                                        <a href={URL::to('add-tocarrt')}}"><button type="button" class="btn btn-primary">Thêm Vào Giỏ hàng</button></a>
                                            -->
                </div>
            </div>
        </div>
        <div>
            <h4>Phụ kiện Theo Sản Phẩm</h4>
        </div>
        <div class="row">
            @foreach ($accessories as $item)
            <div class="col-md-3">
                <div class="card mb-3 shadow-sm">

                    <img width="auto" height="253px" src="{{asset('source/images/'.$item->image)}}"
                        alt="{{$item->name}}" srcset="">
                    <div class="card-body">
                        <p class="card-text">{{$item->name}}</p>
                        <div>
                            {{number_format($item->price) . ' VND'}}
                        </div>
                        <div class="d-flex justify-content-between align-items-center">

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>
            <h4>Phụ kiện tùy chọn</h4>
        </div>
        <form action="{{URL::to('add-tocarrt/'.$Product->id)}}" method="post">
            {{ csrf_field() }}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Check</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Giá</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($optonCustom as $item)
                    <tr>
                        <th scope="row">
                            <input type="checkbox" data-id="{{$item->price}}" name="options[]" value="{{$item->id}}">
                        </th>
                        <td>{{$item->name}}</td>

                        <td><img src="{{asset('source/images/'.$item->image)}}" height="75" width="75" /></td>
                        <td>{{number_format($item->price) . ' VNĐ'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <p>Tổng tiền: <input id="totalPrice" style="border: hidden; background-color: #f8fafc; width: 8%"
                type="text" name="abc" value="{{$totalPrice}}" readonly> VNĐ</p>
                <button type="submit" class="btn btn-primary">Thêm Vào Giỏ hàng</button>
        </form>

    </div>

</div>

@endsection
