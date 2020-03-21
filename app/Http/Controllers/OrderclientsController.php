<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\MainOrder;
use App\OrderParticular;
use App\Invoice;
use App\InvoiceParticular;


class OrderclientsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $org = client::find($id);
        return response()->json($org);
    }

    public function saveOrg(Request $request)
    {
                $org = new client;
                $org->contact_person_name = $request->cp_name;
                $org->organization_name = $request->org_name;
                $org->mobile_number = $request->mob_number;
                $org->email_id = $request->cre_email;
                $org->address = $request->cre_address;
                if($org->save()){
                    return response()->json($org);
                }

                  
    }

    public function display()
    {
       
        $mainorders = MainOrder::all();
        $orderparticulars = OrderParticular::all();
        return view('Orders/list_all_orders',compact('mainorders','orderparticulars'));
    }
}
