@extends('layouts.app')
@section('content')
<div class="album py-5 bg-light">
    <?php
            $cartCollection = Cart::getContent();
        ?>
    <div class="container">
        <div class="py-5 text-center">

            <h2>Thanh Toán</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Giỏ Hàng của bạn</span>
                    <span class="badge badge-secondary badge-pill">{{$cartCollection->count()}}</span>
                </h4>
                <ul class="list-group mb-3">

                    @foreach ($cartCollection as $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$item->name}}</h6>
                            <small class="text-muted">Số lượng: {{$item->quantity}}</small>
                        </div>
                        <div>
                        </div>
                        <span class="text-muted">{{number_format($item->price * $item->quantity) . ' VNĐ'}}</span>
                        <a href="{{URL::to('delete-cart/'.$item->id)}}"><i class="fa fa-trash"
                                style="color: red"></i></a>
                    </li>
                    @endforeach
                    <div class="pt-4">
                        <span>TỔNG (vnđ):</span>
                        <strong>{{number_format(Cart::getTotal()) . ' VNĐ'}}</strong>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-4">
                        <a href="{{URL::to('clear-cart')}}"><button type="button" class="btn btn-danger btn-sm">Xóa giỏ hàng</button></a>
                        </div>

                    </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Thông tin khách hàng</h4>
            <form  data-toggle="validator"    role="form" action="{{URL::to('check-out')}}" method="POST"
                    >
                    {{  csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Họ và tên đệm</label>
                            <input type="text" name="firstName" class="form-control" required data-error="Vui lòng nhập họ và tên đệm" >
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Tên</label>
                            <input type="text" class="form-control" name="lastName" required data-error="Vui lòng nhập tên" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username">Số Điện Thoại 1</label>
                        <div class="input-group">

                            <input type="text" name="phone" class="form-control" required data-error="Vui lòng nhập SĐT" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username">Số điện thoại 2(nếu có)</label>
                        <div class="input-group">

                            <input type="text" name="phone1" class="form-control">

                        </div>
                    </div>
                </div>

                    <div class="mb-3">
                        <label for="address">Địa Chỉ Giao Hàng</label>
                        <input type="text" class="form-control" name="address" required data-error="Vui lòng nhập Địa chỉ giao hàng"
                            placeholder="số nhà - tên đường - tên quận Huyện"  >
                            <div class="help-block with-errors"></div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Email (nếu có)</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="Email"  >

                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Gửi thông tin để được tư vấn</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1"> Motor Cong</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>

    @endsection
