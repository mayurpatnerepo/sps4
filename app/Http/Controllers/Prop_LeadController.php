<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Lead;

class Prop_LeadController extends Controller
{
      public function index()
    {   
        return view('Prop_Lead/add_lead');
    }

    


      public function store(Request $request)
	    {
              $lead = new Lead; 
              $lead->Lead_Name = $request->Lead_Name;
              $lead->Mobile_Number = $request->Mobile_Number;
              $lead->Phone = $request->Phone;
              $lead->Email_Id = $request->Email_Id;
              $lead->Secondary_Email = $request->Secondary_Email;

              $lead->Skype_Id = $request->Skype_Id;
              $lead->Twitter = $request->Twitter;   
              $lead->Lead_Status = $request->Lead_Status;
              
              $lead->Lead_Source = $request->Lead_Source;
              $lead->Modified_By = $request->Modified_By;
              $lead->Created_By = $request->Created_By;
              $lead->Requirement_Type = $request->Requirement_Type;
              $lead->Requirement_Category = $request->Requirement_Category;    

               $lead->Property_Category = $request->Property_Category;
              $lead->Property_Type = $request->Property_Type;
              $lead->Price_Min = $request->Price_Min;
              $lead->Price_Max = $request->Price_Max;
              $lead->Area_Min = $request->Area_Min;    

               $lead->Area_Max = $request->Area_Max;
              $lead->Bath_Max = $request->Bath_Max;
              $lead->Bath_Min = $request->Bath_Min;
              $lead->Parking_Sapce = $request->Parking_Sapce;
              $lead->Location = $request->Location;    



              $lead->Brokerage_Agency_Name = $request->Brokerage_Agency_Name;
              $lead->Broker_Name = $request->Broker_Name;
              $lead->street = $request->street;
              $lead->city_town = $request->city_town;
              $lead->postal_code = $request->postal_code;    

               $lead->state = $request->state;
              $lead->country = $request->country;
              $lead->description = $request->description;
              $lead->Average_Time_spend = $request->Average_Time_spend;
              $lead->Visited_Date = $request->Visited_Date; 

              $lead->Visited_Time = $request->Visited_Time; 




                   $lead->save();
                   
                    return response()->json(['success'=>'done']);
              


	       
	    }
      public function display()
    {
       $Lead=Lead::all();
        return view('Prop_Lead/list_of_lead')->with('Lead',$Lead);
    }


}
