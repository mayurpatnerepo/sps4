<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\MainOrder;
use App\client;
use App\OrderParticular;
use App\InvoiceParticular;
use PDF;
use stdClass;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
         //set_time_limit(200);
        $Invoice=Invoice::orderBy('id', 'DESC')->get();
       
      
        return view('invoice/listActiveInvoice')->with('Invoices',$Invoice);
    }

    public function  Secondaryindex()
    {
        $Invoices=Invoice::orderBy('id', 'DESC')->get();
        return view('invoice/listCompletedinvoice')->with('Invoices',$Invoices);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,$tim)
    {
        $orderparticulars =[];
        $order=MainOrder::find($id);
        $orderparticulars = OrderParticular::where('orders_id',$id)->get();
        $amount_paid = 0.00;
        $co_ordinated_with = "dummy";
        $balance= $order->grand_total - $amount_paid;
        $invoice = new Invoice;
        $invoice->orderID = $order->id;
        $invoice->organizationID = $order->org_id;
        $invoice->organization_name = $order->organization_name;
        $invoice->enquiryID = $order->enqid_hidden;
        $invoice->propasalID = $order->proposalIDHidden;
        $invoice->entryLevel = $order->entryLevelHidden;
        $invoice->subtotal = $order->subtotal;
       
        $invoice->discount_amount = $order->discount_amount;
        $invoice->grand_total = $order->grand_total;
        $invoice->amount_paid = $amount_paid;
        $invoice->balance = $balance;
        $invoice->exp_date = $order->exp_date;
        $invoice->path =$tim;
        if($invoice->save()){
            foreach($orderparticulars as $value){
                $data = array(
                    'Product' => $value->products,
                    'qty' =>  $value->qty,
                    'price' => $value->price,
                    'igst' => $value->igst,
                    'cgst' => $value->cgst,
                    'sgst' => $value->sgst,
                    'discount' => $value->discount,
                    'product_total' =>$value->total,
                    'Co_ordinated_with' => $co_ordinated_with,
                    'invoice_id' =>  $invoice->id
                );
                
                InvoiceParticular::insert($data);  
            }
        }
       
        
        return response()->json(["success"=>"Invoice Created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    public function InvoicePDF(Request $request,$id)
    {
        $final_data=[];
        $organisation_true=client::all();
        $order=MainOrder::find($id);
        $orderparticulars = OrderParticular::where('orders_id',$id)->get();
        $inv_id_old=DB::table('invoices')->max('id');
        if($inv_id_old == null || $inv_id_old == ""){
            $inv_id=0;
        }else{
            $inv_id=$inv_id_old;
        }

        $total_qty = DB::table('order_particulars')->where('orders_id', $id)->sum('qty');
        $sum_of_all_prices = DB::table('order_particulars')->where('orders_id', $id)->sum('price');
        $sum_of_all_total =  DB::table('order_particulars')->where('orders_id', $id)->sum('total');

       $t= time().'.pdf';
       $id1 = $id;
       $pdf = PDF::loadView('invoice.invoicePDF', array('org_true'=>$organisation_true,'pdfdata' => $order,'finaldata'=>$orderparticulars,'inv_id'=>$inv_id,'sum_qty'=>$total_qty,'sum_price'=>$sum_of_all_prices,'sum_total'=>$sum_of_all_total));
       $pdf->save('InvoicePDF/'.$t , compact('order','orderparticulars','inv_id'));
       return $this->store($id1,$t);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Responses
     */
    public function completed_invoice($id)
    {   
        $status="0";
        $invoice = Invoice::find($id);
        $invoice->status = $status;
        $invoice->save();
        return response()->json(['success' => 'Data is Successfully Updated']);
    }
    public function destroy(Invoice $invoice)
    {
        //
    }
}
