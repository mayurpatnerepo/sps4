<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Followup;
use App\client;
use App\enquiry;
use App\enquiry_products;
use Carbon\Carbon;
class FollowupsController extends Controller
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
        $organisations = client::all(); 
       return view("followup/create_followup")->with('organisations',$organisations);
    }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function meeting()
    {
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $followup=new Followup;
       $followup->rem_date=$request->rem_date;
       $followup->rem_time=$request->rem_time;
       $followup->subject=$request->subject;
       $followup->note=$request->remark;
       $followup->nature=$request->nature;
       $followup->organization_name=$request->organization_name1;
       $followup->Contact_Persone_Name=$request->Contact_Persone_Name;
       $followup->organization_id=$request->hidden_orgid;
       $followup->mobile=$request->mobile;
       $followup->save();
       return response()->json(['success'=>'Data have been saved']);
    }

    public function follow_up_enquiry(Request $request)
    {
        $followup=new Followup;
        $followup->rem_date=$request->rem_date;
        $followup->rem_time=$request->rem_time;
        $followup->subject=$request->note;
        $followup->note=$request->note;
        $followup->nature=$request->nature_followup;
        $followup->enquiry_id=$request->enq_id;
        $followup->product=$request->enq_prop;
        $followup->save();
        return response()->json(['success'=>'Data have been saved']);  
        echo "reached here";

    }

    public function follow_up(Request $request)
    {
        $followup=new Followup;
        $followup->rem_date=$request->rem_date;
        $followup->rem_time=$request->rem_time;
        $followup->subject=$request->note;
        $followup->note=$request->note;
        $followup->nature=$request->nature_followup;
        $followup->enquiry_id=$request->enq_id_follow;
         $followup->organization_name=$request->organization_name1z;
       $followup->Contact_Persone_Name=$request->Contact_Persone_Namez;
       $followup->organization_id=$request->hidden_orgidz;
       $followup->mobile=$request->mobilez;
       $followup->product=$request->hidden_product;
        $followup->save();
        return response()->json(['success'=>'Data have been saved']);  
        echo "reached here";

    }
    public function all_followup()
    {
        $Followups_count = Followup::all();
      
        return response()->json($Followups_count);
    }
    
    public function updateForm($id)
    {
        return view('followup/update_followup')->with('id',$id);
    }

    public function display_meeting($id)
    {
        return view('followup/meetings_list')->with('id',$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $followups = Followup::all()->sortByDesc("id");
        $enquiries = enquiry::all(); 
        $enquiry_prop = enquiry_products::all(); 
        $clients = client::all(); 
        return view('followup.list_all_followup',compact('enquiries','clients'))->with('followups',$followups);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $followup = Followup::find($id);
        return response()->json($followup);
        //return view('followup/update_followup')->with('followup',$followup);
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
        $followup = Followup::find($id);
        
        

        $followup->rem_date = $request->input('rem_date');
        $followup->rem_time= $request->input('rem_time');
        $followup->subject= $request->input('subject');
        $followup->note= $request->input('remark');
        $followup->nature= $request->input('nature');
       
        $followup->save();
        
        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    public function count(){
        $followups_count = Followup::whereDate('rem_date', Carbon::today())->get();
        return $followups_count;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function counter()
    {
        $meeting_data=array();
        $meeting_Data["01"]=0;
        $meeting_Data["02"]=0;
        $meeting_Data["03"]=0;
        $meeting_Data["04"]=0;
        $meeting_Data["05"]=0;
        $meeting_Data["06"]=0;
        $meeting_Data["07"]=0;
        $meeting_Data["08"]=0;
        $meeting_Data["09"]=0;
        $meeting_Data["10"]=0;
        $meeting_Data["11"]=0;
        $meeting_Data["12"]=0;
       // echo  date("Y-m-d");
        $Meetings = Followup::select('id', 'rem_date')->get();
       // dd($Meetings);
        foreach($Meetings as $singlemeet)
        {   

          $month_in_loop= $singlemeet->rem_date;
           $month_in_loop=explode("-",$month_in_loop);
           $month_in_loop=$month_in_loop[1];
           
             $month_value=$meeting_Data[$month_in_loop];
             $month_value=$month_value+1;
             $meeting_Data[$month_in_loop]=$month_value;
        }
      
        return response()->json($meeting_Data);
    }
}
