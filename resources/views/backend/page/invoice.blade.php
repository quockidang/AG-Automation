<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>

    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
    <style>
        body {
            font-family: DejaVu Sans;
        }

        .invoice-head td {
            padding: 0 8px;
        }

        .container {
            padding-top: 30px;
        }

        .invoice-body {
            background-color: transparent;
        }

        .invoice-thank {
            margin-top: 60px;
            padding: 5px;
        }

        address {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="span8">
                <img src="https://www.motorcong.com/image/data/logo/AG Logo-1.jpg" style="width: 20%; height: 20%"
                    class="img-rounded logo">
                <address>
                    <strong>CÔNG TY TNHH SX & TM AG AUTOMATION</strong><br>
                    Địa chỉ: 38 Đường 447, Kp.2, P.Tăng Nhơn Phú A , Q.9, TP.HCM<br>
                    Showroom: 870 XLHN, P.Hiệp Phú, Q.9, TP.HCM<br>
                    Mail: motorcong.com@gmail.com<br>
                    Điện thoại: 0969 029 779 - 090 378 5567<br>
                </address>
            </div>
            <div class="span4">
                <address>
                <strong>Khách hàng: {{$Customer->name}}</strong><br>
                    Địa chỉ:  {{$Customer->address}}<br>
                    Phone:  {{$Customer->phone}}<br>
                    Ngày mua hàng:  {{$Bill->created_at}}<br>

                </address>
            </div>
        </div>
        <div class="row">
            <div class="span8">
                <h2>Invoice</h2>
            </div>
        </div>
        <div class="row">
            <div class="span8 well invoice-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Bảo hành</th>
                            <th>số lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($BillDetails as $item)
                        <tr>
                            <?php
                                $pro = App\Product::find($item->product_id);
                                if(!$pro){
                                    $pro = App\Accessories::find($item->product_id);
                                }
                            ?>


                            <td>{{$pro->name}}</td>
                            <td><img style="width: 100%" src="{{asset('source/images/'. $pro->image)}}" alt=""></td>
                            <td>{{$pro->warranty}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{number_format($pro->price) . ' VNĐ'}}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td>&nbsp;</td>
                            <td><strong>Tổng</strong></td>
                            <td><strong>{{number_format($Bill->total_price) . ' VNĐ'}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="span8 well invoice-thank">
                <h5>
                    <p style="text-align:center;"> Cám ơn quí khách</p>
                </h5>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>

</html>
