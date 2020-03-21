<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\client;
use App\Employee;
class MeetingsController extends Controller
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
        $clients = client::all();
        $employees=Employee::all();
        return view("followup/followup_meeting",compact('clients', 'employees'));
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
        $notifications="0";
        $followup=new Meeting;
       $followup->meeting_date=$request->meeting_date;
       $followup->meeting_time=$request->meeting_time;
       $followup->meeting_with=$request->meeting_with;
       $followup->assgin_to=$request->assign_to;
       $followup->subject=$request->subject;
       $followup->notification=$notifications;
       $followup->remark=$request->remark;
       $followup->nature=$request->nature;
       $followup->save();
       return response()->json(['success'=>'Data have been saved']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $Meetings = Meeting::all();
      
        return view('followup.meetings_list')->with('meetings',$Meetings);
    }
    public function show_today()
    {
        $Meetings = Meeting::all();
      
        return view('followup.today_meetings')->with('meetings',$Meetings);
    }
    public function all_meeting()
    {
        $Meetings = Meeting::all();
      
        return response()->json($Meetings);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $Meeting = Meeting::find($id);
        return response()->json($Meeting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForm(Request $request, $id)
    {
        $Assign_toID = Employee::all();
        $Contact_person = client::all();
        return view('followup/update_meeting',compact('Assign_toID','Contact_person'))->with('id',$id);
    }
    public function update(Request $request, $id)
    {
        
        
        $meeting = Meeting::find($id);
        
        

        $meeting->meeting_date = $request->input('meeting_date');
        $meeting->meeting_time= $request->input('meeting_time');
        $meeting->meeting_with= $request->input('meeting_with');
        $meeting->assgin_to= $request->input('assign_to');
        $meeting->subject= $request->input('subject');
        $meeting->remark= $request->input('remark');
        $meeting->nature= $request->input('nature');
       
        $meeting->save();
        
        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post =Meeting::where('id',$id)->first();

        if ($post != null) {
            $post->delete();
            }
    }
    public function count()
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
        $Meetings = Meeting::select('id', 'meeting_date')->get();
        foreach($Meetings as $singlemeet)
        {
            $month_in_loop= $singlemeet->meeting_date;
            $month_in_loop=explode("-",$month_in_loop);
            $month_in_loop=$month_in_loop[1];
            $month_value=$meeting_Data[$month_in_loop];
            $month_value=$month_value+1;
            $meeting_Data[$month_in_loop]=$month_value;
        }
      
        return response()->json($meeting_Data);
    }
}
