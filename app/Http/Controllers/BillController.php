<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillDetail;
use App\Bills;
use App\Customer;
use Yajra\DataTables\DataTables;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use App\User;


class BillController extends Controller
{
    function viewbill()
    {
        $titleheader = "Đơn hàng";
        $boxtitle = "Quản lý đơn hàng";
        if(Auth::user()->role_id == 1){
            $staff = User::all();
            return View('backend.page.bill', compact('titleheader', 'boxtitle','staff'));
        }
        return View('backend.page.bill', compact('titleheader', 'boxtitle'));
    }

    function viewbillnoprocess()
    {
        $titleheader = "Đơn hàng";
        $boxtitle = "Quản lý đơn hàng chưa xử lý";
        if(Auth::user()->role_id == 1){
            $staff = User::all();
            return View('backend.page.billnoprocess', compact('titleheader', 'boxtitle','staff'));
        }
        return View('backend.page.billnoprocess', compact('titleheader', 'boxtitle'));
    }

    function viewdetail($id)
    {
        $titleheader = "Chi tiết";
        $boxtitle = "Chi tiết đơn hàng";
        $Bill = Bills::where('id', $id)->with('Customer')->get();
        // $topping = Topping::all();
        return View('backend.page.billdetail', compact('Bill', 'titleheader', 'boxtitle'));
    }

    function viewcustomer()
    {
        $titleheader = "Khách hàng";
        $boxtitle = "Quản lý khách hàng";
        return View('backend.page.customer', compact('titleheader', 'boxtitle'));
    }

