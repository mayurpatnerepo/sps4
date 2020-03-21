<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\State;
use App\Project;

class Prop_ProjectController extends Controller
{
	  public function index()
    {   
       $id= "0";
       $states = State::where('is_active','1')->get();
        return view('Prop_Project/add_project',compact('states'))->with('id',$id);;
    }




     public function store(Request $request)
	    {
              $project = new Project; 
              $project->proj_project_name = $request->Project_Name;
              $project->proj_owner_name = $request->Owner_Name;
              $project->proj_address = $request->Address;
              $project->proj_phone_number = $request->Phone_Number;
              $project->proj_email_id = $request->Email_Id; 
              $project->proj_website = $request->Website;
              $project->proj_developer_name = $request->Developer_Name;   
              $project->proj_project_code = $request->Project_Code;
              
              $project->proj_street = $request->street;
              $project->proj_city_town = $request->city_town;
              $project->proj_zip_code = $request->postal_code;
              $project->proj_state = $request->state;
              $project->proj_country = $request->country;    

                   $project->save();
                   
                    return response()->json(['success'=>'done']);
              


	       
	    }

      public function display()
    {
       $Projects=Project::all();
        return view('Prop_Project/list_of_project')->with('Projects',$Projects);
    }


    }
