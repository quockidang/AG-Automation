<?php

namespace App\Http\Controllers;
use App\BillDetailAdmin;
use App\BillAdmin;
use App\Customer;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //
    public function ExprotBillAdmin($id){
        $Bill = BillAdmin::find($id);
        $Customer = Customer::find($Bill->customer_id);
        $BillDetails = BillDetailAdmin::where('bill_id', $id)->get();

        $pdf = PDF::loadView('backend.page.invoice',   compact('Bill', 'Customer', 'BillDetails'));
           return $pdf->download('invoice.pdf');
       // return view('backend.page.invoice', compact('Bill', 'Customer', 'BillDetails'));
    }
}
