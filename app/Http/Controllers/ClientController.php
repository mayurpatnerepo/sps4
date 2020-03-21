<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\Industry;
use App\State;
use App\DataSource;
use App\Branch;
use DB;
use App\OrganizationType;
use App\Country;
use App\Zone;
use App\SubPriority;
use App\AssociationWithMedicam;
use App\Employee;


class ClientController extends Controller
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
    {    $id= "0";
        $industries = Industry::all();
        $states = State::where('is_active','1')->get();
        $data_sources= DataSource::where('is_active','1')->get();
        $branches=Branch::where('is_active','1')->get();
        $organization_types=OrganizationType::where('is_active','1')->get();
        $countries=Country::where('is_active','1')->get();
        $zones=Zone::where('is_active','1')->get();
        $sub_priorities=SubPriority::where('is_active','1')->get();
        $association_with_medicams=AssociationWithMedicam::where('is_active','1')->get();
        $Assign_toID = Employee::all();
        
        return view('organization/add_client',compact('industries','states','data_sources','branches','organization_types','countries','zones','sub_priorities','association_with_medicams','Assign_toID'))->with('id',$id);
    }
    public function secondary()
    {    $id= "0";
        $industries = Industry::all();
        $states = State::where('is_active','1')->get();
        $data_sources= DataSource::where('is_active','1')->get();
        $branches=Branch::where('is_active','1')->get();
        $organization_types=OrganizationType::where('is_active','1')->get();
        $countries=Country::where('is_active','1')->get();
        $zones=Zone::where('is_active','1')->get();
        $sub_priorities=SubPriority::where('is_active','1')->get();
        $association_with_medicams=AssociationWithMedicam::where('is_active','1')->get();
        $Assign_toID = Employee::all();
        
        return view('organization/secondary_organization',compact('industries','states','data_sources','branches','organization_types','countries','zones','sub_priorities','association_with_medicams','Assign_toID'))->with('id',$id);
    }   




    public function display()
    {
       $organisations=Client::all();
        return view('organization/list_organization')->with('organisations',$organisations);
    }

     public function display1()
    {
       $organisations=Client::all();
        return view('organization/list_secondary_organization')->with('organisations',$organisations);
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
    public function store(Request $request)
    {
            if($request->create_enq=="1")
            {
                $client= new Client;    
                $client->contact_person_name = $request->contact_person_name;
                $client->contact_person_name_acc = $request->contact_person_name_acc;
                $client->organization_name= $request->organization_name;
                $client->fax= $request->fax;
                $client->gst= $request->gst;
                $client->industry= $request->industry;
                $client->landmark= $request->landmark;
                $client->city_town= $request->city_town;
                $client->postal_code=$request->postal_code;
                $client->mobile_number=$request->mobile_number;
                $client->primary_phone=$request->primary_phone;
                $client->primary_email=$request->email_id;
                $client->unique_id= $request->unique_id;
                $client->data_source=$request->data_source;
                $client->address= $request->address;
                $client->select_branch= $request->select_branch;
                $client->organization_type=$request->organization_type;
                $client->email_id=$request->email_id;
                $client->secondary_phone= $request->secondary_phone;
                $client->secondary_email=$request->secondary_email;
                $client->telecaller= $request->telecaller;
                $client->zone=$request->zone;
                $client->country=$request->country;
                $client->pan_no= $request->pan_no;
                $client->Assign_To=$request->Assign_To;
                $client->website=$request->website;
                $client->sales_person=$request->sales_person;
                $client->area=$request->area;
                $client->state=$request->state;
                $client->association_with_medicam=$request->association_with_medicam;
                $client->description= $request->description;
                $client->preference_token =1;
                try {
                    $client->save();
                    $id = DB::getPdo()->lastInsertId();
                    return response()->json(['success'=>$id]);
                }
                catch(\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == '1062'){
                        return response()->json(['success'=>'Duplicate entry']);
                    }
                }

            }
        $client= new Client;    
        $client->contact_person_name = $request->contact_person_name;
        $client->contact_person_name_acc = $request->contact_person_name_acc;
        $client->organization_name= $request->organization_name;
        $client->fax= $request->fax;
        $client->gst= $request->gst;
        $client->industry= $request->industry;
        $client->landmark= $request->landmark;
        $client->city_town= $request->city_town;
        $client->postal_code=$request->postal_code;
        $client->mobile_number=$request->mobile_number;
        $client->primary_phone=$request->primary_phone;
        $client->primary_email=$request->email_id;
        $client->unique_id= $request->unique_id;
        $client->data_source=$request->data_source;
        $client->address= $request->address;
        $client->select_branch= $request->select_branch;
        $client->organization_type=$request->organization_type;
        $client->email_id=$request->email_id;
        $client->secondary_phone= $request->secondary_phone;
        $client->secondary_email=$request->secondary_email;
        $client->telecaller= $request->telecaller;
        $client->zone=$request->zone;
        $client->country=$request->country;
        $client->pan_no= $request->pan_no;
        $client->Assign_To=$request->Assign_To;
        $client->website=$request->website;
        $client->sales_person=$request->sales_person;
        $client->area=$request->area;
        $client->state=$request->state;
        $client->association_with_medicam=$request->association_with_medicam;
        $client->description= $request->description;
        $client->preference_token =1;
        try {
            $client->save();
            return response()->json(['success'=>'done']);
        }
        catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json(['success'=>'Duplicate entry']);
            }
        }



        

  
        

    }
    public function secondarystore(Request $request)
    {
        print_r("here");
        $client= new Client;    
        $client->contact_person_name = $request->contact_person_name;
        $client->organization_name= $request->organization_name;
        $client->organization_type=$request->organization_type;       
        $client->industry= $request->industry;
        $client->mobile_number=$request->mobile_number;
        $client->primary_email=$request->email_id;
        $client->email_id=$request->email_id;
        $client->address= $request->address;        
        $client->city_town= $request->city_town;        
        $client->postal_code=$request->postal_code;
        $client->Sub_Priority_1=$request->Sub_Priority_1;
        $client->Sub_Priority_2=$request->Sub_Priority_2;

       
      
        $client->unique_id= $request->unique_id;
       
      
       
        $client->description= $request->description;
        $client->preference_token =0;
       
            $client->save();
            return response()->json(['success'=>'done']);
        
  
                return response()->json(['success'=>'Duplicate entry']);
            
        

    }

    public function secondaryorg(Request $request, $secondary_id)
    {
        $convertedid= client::where('id', $secondary_id)->update(['preference_token'=>'1']);
        return response()->json(['success']);
    }



    public function updateForm($id)
    {
        $industries = Industry::all();
        $states = State::where('is_active','1')->get();
        $data_sources= DataSource::where('is_active','1')->get();
        $branches=Branch::where('is_active','1')->get();
        $organization_types=OrganizationType::where('is_active','1')->get();
        $countries=Country::where('is_active','1')->get();
        $zones=Zone::where('is_active','1')->get();
        $sub_priorities=SubPriority::where('is_active','1')->get();
        $association_with_medicams=AssociationWithMedicam::where('is_active','1')->get();
        $Assign_toID= Employee::all();
        
        return view('organization/add_client',compact('industries','states','data_sources','branches','organization_types','countries','zones','sub_priorities','association_with_medicams','Assign_toID'))->with('id',$id);
           
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function org_check($id)
    {
        $organization_types=Client::where('organization_name',$id)->get();
        return response()->json($organization_types);
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organization = Client::find($id);
        return response()->json($organization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Client::whereId($id)->update($request->except(['_token','create_enq']));

        return response()->json(['success' => 'Data is Successfully Updated']);
        
    }


    public function organizationActive(Request $request, $id)
    {
       
        Client::whereId($id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $org_id)
    {
        $org_id =Client::where('id',$org_id)->first();

        if ($org_id != null) {
            $org_id->delete();
            }
    }
}
