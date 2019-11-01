<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Yajra\DataTables\DataTables;
use App\ProductType;
use Session;
use App\Accessories;
use App\ListAccessories;
use App\Bills;
use App\BillDetail;
use Cart;
use App\BillAdmin;
use App\BillDetailAdmin;
use Carbon\Carbon;
use Auth;
use Validator;
use App\Customer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;

session_start();
class CartController extends Controller
{
    // admin
    public function GetAllBill()
    {
        $titleheader = 'Quản Lí Đơn hàng';
        $boxtitle = 'Danh Sách Đơn Hàng ';
        $Bills = Bills::orderby('status', 'asc')
            ->orderby('created_at', 'desc')->get();
        return view('backend.page.bill', compact('titleheader', 'boxtitle', 'Bills'));
    }

    public function GetBillDetail($id)
    {
        $titleheader = 'Quản Lí Đơn hàng';
        $boxtitle = 'Chi Tiết Đơn Hàng';
        $billDetail = BillDetail::where('bill_id', $id)->get();
        $bill = Bills::find($id);
        $Customer = Customer::find($bill->customer_id);
        return view('backend.page.billdetail', compact('titleheader', 'boxtitle', 'billDetail', 'bill', 'Customer'));
    }

    public function ProcessBill($id)
    {
        $bill = Bills::find($id);
        $bill->status = 1;
        $bill->save();
        Session::put('message', 'Tiếp nhận đơn hàng thành công');
        return Redirect::to('view-bill');
    }

    public function SuccessBill($id)
    {
        $bill = Bills::find($id);
        $bill->status = 2;
        $bill->save();
        Session::put('message', 'đơn hàng này đã hoàng tất');
        return Redirect::to('view-bill');
    }

    public function DeleteBill($id)
    {
        BillDetail::where('bill_id', $id)->delete();
        Bills::destroy($id);
        Session::put('message', 'đơn hàng này đã được xóa');
        return Redirect::to('view-bill');
    }


