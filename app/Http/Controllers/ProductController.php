<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

use App\ProductType;
use Session;
use App\Accessories;
use App\ListAccessories;
use App\AccessoryGroup;
use App\BillDetailAdmin;
use Carbon\Carbon;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;

session_start();
class ProductController extends Controller
{
    function viewproduct()
    {
        $titleheader = "Sản phẩm";
        $boxtitle = "Quản lý sản phẩm";
        $Products = Product::all();
        return View('backend.page.product', compact('titleheader', 'boxtitle', 'Products'));
    }

    function viewtypeproduct()
    {
        $titleheader = "Loại sản phẩm";
        $boxtitle = "Quản lý loại sản phẩm";
        return View('backend.page.typeproduct', compact('titleheader', 'boxtitle'));
    }

    function viewaddproduct(Request $req)
    {
        $titleheader = "Sản Phẩm";
        $boxtitle = "Thêm sản phẩm";
        $Categorys = ProductType::all();
        $AccessoriesGroup = AccessoryGroup::all();
        return View('backend.page.addproduct', compact('titleheader', 'boxtitle', 'Categorys', 'AccessoriesGroup'));
    }
    public function submitaddproduct(Request $req)
    {
        $productAdd = new Product;
        $productAdd->id_type = $req->id_type;
        $productAdd->name = $req->name;
        $productAdd->price = $req->price;
        $productAdd->detail = $req->detail;
        $productAdd->detail_descrip = $req->detail_descrip;
        $productAdd->warranty = $req->warranty;
        $productAdd->accessory_group_id = $req->accessory_group_id;
        $get_image = $req->file('image');

        $name_image = current(explode('.', $get_image->getClientOriginalName()));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move('source/images', $new_image);
        $productAdd->image = $new_image;
        $productAdd->save();
        Session::put('message', 'Thêm sản phẩm  thành công');
        return Redirect::to('viewproduct');
    }

    function getproduct($pro_id)
    {
        $titleheader = 'Sản phẩm';
        $productModel = Product::find($pro_id);
        $productCategory = ProductType::find($productModel->id_type);
        $boxtitle = 'Chi tiết sản phẩm: ' . $productModel->name;
        $AccessoriesGroup = AccessoryGroup::find($productModel->accessory_group_id);
        return view('backend.page.detailproduct', compact('titleheader', 'boxtitle', 'productCategory', 'productModel', 'AccessoriesGroup'));
    }

    public function editproduct($productId)
    {
        $titleheader = 'Sản phẩm';
        $productModel = Product::find($productId);
        $productCategories = ProductType::all();
        $boxtitle = 'Chỉnh sửa sản phẩm: ' . $productModel->name;
        $AccessoriesGroup = AccessoryGroup::all();
        return view('backend.page.editproduct', compact('titleheader', 'boxtitle', 'productCategories', 'productModel', 'AccessoriesGroup'));
    }

    public function submiteditproduct(Request $req, $productId)
    {
        $productAdd = Product::find($productId);

        $productAdd->id_type = $req->id_type;
        $productAdd->name = $req->name;
        $productAdd->price = $req->price;
        $productAdd->detail = $req->detail;
        $productAdd->detail_descrip = $req->detail_descrip;

        $productAdd->accessory_group_id = $req->accessory_group_id;
        $get_image = $req->file('image');
        if ($get_image) {
            $name_image = current(explode('.', $get_image->getClientOriginalName()));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('source/images', $new_image);
            $productAdd->image = $new_image;
            $productAdd->save();
            Session::put('message', 'Update sản phẩm  thành công');
            return Redirect::to('viewproduct');
        } else {
            $productAdd->save();
            Session::put('message', 'Update sản phẩm  thành công');
            return Redirect::to('viewproduct');
        }
    }

    public function deleteproduct($productId)
    {
        $pro = BillDetailAdmin::where('product_id', $productId)->first();
        if($pro)
        {
            Session::put('message', 'Xóa sản phẩm thaatsa bại vì sản phẩm còn nằm trong đơn hàng');
        return Redirect::to('viewproduct');
        }
        Product::destroy($productId);
        Session::put('message', 'Xóa sản phẩm  thành công');
        return Redirect::to('viewproduct');
    }



    // Categories - Danh mục
    public function viewcategories()
    {
        $titleheader = 'Danh mục';
        $boxtitle = 'Danh sách Danh mục';
        $categories = ProductType::all();
        return view('backend.page.viewcategories', compact('titleheader', 'boxtitle', 'categories'));
    }

    public function viewaddcategory()
    {
        $titleheader = 'Danh mục';
        $boxtitle = 'Thêm Danh mục';
        return view('backend.page.addcategory', compact('titleheader', 'boxtitle'));
    }

