<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

use App\ProductType;
use Session;
use Carbon\Carbon;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Accessories;
use App\AccessoryGroup;
use App\BillDetailAdmin;
use App\ListAccessories;
class AccessoryController extends Controller
{
    //
    public function GetAllAccessories(){
        $Accessories = Accessories::all();
        $titleheader = 'Phụ kiện';
        $boxtitle = 'Danh sách phụ kiện';
        return view('backend.page.viewalloption', compact('Accessories', 'titleheader', 'boxtitle'));
    }

    public function ViewAddAccessories(){
        $titleheader = 'Phụ kiện';
        $boxtitle = 'Thêm phụ kiện';
        return view('backend.page.addoptionproduct', compact('titleheader', 'boxtitle'));
    }

    public function SubmitAddAccessories(Request $req){

        $acc = Accessories::where('code', $req->accessory_code)->first();
        if($acc){
            Session::put('message', 'Thêm phụ kiện thất bại, Vì mã phụ kiện đã tồn tại');
            return Redirect::to('view-all-accessories');
        }

        $accessory = new Accessories;
        $accessory->code = $req->accessory_code;
        $accessory->name = $req->name;
        $accessory->warranty = $req->warranty;
        $accessory->price = $req->price;
        $accessory->meta_desc = $req->meta_desc;

        $get_image = $req->file('image');

        $name_image = current(explode('.', $get_image->getClientOriginalName()));
        $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move('source/images', $new_image);
        $accessory->image = $new_image;

        $accessory->save();
        Session::put('message', 'Thêm phụ kiện thành công');
        return Redirect::to('view-all-accessories');
    }

    public function ViewEditAccessories($id){
        $accessory = Accessories::find($id);
        $titleheader = 'Phụ kiện';
        $boxtitle = 'Update phụ kiện';
        return view('backend.page.editoption', compact('titleheader', 'boxtitle','accessory'));
    }

    public function SubmitEditAccessories(Request $req, $id){
        $accessory = Accessories::find($id);
        $accessory->name = $req->name;
        $accessory->code = $req->accessory_code;
        $accessory->price = $req->price;
        $accessory->meta_desc = $req->meta_desc;
        $accessory->warranty = $req->warranty;
        $get_image = $req->file('image');
        if($get_image)
        {
            $name_image = current(explode('.', $get_image->getClientOriginalName()));
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('source/images', $new_image);
            $accessory->image = $new_image;
        }
        $accessory->save();
        Session::put('message', 'Update phụ kiện thành công');
        return Redirect::to('view-all-accessories');
    }

    public function DeleteAccessories($id){
        $pro = BillDetailAdmin::where('product_id', $id)->first();
        if($pro){
            Session::put('message', 'Xóa phụ kiện thất bại vì phụ kiện còn nằm trong đơn hàng');
            return Redirect::to('view-all-accessories');
        }
        Accessories::destroy($id);
        ListAccessories::where('accessories_id', $id)->delete();
        Session::put('message', 'Xóa phụ kiện thành công');
        return Redirect::to('view-all-accessories');
    }

    // Nhóm Phụ kiện
    public function GetAllAccessoriesGroup(){
        $titleheader = 'Nhóm Phụ Kiện';
        $boxtitle = 'Danh sách nhóm phụ kiện';
        $accessoriesGroup = AccessoryGroup::all();
        return view('backend.page.viewaccessoriesgroup', compact('titleheader', 'boxtitle', 'accessoriesGroup'));
    }

    public function ViewAddAccessoriesGroup(){
        $titleheader = 'Nhóm Phụ Kiện';
        $boxtitle = 'Thêm nhóm phụ kiện';
        return view('backend.page.addgroupaccessories', compact('titleheader', 'boxtitle'));
    }

    public function SubmitAddAccessoriesGroup(Request $req){
        AccessoryGroup::create($req->all());
        Session::put('message', 'Thêm nhóm phụ kiện thành công');
        return Redirect::to('view-all-accessories-group');
    }

    public function ViewEditAccessoriesGroup($id){
        $titleheader = 'Nhóm Phụ Kiện';
        $boxtitle = 'Update nhóm phụ kiện';
        $NameAccessoriesGroup = AccessoryGroup::find($id);
        $Accessories = Accessories::all();
        $AccessoriesforID = ListAccessories::where('accessories_group_id', $id)->where('is_obligatory', null)->get();
        foreach($AccessoriesforID as $key1 => $val1){
            foreach($Accessories as $key2 => $val2){
                if($val2->id == $val1->accessories_id){
                    unset($Accessories[$key2]);
                }
            }
        }

        $AccessoriesforID1 = ListAccessories::where('accessories_group_id', $id)->where('is_obligatory', '!=', null)->get();
        foreach($AccessoriesforID1 as $key1 => $val1){
            foreach($Accessories as $key2 => $val2){
                if($val2->id == $val1->accessories_id){
                    unset($Accessories[$key2]);
                }
            }
        }
        return view('backend.page.editgroupaccessories', compact('titleheader', 'boxtitle', 'NameAccessoriesGroup', 'Accessories', 'AccessoriesforID', 'AccessoriesforID1'));
    }

    public function SubmitEditAccessoriesGroup($id, Request $req){
        $accGroup = AccessoryGroup::find($id);
        $accGroup->name = $req->name;
        $accGroup->save();

        ListAccessories::where('accessories_group_id', $id)->delete();
        if($req->arrayId1){
            foreach($req->arrayId1 as $ids){
                $model = new ListAccessories;
                $model->accessories_group_id = $id;
                $model->accessories_id = $ids;
                $model->is_obligatory = 1;
                $model->save();
            }
        }
        if($req->arrayId)
        {
            foreach($req->arrayId as $ids){
                $model = new ListAccessories;
                $model->accessories_group_id = $id;
                $model->accessories_id = $ids;
                $model->save();
            }
        }else{
            Session::put('message', 'Update nhóm phụ kiện thành công');
            return Redirect::to('view-all-accessories-group');
        }
        Session::put('message', 'Update nhóm phụ kiện thành công');
        return Redirect::to('view-all-accessories-group');
    }

    public function DeleteAccessoriesGroup($id){
        ListAccessories::where('accessories_group_id', $id)->delete();
        AccessoryGroup::destroy($id);
        Session::put('message', 'Xóa nhóm nhóm phụ kiện thành công');
        return Redirect::to('view-all-accessories-group');
    }
}