    public function CreateBill()
    {
        $titleheader = 'Quản Lí Đơn hàng';
        $boxtitle = 'Tạo đơn hàng trực tiếp ';
        $Products = Product::all();
        $Accessories = Accessories::all();
        return view('backend.page.createbill', compact('titleheader', 'boxtitle', 'Products', 'Accessories'));
    }
    //client
    public function SaveCart($productId, Request $req)
    {

        $pro = Product::find($productId);




        Cart::add(array(
            'id' => $pro->id,
            'name' => $pro->name,
            'price' => $pro->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $pro->image
            )
        ));
        $NhomPk = ListAccessories::where('id', $pro->accessory_group_id);
        if (!$pro->accessory_group_id) {
            $AccessoriesId = ListAccessories::where('accessories_group_id', $pro->accessory_group_id)->get('accessories_id');
            if ($AccessoriesId) {
                foreach ($AccessoriesId as $key => $id) {
                    # code...
                    $Accessory = Accessories::find($id);
                    Cart::add(array(
                        'id' => $Accessory->id,
                        'name' => $Accessory->name,
                        'price' => $Accessory->price,
                        'quantity' => 1,
                        'attributes' => array(
                            'image' => $Accessory->image
                        )
                    ));
                }
            }
        }
        $arrayIdAccessories = $req->input('options');
        if ($arrayIdAccessories) {
            foreach ($arrayIdAccessories as $key => $id) {
                # code...
                $Accessory = Accessories::find($id);
                Cart::add(array(
                    'id' => $Accessory->id,
                    'name' => $Accessory->name,
                    'price' => $Accessory->price,
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $Accessory->image
                    )
                ));
            }
        }
        Session::put('message', 'Thêm Sản Phẩm thành công');
        return Redirect::to('/');
    }

    public function SaveCartAccessories($id)
    {
        $Accessory = Accessories::find($id);
        Cart::add(array(
            'id' => $Accessory->id,
            'name' => $Accessory->name,
            'price' => $Accessory->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $Accessory->image
            )
        ));
        return Redirect::to('show-cart');
    }

    public function ShowCart()
    {
        return view('frontend.page.showcart');
    }

    public function DeleteCart($id)
    {
        Cart::remove($id);
        return Redirect::to('show-cart');
    }

    public function ClearCart()
    {
        Cart::clear();

        return Redirect::to('/');
    }


    public function SaveCartProduct($productId)
    {
        $pro = Product::find($productId);
        Cart::add(array(
            'id' => $pro->id,
            'name' => $pro->name,
            'price' => $pro->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $pro->image
            )
        ));
        return Redirect::to('show-cart');
    }
    public function CheckOut(Request $req)
    {

        $customer = new Customer;
        $customer->name = $req->firstName . ' ' . $req->lastName;
        $customer->phone = $req->phone;
        $customer->address = $req->address;
        $customer->email = $req->email;
        $customer->phone1 = $req->phone1;
        $customer->save();

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $bill = new Bills;
        $bill->customer_id = $customer->id;
        $bill->created_at = date('Y-m-d H:i:s');
        $bill->total = Cart::getTotal();
        $bill->status = 0;
        $bill->save();

        $items = Cart::getContent();
        foreach ($items as $item) {
            $billDetail = new BillDetail;
            $billDetail->bill_id = $bill->id;
            $billDetail->product_id = $item->id;
            $billDetail->quantity = $item->quantity;
            $billDetail->price = $item->price;
            $billDetail->save();
        }
        Cart::clear();
        Session::put('message', 'Quí Khách Đã Đặt Hàng thành công, Chúng tôi sẽ liên lạc sớm nhất với quí khách');
        return Redirect::to('/');
    }

    public function CreateBillAdmin($idCustomer)
    {
        $Customer = Customer::find($idCustomer);
        Session::put('idCustomer', $idCustomer);
        $titleheader = 'Quan lý khách hàng';
        $boxtitle = 'tạo đơn hàng cho: ' . $Customer->name;
        $Products = Product::where('accessory_group_id', '!=', null)->get();
        $Totals = array();
        foreach ($Products as $key => $product) {
            # code...
            $total = $product->price;
            $AccessoriesId = ListAccessories::where('accessories_group_id', $product->accessory_group_id)
                ->get('accessories_id');
            $Accessories = Accessories::where('is_obligatory', 1)
                ->whereIn('id', $AccessoriesId)->get();
            foreach ($Accessories as $key => $value) {
                $total += $value->price;
            }
            array_push($Totals, $total);
        }
        $accessories = Accessories::get();
        $Productsss = Product::where('accessory_group_id', '=', null)->get();
        return view('backend.page.craete_bill_admin', compact('titleheader', 'Totals', 'boxtitle', 'Products', 'accessories', 'Productsss', 'idCustomer'));
    }


    public function AddKitCartAdmin($id, Request $req)
    {
        if ($req->qty < 1 || $req->qty == null) {
            Session::put('message', 'Số lượng sản phẩm không hợp lệ');
            return Redirect::to('create-bill-admin/' . $req->idCustomer);
        }
        $Product = Product::find($id);
        Cart::add(array(
            'id' => $Product->id,
            'name' => $Product->name,
            'price' => $Product->price,
            'quantity' => $req->qty,
            'attributes' => array(
                'image' => $Product->image
            )
        ));

        $AccessoriesId = ListAccessories::where('accessories_group_id', $Product->accessory_group_id)->get('accessories_id');
        $Accessories = Accessories::where('is_obligatory', 1)
            ->whereIn('id', $AccessoriesId)->get();

        if ($Accessories) {
            foreach ($Accessories as $key => $value) {
                # code...

                Cart::add(array(
                    'id' => $value->id,
                    'name' => $value->name,
                    'price' => $value->price,
                    'quantity' => $req->qty,
                    'attributes' => array(
                        'image' => $value->image
                    )
                ));
            }
        }

        Session::put('message', 'Thêm vào giỏ hàng thành công');
        return Redirect::to('create-bill-admin/' . $req->idCustomer);
    }

    public function AddProductCartAdmin($id, Request $req)
    {
        if ($req->qty < 1 || $req->qty == null) {
            Session::put('message', 'Số lượng sản phẩm không hợp lệ');
            return Redirect::to('create-bill-admin/' . $req->idCustomer);
        }
        $Product = Product::find($id);
        Cart::add(array(
            'id' => $Product->id,
            'name' => $Product->name,
            'price' => $req->price,
            'quantity' => $req->qty,
            'attributes' => array(
                'image' => $Product->image
            )
        ));
        Session::put('message', 'Thêm vào giỏ hàng thành công');
        return Redirect::to('create-bill-admin/' . $req->idCustomer);
    }
    public function AddAccessoriesCartAdmin($id, Request $req)
    {
        if ($req->qty < 1 || $req->qty == null) {
            Session::put('message', 'Số lượng sản phẩm không hợp lệ');
            return Redirect::to('create-bill-admin/' . $req->idCustomer);
        }
        $Accessories = Accessories::find($id);
        Cart::add(array(
            'id' => $Accessories->id,
            'name' => $Accessories->name,
            'price' => $Accessories->price,
            'quantity' => $req->qty,
            'attributes' => array(
                'image' => $Accessories->image
            )
        ));
        Session::put('message', 'Thêm vào giỏ hàng thành công');
        return Redirect::to('create-bill-admin/' . $req->idCustomer);
    }

    public function ShowCartAdmin($idCustomer)
    {
        $Customer = Customer::find($idCustomer);
        $titleheader = 'Quan lý khách hàng';
        $boxtitle = 'tạo đơn hàng cho: ' . $Customer->name;
        return view('backend.page.show_cart_admin', compact('titleheader', 'boxtitle'));
    }

    public function SaveCartAdmin($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $bill = new BillAdmin;
        $bill->customer_id = $id;
        $bill->created_at     = date('Y-m-d H:i:s');
        $bill->total_price = Cart::getTotal();

        $bill->save();

        $items = Cart::getContent();
        foreach ($items as $item) {
            $billDetail = new BillDetailAdmin;
            $billDetail->bill_id = $bill->id;
            $billDetail->product_id = $item->id;
            $billDetail->quantity = $item->quantity;
            $billDetail->price = $item->price;
            $billDetail->save();
        }

        Cart::clear();
        Session::put('message', 'Tạo đơnhàng thành công');
        return Redirect::to('viewcusaccount');
    }

    public function DeleteCartAdmin($id)
    {
        Cart::remove($id);
        //Session::put('idCustomer', null);
        return Redirect::to('show-cart-admin/' . Session::get('idCustomer'));
    }


    public function CreateBillNow()
    {
        $titleheader = 'Tạo Đơn Hàng';
        $boxtitle = '';
        $Products = Product::where('accessory_group_id', '!=', null)->get();
        $Totals = array();
        foreach ($Products as $key => $product) {
            # code...
            $total = $product->price;
            $AccessoriesId = ListAccessories::where('accessories_group_id', $product->accessory_group_id)
                ->get('accessories_id');
            $Accessories = Accessories::where('is_obligatory', 1)
                ->whereIn('id', $AccessoriesId)->get();
            foreach ($Accessories as $key => $value) {
                $total += $value->price;
            }
            array_push($Totals, $total);
        }
        $accessories = Accessories::get();
        $Productsss = Product::where('accessory_group_id', '=', null)->get();
        return view('backend.page.craete_bill_admin_now', compact('titleheader', 'Totals', 'boxtitle', 'Products', 'accessories', 'Productsss'));
    }

    public function SearchKitNow(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $Products = DB::table('products')->where('accessory_group_id', '!=', null)
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->orderby('name', 'desc')->get();
            $Totals = array();
            foreach ($Products as $key => $product) {
                # code...
                $total = $product->price;
                $AccessoriesId = ListAccessories::where('accessories_group_id', $product->accessory_group_id)
                    ->get('accessories_id');
                $Accessories = Accessories::where('is_obligatory', 1)
                    ->whereIn('id', $AccessoriesId)->get();
                foreach ($Accessories as $key => $value) {
                    $total += $value->price;
                }
                array_push($Totals, $total);
            }
            if ($Products) {

                foreach ($Products as $key => $pro) {



                    // $arrlink =  '<a href="{{URL::to('."'/edit-customer/'".$customer->customer_id.')}}"><i style="color: green; margin: 5px;" class="far fa-edit"></i></a>';
                    $output .= '<tr>

                        <td  class="align-middle">' . $key . '</td>
                        <td  class="align-middle">' . $pro->name . '</td>
                        <td  class="align-middle">' . number_format($Totals[$key])  . ' VNĐ' . '</td>
                        <td  class="align-middle"><img style="width: 75px; height: 75px" src="source/images/' . $pro->image . '"/></td>
                        <td  class="align-middle">
                            <div class="form-group ">

                                <form action="' . url("add-kit-cart-admin/{$pro->id}") . '" method="post">
                                    ' . csrf_field() . '
                                   <input hidden type="text" name="total" value="' . $Totals[$key] . '">
                                   <input hidden type="text" name="idCustomer" value="' . $request->idCustomer . '">
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
                            </div>
                        </td >
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function SearchProductNow(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $Products = DB::table('products')->where('accessory_group_id', null)
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->orderby('name', 'desc')->get();
            if ($Products) {
                foreach ($Products as $key => $pro) {
                    // $arrlink =  '<a href="{{URL::to('."'/edit-customer/'".$customer->customer_id.')}}"><i style="color: green; margin: 5px;" class="far fa-edit"></i></a>';
                    $output .= '<tr>

                        <td  class="align-middle">' . $key . '</td>
                        <td  class="align-middle">' . $pro->name . '</td>
                        <td  class="align-middle">' . number_format($pro->price)  . ' VNĐ' . '</td>
                        <td  class="align-middle"><img style="width: 75px; height: 75px" src="source/images/' . $pro->image . '"/></td>
                        <td  class="align-middle">
                            <div class="form-group ">
                                <form action="' . url("add-product-cart-admin/{$pro->id}") . '" method="post">
                                    ' . csrf_field() . '

                                   <input hidden type="text" name="idCustomer" value="' . $request->idCustomer . '">
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
                            </div>
                        </td >
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function SearchAccessoriesNow(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $Accessories = DB::table('accessories')
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->orderby('name', 'desc')->get();
            if ($Accessories) {
                foreach ($Accessories as $key => $Accessory) {
                    $output .= '<tr>
                                    <td>' . $key . '</td>
                                        <td>' . $Accessory->name . '</td>
                                        <td>' . number_format($Accessory->price) . ' VNĐ' . '</td>
                                        <td  class="align-middle"><img style="width: 75px; height: 75px" src="source/images/' . $Accessory->image . '"/></td>
                                        <td>
                                            <form action="' . url("add-accessories-to-cart/{$Accessory->id}") . '" method="post">
                                                ' . csrf_field() . '
                                                <input hidden type="text" class="idCustomer" name="idCustomer"
                                                    value="' . $request->idCustomer . '">
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

                    ';
                }
            }
            return Response($output);
        }
    }

    public function AddKitCartAdminNow($id, Request $req)
    {
        if ($req->qty < 1 || $req->qty == null) {
            Session::put('message', 'Số lượng sản phẩm không hợp lệ');
            return Redirect::to('create-bill-admin-now/' . $req->idCustomer);
        }
        $Product = Product::find($id);
        Cart::add(array(
            'id' => $Product->id,
            'name' => $Product->name,
            'price' => $Product->price,
            'quantity' => $req->qty,
            'attributes' => array(
                'image' => $Product->image
            )
        ));

        $AccessoriesId = ListAccessories::where('accessories_group_id', $Product->accessory_group_id)->get('accessories_id');
        $Accessories = Accessories::where('is_obligatory', 1)
            ->whereIn('id', $AccessoriesId)->get();

        if ($Accessories) {
            foreach ($Accessories as $key => $value) {
                # code...

                Cart::add(array(
                    'id' => $value->id,
                    'name' => $value->name,
                    'price' => $value->price,
                    'quantity' => $req->qty,
                    'attributes' => array(
                        'image' => $value->image
                    )
                ));
            }
        }

        Session::put('message', 'Thêm vào giỏ hàng thành công');
        return Redirect::to('create-bill-admin-now');
    }

    public function AddProductCartAdminNow($id, Request $req)
    {
        if ($req->qty < 1 || $req->qty == null) {
            Session::put('message', 'Số lượng sản phẩm không hợp lệ');
            return Redirect::to('create-bill-admin-now');
        }
        $Product = Product::find($id);
        Cart::add(array(
            'id' => $Product->id,
            'name' => $Product->name,
            'price' => $req->price,
            'quantity' => $req->qty,
            'attributes' => array(
                'image' => $Product->image
            )
        ));
        Session::put('message', 'Thêm vào giỏ hàng thành công');
        return Redirect::to('create-bill-admin-now/');
    }
    public function AddAccessoriesCartAdminNow($id, Request $req)
    {
        if ($req->qty < 1 || $req->qty == null) {
            Session::put('message', 'Số lượng sản phẩm không hợp lệ');
            return Redirect::to('create-bill-admin-now/' . $req->idCustomer);
        }
        $Accessories = Accessories::find($id);
        Cart::add(array(
            'id' => $Accessories->id,
            'name' => $Accessories->name,
            'price' => $Accessories->price,
            'quantity' => $req->qty,
            'attributes' => array(
                'image' => $Accessories->image
            )
        ));
        Session::put('message', 'Thêm vào giỏ hàng thành công');
        return Redirect::to('create-bill-admin-now/');
    }
    public function ShowCartAdminNow()
    {
        $titleheader = 'Tạo đơn hàng trực tiếp';
        return view('backend.page.show_cart_admin_now', compact('titleheader'));
    }

    public function SaveCartAdminNow(Request $req)
    {
        $Customer = new Customer;
        $Customer->name = $req->name;
        $Customer->phone = $req->phone;
        $Customer->address = $req->address;

        $Customer->save();

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $bill = new BillAdmin;
        $bill->customer_id = $Customer->id;
        $bill->created_at     = date('Y-m-d H:i:s');
        $bill->total_price = Cart::getTotal();

        $bill->save();

        $items = Cart::getContent();
        foreach ($items as $item) {
            $billDetail = new BillDetailAdmin;
            $billDetail->bill_id = $bill->id;
            $billDetail->product_id = $item->id;
            $billDetail->quantity = $item->quantity;
            $billDetail->price = $item->price;
            $billDetail->save();
        }

        Cart::clear();
        Session::put('message', 'Tạo đơn hàng thành công');
        return Redirect::to('viewcusaccount');
    }

    public function DeleteCartAdminNow($id)
    {
        Cart::remove($id);
        //Session::put('idCustomer', null);
        return Redirect::to('show-cart-admin-now/');
    }
}
