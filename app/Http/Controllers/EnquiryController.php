<?php

namespace App\Http\Controllers;
use App\enquiry;
use App\enquiry_products;
use App\Product;
use App\client;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\EnquiryDataSource;
use App\ReferredBy;
use App\EnquiryType;
use App\Employee;
use App\comment;

use App\User;
use Carbon\Carbon;

class EnquiryController extends Controller
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
        $id= "0";
        $productID = Product::all();
        $Select_Contact_personID = client::all();
        $enquiry_data_sources = EnquiryDataSource::where('is_active','1')->get();
        $referred_bies=ReferredBy::where('is_active','1')->get();
        $enquiry_types=EnquiryType::where('is_active','1')->get();
        $Assign_toID = Employee::all();
       

      
        return view('enquiry/createEnquiry',compact('productID','Select_Contact_personID','enquiry_data_sources','referred_bies','enquiry_types','Assign_toID') )->with('id',$id);
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
public function fetch_data_enq(Request $request)
    {
      $from_date= date('Y-m-d H:i:s', strtotime($request->from_date));
 $to_date= date('Y-m-d H:i:s', strtotime($request->to_date));
     if($request->ajax())
     {
      if($request->from_date != '' &&  $request->to_date != '')
      {
       $data = DB::table('enquiries')
         ->whereBetween('created_at', array($from_date, $to_date))
         ->get();
      }
      else
      {
       $data = DB::table('enquiries')->orderBy('created_at', 'desc')->get();
      }
      echo json_encode($data);
     }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enquiry = new enquiry;
        $enquiry->Select_Contact_person = $request->Select_Contact_person;
        $enquiry->organization_name= $request->organization_name1;
        $enquiry->organisation_id= $request->hidden_orgid;
        $enquiry->EnquiryDataSource_Name = $request->EnquiryDataSource_Name;
        $enquiry->ReferredBy_Name = $request->ReferredBy_Name;
        $enquiry->EnquiryType_Name = $request->EnquiryType_Name;
      
        $enquiry->Expected_closed_Date = $request->Expected_closed_Date;
        
       
        if( $enquiry->save()){
            
            $id = DB::getPdo()->lastInsertId();

            $comment = new comment;
            $comment->comments = $request->Description_Note; 
            $comment->nature = $request->nature_comment; 
            $loged_in_name = Auth::user()->name;
            $loged_in_email = Auth::user()->email;
            $comment->username = $loged_in_name;
            $comment->useremail = $loged_in_email;
            $comment->enquery_id = $id; 
            $comment->save();
                 
                 foreach ($request->product as $key => $value) {
                  $data=array(
                      'Product'=>$value,
                      'Unit'=>$request->Unit[$key],
                      'price'=>$request->price[$key],
                      'Assign_To'=>$request->Assign_to[$key],
                      'Requested_Quantity'=>$request->Requested_Quantity[$key],
                      'Co_ordinated_with'=>$request->Co_ordinated_with[$key],
                      'nature'  =>$request->nature[$key],
                      'enquiry_id'=>$id);
                      enquiry_products::insert($data);        
                  
              }
             
                  
             }

             return response()->json(['success'=>'done']);
        
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
    public function display()
    {   
        $enquiries = enquiry::all();
        $enquiry_products = enquiry_products::all();
        return view('enquiry/listEnquiry',compact('enquiries','enquiry_products'))->with('enquiries',$enquiries);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $Select_Contact_personID = client::all();
        $productID = Product::all();
        $enquiries = enquiry::find($id);
        
        
       
        $enquiry_products = enquiry_products::where('enquiry_id',$enquiries->id)->get();
        return response()->json(array('enquiries'=>$enquiries,'enquiry_products'=>$enquiry_products,'client'=>$Select_Contact_personID));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForm(Request $request, $id)
    {     $Select_Contact_personID = client::all();
         $productID = Product::all();
         $enquiry_data_sources = EnquiryDataSource::where('is_active','1')->get();
        $referred_bies=ReferredBy::where('is_active','1')->get();
        $enquiry_types=EnquiryType::where('is_active','1')->get();
        $Assign_toID = Employee::all();
        $user = User::all();
        $data = comment::where('enquery_id', $id)->orderBy('created_at', 'desc')->get();
        $enquiry = enquiry::where('id', $id)->first();
       // $comment_date= Carbon::parse($data->created_at)->format('d/m/Y');
        return view('enquiry/createEnquiry',compact('enquiry','user','data','productID','Select_Contact_personID','enquiry_data_sources','referred_bies','enquiry_types','Assign_toID'))->with('id',$id);
    }

    public function update(Request $request, $id)
    {     

        
        $enquiry = enquiry::find($id);
        $enquiry->Select_Contact_person = $request->input('Select_Contact_person');
        $enquiry->organization_name= $request->organization_name1;
       
        $enquiry->EnquiryDataSource_Name = $request->input('EnquiryDataSource_Name');
        $enquiry->ReferredBy_Name = $request->ReferredBy_Name;
        $enquiry->EnquiryType_Name = $request->EnquiryType_Name;
       
        $enquiry->Expected_closed_Date = $request->input('Expected_closed_Date');
        
        
        if( $enquiry->save()){
            
       
        
            $enq_id =enquiry_products::where('enquiry_id',$id);

                     if ($enq_id != null) {
                            $enq_id->delete();
                         }

                 foreach ($request->product as $key => $value) {
                  $data=array(
                      'Product'=>$value,
                      'Unit'=>$request->Unit[$key],
                      'Price'=>$request->price[$key],
                      'Assign_To'=>$request->Assign_to[$key],
                      'Requested_Quantity'=>$request->Requested_Quantity[$key],
                      'Co_ordinated_with'=>$request->Co_ordinated_with[$key],  
                      'nature'=>$request->nature[$key],  
                      'enquiry_id'=>$enquiry->id);
                     enquiry_products::insert($data);     
                  
              }
             
                  
             }
       
        
       return response()->json(['success' => 'Data is Successfully Updated']);
    }


     
    public function update_nature(Request $request)
    {     
       
        $enquiryID = $request->nature_enq_id;
        //$enquiry = enquiry::find($enquiryID);
        //$enquiry->nature = $request->input('nature2');
        $enquiry_nature= enquiry_products::where('id', $enquiryID)
            ->update(['nature' => $request->input('nature2')]);
     
       
        return response()->json(['success' => 'Data is Successfully Updated']);
       
    
    }


    public function true_org(Request $request)
    {     
        $client_true = new client;
        $client_true->organization_name = $request->true_org;
        $client_true->contact_person_name = $request->Contact_person_true;
        $client_true->mobile_number = $request->Mob_true;
        $client_true->primary_email =$request->email_true;
        $client_true->email_id =$request->email_true;
        $client_true->address= $request->address_true;
        $client_true->preference_token= "1";
        $client_true->save();
     
       
        return response()->json(['success' => 'Data is Successfully Updated']);
        
            enquiry_products::insert($data);     
    
    }
    

    public function true_enq(Request $request)
    {    
        $datasource="IndiaMart";
        $refered_by="IndiaMart";
        $Enquiry_type="IndiaMart";
     $contact_person= $request->Contact_person;
     $org_name= $request->org_enq_im;
     $org_id= $request->org_enq_hidden;
     $true_product= $request->pro_enq;
     $quantity= $request->quantity_true;
     $price_true= $request->price_true;
     $assign_to= $request->assign_to;
     $coo_staff= $request->coo_Staff;
     $enq_nature= $request->enq_nature;
       
     $enquiry = new enquiry;
     $enquiry->Select_Contact_person = $contact_person;
     $enquiry->organization_name= $org_name;
     $enquiry->organisation_id= $org_id;
     $enquiry->EnquiryDataSource_Name = $datasource;
     $enquiry->ReferredBy_Name = $refered_by;
     $enquiry->EnquiryType_Name = $Enquiry_type;

     if( $enquiry->save()){
            
        $id = DB::getPdo()->lastInsertId();


             
            
              $data=array(
                  'Product'=>$true_product,
                  'Unit'=>$quantity,
                  'price'=>$price_true,
                  'Assign_To'=>$assign_to,
                  'Requested_Quantity'=>$price_true,
                  'Co_ordinated_with'=>$coo_staff,
                  'nature'  =>$enq_nature,
                  'enquiry_id'=>$id);
                  enquiry_products::insert($data);        
              
        
         
              
         }
   
         return response()->json(['success'=>'done']);
    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_1)
    {   
        $id =base64_decode($id_1);
        $Enqid = enquiry_products::where('enquiry_id',$id);
        
        if ($Enqid != null) {
            $Enqid->delete();
        $Enq_1id = enquiry::where('id',$id);
        if ($Enq_1id != null) {
                $Enq_1id->delete();
                }

        }

        return $this->display();
        
    }

    public function create_enqury_from_organization($orgId)
    {
       
        $organization_details= client::where('id',$orgId)->first();
        $referred_bies=ReferredBy::where('is_active','1')->get();
        $enquiry_types=EnquiryType::where('is_active','1')->get();
        $data_sources=EnquiryDataSource::where('is_active','1')->get();
        $productID = Product::all();
        $Assign_toID = Employee::all();
        $details = client::all();
        
        
        //print_r ($organization_details);
        return view('enquiry/createEnquiry_from_org',compact('Assign_toID','organization_details','referred_bies','enquiry_types','data_sources','productID'))->with('id',$orgId);
    }
}
