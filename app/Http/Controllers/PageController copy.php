<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customization;
use App\Bills;
use App\BillDetail;
use App\BillDetailOption;
use App\Customer;
use App\RoleUser;
use Validator;
use Illuminate\Support\Facades\Input;

use Cart;

class PageController extends Controller
{
    function test()
    {
        return Product::where('id', 119)->with('Customization.Option')->get();
        return Product::with('Customization.Option')->get();
        $u = Customization::with('Product')->get();

        return $u;
    }

    function gethome()
    {
        $product = Product::where('deleted', 0)->with('Customization.Option')->get();
        // $product = $product[0];
        return view('frontend.page.home', compact('product'));
    }

    function cart()
    {
        return view('frontend.page.cart');
    }

    function checkout()
    {
        return view('frontend.page.checkout');
    }

    function gethome01()
    {
        $product = Product::with('Customization.Option')->get();
        // $product = $product[0];
        return view('frontend.main01', compact('product'));
    }

    function main1product(Request $req)
    {
        // $product = Product::where('id', $req->id)->with('Customization.Option')->get()[0];
        $product = Product::where('id', $req->id)->with('Customization.CustomizationOption.Option')->get()[0];
        $data = [
            'code' => 200,
            'data' => $product
        ];
        return $data;
    }

    function addtocart(Request $req)
    {
        // Cart::clear();   
        if ($req->action == 'delete') {
            // $userId = auth()->user()->id; 
            // Cart::session($userId)->remove($req->idSP);
            Cart::remove($req->idSP);
            $data = [
                'quantity' => Cart::getTotalQuantity(), 'total' => number_format(Cart::getTotal())
            ];
            return $data;
        }
        $optioncheck = $req->optionsCheck;

        // $product = Product::where('id', 117)->with('Customization.Option')->get()[0]->toArray();
        $product = Product::where('id', $req->id)->with('Customization.Option')->get()[0]->toArray();

       
        $price = $product['price'];
        $id = $req->id . 'product';
        if ($optioncheck) {
            foreach ($product['customization'] as $key => $value) {
                $cus = 0;
                // print_r($value['option']);
                foreach ($value['option'] as $keyoption => $valueoption) {
                    $opt = 0;
                    foreach ($optioncheck as $keyoptioncheck => $valueoptioncheck) {
                        if ($valueoption['id'] == $valueoptioncheck) {
                            // return $valueoption['id'];
                            $opt = 1;
                            $cus = 1;
                            $price += $valueoption['price'];
                            $id .= $valueoptioncheck . '-';
                        }
                    }
                    if ($opt != 1) {
                        array_splice($product['customization'][$key]['option'], $keyoption, 1);
                    }
                }
                if ($cus != 1) {
                    array_splice($product['customization'], $key, 1);
                }
            }
        } else {
            $product['customization'] =[];
            // foreach ($product['customization'] as $key => $value) {
            //     array_splice($product['customization'], $key, 1);
            // }
            // if(($product['customization']))
            // array_splice($product, -1, 1);  if(isset($product['customization']))
        }

        $add = Cart::add([
            'id' => $id,
            'name' => $product['name'],
            'quantity' => 1,
            'price' => $price,
            'attributes' => $product
        ]);
        if ($add) {
            $data = [
                'quantity' => Cart::getTotalQuantity(), 'total' => number_format(Cart::getTotal())
            ];
            // if (!empty($req->qty)) {
            //     return redirect()->route('giohang');
            // }
            return redirect('cart');
        }
        return "thất bại";
        // return $product;
        //       return response()->json($product);
        //     return $product->customization;
        //     return  $req->optionsCheck;
    }

    function getcart()
    {
        return Cart::getContent();
    }

    function dathang(Request $req)
    {
        // email tên địa chỉ  sđt  note
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
        );
        $messages = ([
            'email.required' => 'Email là bắt buộc',
            'name.required' => 'Tên là bắt buộc',
            'address.required' => 'Địa chỉ là bắt buộc',
            'phone.required' => 'Số điện thoại là bắt buộc',
        ]);
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return $validator->errors();
            // return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
        }
        try {
            $Customer = new Customer();
            $idCus = $Customer->insertGetId([
                'name' => $req->name,
                'email' => $req->email,
                'address' => $req->address,
                'phone' => $req->phone,
            ]);

            $Bills = new Bills();
            $idBill =  $Bills->insertGetId([
                'customer_id' => $idCus,
                'total' => Cart::getTotal(),
                'note' => $req->note,
            ]);

            $BillDetail = new BillDetail();
            foreach (Cart::getcontent() as $key => $valuecart) {
                $idBillDetail = $BillDetail->insertGetId([
                    'bill_id' => $idBill,
                    'product_id' => $valuecart->attributes->id,
                    'quantity' => $valuecart->quantity,
                    'price' => $valuecart->attributes->price * $valuecart->quantity,
                ]);
                if ($valuecart->attributes->customization) {
                    foreach ($valuecart->attributes->customization as $key => $valuecustomization) {
                        $BillDetailOption = new BillDetailOption();
                        foreach ($valuecustomization['option'] as $key => $value) {
                            $query = $BillDetailOption->insert([
                                'bill_detail_id' => $idBillDetail,
                                'option_id' => $value['id'],
                            ]);
                        }
                    }
                }
            }
            Cart::clear();
            // return redirect('donhang')->with('status', "Đặt hàng thành công");
            return redirect('/')->with('status', "Đặt hàng thành công");
        } catch (\Exception $e) {
            return $e;
            // return redirect()->back()->withErrors("Xảy ra lỗi trong quá trình xử lý")->withInput(Input::all());
        }
    }
}
