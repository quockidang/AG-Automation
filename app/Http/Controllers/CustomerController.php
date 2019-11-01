<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Yajra\DataTables\DataTables;
use App\ProductType;
use Session;
use App\Customer;
use App\PageUrl;
use App\CustomerAccount;
use App\CusAccountProduct;
use App\CusAPOption;
use App\CusAPComment;
use App\BillAdmin;
use App\BillDetailAdmin;
use Carbon\Carbon;
use App\NoteBillAdmin;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;
session_start();

class CustomerController extends Controller
{
    //

    public function GetALL(){
        $titleheader = "Khách Hàng";
        $boxtitle = "Danh sách khách hàng";
        $Customers = Customer::all();
        return view('backend.page.viewcustomer', compact('titleheader', 'boxtitle', 'Customers'));
    }

    public function ViewAddCustomer(){
        $titleheader = "Khách Hàng";
        $boxtitle = "Thêm khách hàng";

        return view('backend.page.addcustomer', compact('titleheader', 'boxtitle'));
    }

    public function AddCustomer(Request $req){
        $cus = Customer::create($req->all());
        return Redirect::to('viewcusaccount');
    }

    public function ViewEditCustomer($CustomerId){
        $Customer = Customer::find($CustomerId);
        $titleheader = "Khách Hàng";
        $boxtitle = "Update thông tin khách hàng: ". $Customer->name;

        return view('backend.page.editcustomer', compact('titleheader', 'boxtitle', 'Customer'));
    }

    public function EditCustomer(Request $req, $customerId){

        Customer::find($customerId)->update($req->all());

        return Redirect::to('viewcusaccount');
    }

    public function DeleteCustomer($customerId){
        Customer::destroy($customerId);
        return Redirect::to('viewcusaccount');
    }

    public function ViewBillCustomer($id){

        $titleheader = "Khách Hàng:". ' ' . Customer::find($id)->name;
        $boxtitle = "Thông tin dơn hàng: ";

        $bill = BillAdmin::where('customer_id', $id)->get();

        return view('backend.page.view_all_bill_customer', compact('titleheader', 'boxtitle', 'bill'));
    }


    public function ViewDetailBillAdmin($id){
        $titleheader = "Khách Hàng";
        $boxtitle = "Chi tiết đơn hàng";
        $detail = BillDetailAdmin::where('bill_id', $id)->get();

        $AllNoteById = NoteBillAdmin::where('bill_admin_id', $id)
                                    ->orderby('updated_at', 'desc')
                                    ->get();
        return view('backend.page.view_detail_bill_admin', compact('titleheader', 'boxtitle','detail', 'id', 'AllNoteById'));
    }

    public function SearchCustomer(Request $request){
        if ($request->ajax()) {
            $output = '';
            $customers = DB::table('customers')->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email','LIKE','%'. $request->search .'%')
            ->orWhere('phone','LIKE','%'. $request->search .'%')->orderby('name', 'desc')->get();

            if ($customers) {
                foreach ($customers as $key => $customer) {

                    $key = $key + 1;

                   // $arrlink =  '<a href="{{URL::to('."'/edit-customer/'".$customer->customer_id.')}}"><i style="color: green; margin: 5px;" class="far fa-edit"></i></a>';
                    $output .= '<tr>
                    <td  class="align-middle">' . $key. '</td>
                    <td  class="align-middle">' . $customer->name . '</td>
                    <td  class="align-middle">' . $customer->gender . '</td>
                    <td  class="align-middle">' . $customer->address . '</td>

                    <td class="align-middle">' . $customer->phone . '</td>
                    <td class="align-middle">
                        <a title="Sửa thông tin khách hàng" href="'.url("edit-customer/{$customer->id}").'"><i class="fa fa-pencil-square-o fontsize25" aria-hidden="true"></i></a>
                        <a title="Xem lịch sử mua hàng" href="'.url("view-all-bill-admin/{$customer->id}").'"><i class="fa  fa-eye fontsize25" style="text-align: center;
                        padding-top: 11px;"></i></a>
                        <a title="Tạo đơn hàng" href="'.url("create-bill-admin/{$customer->id}").'" ><i class="fa fa-shopping-cart fontsize25" style="text-align: center;
                        padding-top: 11px;"></i></a>

                     </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function AddContent(Request $req, $id){
        $note = new  NoteBillAdmin;
        $note->bill_admin_id = $id;
        $note->content = $req->content;
        $note->created_by = Auth::User()->name;
        $note->created_at = date('Y-m-d');


        $note->save();
        Session::put('message', 'Thêm ghi chú thành công');
        return Redirect::to('view-detail-bill-admin/'.$id);
    }
}
