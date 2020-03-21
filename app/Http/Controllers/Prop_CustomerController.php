<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;
use App\PropCustomer;
use File;


class Prop_CustomerController extends Controller
{

     public function index()
    {   
        return view('Prop_Customer/prop_add_customer');
    }




     public function store(Request $request)
	    {   

	    	$customer = new PropCustomer; 
	         $customer->prop_Customer_name = $request->Customer_name;
             $customer->prop_Last_name = $request->Last_name;
             $customer->prop_Mobile_Number = $request->Mobile_Number;
             $customer->prop_Email_Id = $request->Email_Id;
             $customer->prop_Requirement_Type = $request->Requirement_Type;
             $customer->prop_Requirement_Category = $request->Requirement_Category;
             $customer->prop_property_category = $request->property_category;
             $customer->prop_property_type = $request->property_type;
             $customer->prop_Price_Min = $request->Price_Min;
             $customer->prop_Price_Max = $request->Price_Max;
             $customer->prop_Area_Min = $request->Area_Min;
             $customer->prop_Area_Max = $request->Area_Max;
             $customer->prop_Bath_Max = $request->Bath_Max;
             $customer->prop_Bath_Min = $request->Bath_Min;
             $customer->prop_Location = $request->Location;
             $customer->prop_Intrested_Property = $request->Intrested_Property;
             $customer->prop_description = $request->description;




                    $customer->save();
                   
                    return response()->json(['success'=>'done']);
              
}

public function display()
    {
       $Customers=PropCustomer::all();
        return view('Prop_Customer/list_of_customer')->with('Customers',$Customers);
    }
}