    function getbill()
    {
        // return Customer::where('user_id', 1)->with('Bills')->get();
        // return Bills::where('user_id',1 ??? )->with('Customer')->get();
        if (Auth::user()->role_id == 1) {
            $flights = Bills::whereHas('Customer', function ($element) {
                $element->where('user_id','!=',null);
            })->with('Customer')->get();
        } else {
            $flights =  Bills::whereHas('Customer', function ($element) {
                $element->where('user_id',Auth::user()->id);
            })->with('Customer')->get();
    
        }
        return Datatables::of($flights)
            ->editColumn('status', function ($v) {
                if ($v->status == 2) {
                    return '<i class=" text-green fa  fa-check-circle"></i>';
                } else if ($v->status == 1) {
                    return "đang xử lý";
                } else
                    return "";
            })
            ->addColumn('action', function ($v) {
                return '<a href="getviewdetail/' . $v->id . '"
                 class="table-action table-action-view text-blue cursor-pointer" 
                 data-id="' . $v->id . '">
                 <i class="fa  fa-book"></i></a>
 
                 <a href="#" class="table-action text-green table-action-edit cursor-pointer" 
                 data-id="' . $v->id . '">
                 <i class="fa fa-edit"></i></a>
 
                 <a href="#" class="table-action text-red table-action-delete cursor-pointer" 
                 data-id="' . $v->id . '">
                 <i class="fa fa-trash"></i></a>';
            })
            // ->addColumn('action', function ($v) {
            //     return 'aabc';
            // })
            // ->addColumn('action','ahbc')
            ->addIndexColumn()
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    function getbillnoprocess()
    {
        $flights =  Bills::whereHas('Customer', function ($element) {
            $element->where('user_id',null);
        })->orderBy('date_order','DESC')->with('Customer')->get();
        return Datatables::of($flights)
            ->editColumn('status', function ($v) {
                if ($v->status == 2) {
                    return '<i class=" text-green fa  fa-check-circle"></i>';
                } else if ($v->status == 1) {
                    return "đang xử lý";
                } else
                    return "";
            })
            ->addColumn('action', function ($v) {
                return '<a href="getviewdetail/' . $v->id . '"
                 class="table-action table-action-view text-blue cursor-pointer" 
                 data-id="' . $v->id . '">
                 <i class="fa  fa-book"></i></a>
 
                 <a href="#" class="table-action text-green table-action-edit cursor-pointer" 
                 data-id="' . $v->id . '">
                 <i class="fa fa-edit"></i></a>
 
                 <a href="#" class="table-action text-red table-action-delete cursor-pointer" 
                 data-id="' . $v->id . '">
                 <i class="fa fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    function get1bill(Request $req)
    {
        return [
            'code' => 200,
            'data' => Bills::where('id', $req->id)->with('Customer')->first()
        ];
    }

    function ActionBill(Request $req)
    {
        if ($req->action == "delete") {
            $rules = array(
                'id' => 'required',
            );
            $messages = ([
                'id.required' => 'Không có giá trị mã giới thiệu',
            ]);
            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                return $data = [
                    'code' => 400,
                    "msg" =>  $validator->errors()
                ];
            }
            $billdetail = BillDetail::where('id_bill', $req->id)->delete();
            if (!$billdetail) {
                return $data = [
                    "code" => 400,
                    "msg" => "Xóa không thành công"
                ];
            }
            $query = Bills::find($req->id)->delete();
            if ($query) {
                return $data = [
                    "code" => 200,
                    "msg" => "Xóa thành công"
                ];
            } else {
                return $data = [
                    "msg" => "Xóa không thành công"
                ];
            }
        } else if ($req->action == "update") {
            $rules = array(
                'id' => 'required',
                'addTenSV' => 'required',
                'addDiaChi' => 'required',
                'addPhone' => 'required',
                'addStatus' => 'required',
                'addPayment' => 'required',
            );
            $messages = ([
                'id.required' => 'Không có giá trị mã giới thiệu',
                'addTenSV.required' => 'Tên là bắt buộc',
                'addDiaChi.required' => 'Địa chỉ là bắt buộc',
                'addPhone.required' => 'Số điện thoại là bắt buộc',
                'addStatus.required' => 'Trạng thái là bắt buộc',
                'addPayment.required' => 'Hình thức thanh toán là bắt buộc',
            ]);
            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                return $data = [
                    'code' => 400,
                    "msg" =>  $validator->errors()
                ];
            }
            $cus = Customer::where('id', $req->idcustomer);
            $data = [
                'name' => $req->addTenSV,
                'address' => $req->addDiaChi,
                'phone' => $req->addPhone,
            ];
            if($req->addStaff){
                $data['user_id'] =  $req->addStaff;
            }else{
                if ($req->addStatus == 0) {
                    $data['user_id'] = null;
                } else if ($req->addStatus == 1) {
                    $data['user_id'] =  Auth::user()->id;
                } else {
                    $data['user_id'] =  Auth::user()->id;
                }
            }

            $cus->update($data);

            $bill = Bills::where('id', $req->id);
            $bill->update([
                'status' => $req->addStatus,
                'payment_method' => $req->addPayment,
            ]);

            return [
                'code' => 200,
                'msg' => "Cập nhật thành công"
            ];
        }
    }

    function ActionBillDetail(Request $req)
    {
        if ($req->action == "delete") {
            $rules = array(
                'id' => 'required',
            );
            $messages = ([
                'id.required' => 'Không có giá trị mã giới thiệu',
            ]);
            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                return $data = [
                    "msg" => $validator->errors()
                ];
            }
            $detail = BillDetail::find($req->id);
            $bill = Bills::find($detail->id_bill);
            $bill->update(['total' => ($bill->total - $detail->price)]);
            $query = $detail->delete();
            if ($query) {
                return $data = [
                    "code" => 200,
                    "msg" => "Xóa thành công",
                    'total' => $bill->total
                ];
            } else {
                return $data = [
                    "msg" => "Xóa không thành công"
                ];
            }
        }
    }

    function getbilldetail($id)
    {
        $flights = BillDetail::where('bill_id', $id)->with('Product', 'Option')->get();
        // return $flights[0]->option[0]->name;
        // $arrtopping = [];
        // foreach ($flights as $key => $value) {
        //     $topping = [];
        //     if (!empty($value->id_topping)) {
        //         $topping = "";
        //         $valtopping = explode('-', $value->id_topping);
        //         foreach ($valtopping as $key1 => $value1) {
        //             if ($value1 != null) {
        //                 $ping = Topping::find($value1);
        //                 $topping .= ' + ' . $ping->name;
        //             }
        //         }
        //         $flights[$key]->id_topping = $topping;
        //         // array_push(, $topping);
        //     } else {
        //         $flights[$key]->id_topping = 0;
        //         // array_push($flights[$key], '0');
        //     }
        // }
        return Datatables::of($flights)
            ->addColumn('option', function ($v) {
                $topping = "";
                foreach ($v->option as $key => $value) {
                    $topping .= ' + ' . $value->name;
                }
                return $topping;
            })
            // ->addColumn('action', function ($v) {
            //     return '<a href="getviewdetail/' . $v->id . '"
            //      class="table-action table-action-edit text-green cursor-pointer" 
            //      data-id="' . $v->id . '"><i class="fa fa-edit"></i></a>
            //      <a class="table-action text-red table-action-delete cursor-pointer" 
            //  data-id="' . $v->id . '"><i class="fa fa-trash"></i></a>';
            // })
            ->addColumn('action', function ($v) {
                return '';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