    public function submitaddcategory(Request $req)
    {
        $cate = ProductType::create($req->all());
        Session::put('message', 'Thêm danh mục  thành công');
        return Redirect::to('viewtypeproduct');
    }

    public function vieweditcategory($CategoryId)
    {
        $titleheader = 'Danh mục';
        $boxtitle = 'Hiệu chỉnh Danh mục';
        $categoryModel = ProductType::find($CategoryId);
        return view('backend.page.editcategory', compact('titleheader', 'boxtitle', 'categoryModel'));
    }

    public function submiteditcategory($CategoryId, Request $req)
    {
        $cate = ProductType::find($CategoryId);
        $cate->categories_name = $req->categories_name;
        $cate->save();
        Session::put('message', 'Update danh mục  thành công');
        return Redirect::to('viewtypeproduct');
    }

    public function deletecategory($CategoryId)
    {
        $Products = Product::all();
        foreach ($Products as $product) {
            if ($product->id_type == $CategoryId) {
                Session::put('message', 'Xóa thất bại, vì còn sản phẩm trong danh mục');
                return Redirect::to('viewtypeproduct');
            }
        }
        ProductType::destroy($CategoryId);
        Session::put('message', 'Xóa thanh công');
        return Redirect::to('viewtypeproduct');
    }

    function test()
    {
        // return Carbon::now('Asia/Ho_Chi_Minh');
        return Carbon::parse(Carbon::now()->toDateTimeString())->format('H:i:s d-m-Y');
        $date = Carbon::parse(Carbon::now()->toDateTimeString());
        return $date->format('d-m-Y');
        return Carbon::now()->toDateTimeString()->format('d-m-Y');
        return CusAPComment::where('cap_id', 2)->with('User')->get();
        return CustomerAccount::with('CusAccountProduct.Product', 'CusAccountProduct.CusAPOption.Option')->get();
    }


    // front-end
    public function GetAllProductClient()
    {
        $Products = Product::where('accessory_group_id', '!=', null)->get();
        $Accressories = Accessories::all();
        $Productsss = Product::where('accessory_group_id', '=', null)->get();
        return view('frontend.page.home', compact('Products', 'Accressories', 'Productsss'));
    }

    public function ViewDetailProduct($productId)
    {
        $Product = Product::find($productId);
        $Options = ListAccessories::where('accessories_group_id', $Product->accessory_group_id)
                                    ->where('is_obligatory', 1)
                                    ->get('accessories_id');
        $Options1 = ListAccessories::where('accessories_group_id', $Product->accessory_group_id)
        ->where('is_obligatory', null)
        ->get('accessories_id');

        $accessories = Accessories::whereIn('id', $Options)->get();

        $optonCustom =  Accessories::whereIn('id', $Options1)->get();
        $totalPrice = $Product->price;

        foreach ($accessories as $accessory) {
            $totalPrice += $accessory->price;
        }
        return view('frontend.page.detail_product', compact('Product', 'accessories', 'optonCustom', 'totalPrice', 'totalPrice'));
    }

    public function ViewDetailAccessories($id)
    {
        $accessories = Accessories::find($id);
        return view('frontend.page.detail_accessories', compact('accessories'));
    }

    public function ViewDetailOneProduct($id)
    {
        $Product = Product::find($id);

        return view('frontend.page.detail_one_product', compact('Product'));
    }

    public function SearchKit(Request $request)
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

    public function SearchProduct(Request $request){
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

    public function SearchAccessories(Request $request){
        if($request->ajax()){
            $output = '';
            $Accessories = DB::table('accessories')
                        ->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orderby('name', 'desc')->get();
            if($Accessories){
                foreach($Accessories as $key => $Accessory){
                    $output .= '<tr>
                                    <td>'.$key.'</td>
                                        <td>'.$Accessory->name.'</td>
                                        <td>'.number_format($Accessory->price) . ' VNĐ'.'</td>
                                        <td  class="align-middle"><img style="width: 75px; height: 75px" src="source/images/' . $Accessory->image . '"/></td>
                                        <td>
                                            <form action="' . url("add-accessories-to-cart/{$Accessory->id}") . '" method="post">
                                                '.csrf_field().'
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
}












function utf8convert($str)
{
    if (!$str) return false;
    $utf8 = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ|Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);
    return $str;
}

function chuyendoi($str)
{
    $text = $str;
    $text = strtolower(utf8convert($text));
    $text = str_replace("ß", "ss", $text);
    $text = str_replace("%", "", $text);

    $text = str_replace("(", "", $text);
    $text = str_replace(")", "", $text);

    $text = preg_replace("/[^_a-zA-Z0-9 -] /", "", $text);
    $text = str_replace(array('%20', ' '), '-', $text);
    $text = str_replace("----", "-", $text);
    $text = str_replace("---", "-", $text);
    $text = str_replace("--", "-", $text);
    return $text;
}
