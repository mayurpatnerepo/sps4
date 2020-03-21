<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChannelPartner;

class ChannelPartnerController extends Controller
{
      public function index()
    {   
        return view('Channel_Partner/add_newcp');
    }

      public function store(Request $request)
	    {
              $ChannelPartner = new ChannelPartner; 
              $ChannelPartner->Channel_Partner_photo = $request->image;
              $ChannelPartner->Channel_Partner_Id = $request->Channel_Partner_Id;
              $ChannelPartner->first_name = $request->first_name;
              $ChannelPartner->last_name = $request->last_name;
              $ChannelPartner->Channel_Partner_email = $request->cp_email; 
              $ChannelPartner->Channel_Partner_Contact = $request->Channel_Partner_Contact;
              $ChannelPartner->gender = $request->gender;   
              $ChannelPartner->Marital_status = $request->Marital_status;
              
              $ChannelPartner->Date_Of_Birth = $request->dob;
              $ChannelPartner->blood_group = $request->blood_group;
              $ChannelPartner->Address = $request->address;
              $ChannelPartner->relative_name = $request->Name;
              $ChannelPartner->relation = $request->relation;    

               $ChannelPartner->relative_contact = $request->relative_contact;
              $ChannelPartner->relative_address = $request->relative_address;
               


                   $ChannelPartner->save();
                   
                    return response()->json(['success'=>'done']);
              


	       
	    }



}
