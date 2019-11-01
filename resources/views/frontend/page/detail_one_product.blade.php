@extends('layouts.app')
@section('content')
<div class="album py-5 bg-light">

    <div class="container">
        <div><h4>Thông Tin Về Sản Phẩm</h4></div>
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

                <a href="{{URL::to('add-to-carrt-product/'.$Product->id)}}"><button type="button" class="btn btn-primary">Thêm Vào Giỏ hàng</button></a>
                </div>
            </div>
        </div>
@endsection
