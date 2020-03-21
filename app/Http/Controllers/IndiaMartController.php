<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Client;
use Sunra\PhpSimple\HtmlDomParser;
use App\IndiaMart;
use DB;
use App\Product;
use App\EnquiryDataSource;
use App\ReferredBy;
use App\EnquiryType;
use App\Employee;
use Carbon\Carbon;
class IndiaMartController extends Controller
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
        $html_array=array();
        set_time_limit(200);
        $oClient = new Client([
            'host'          => 'mail.darstek.com',
            'port'          => 143,
            'encryption'    => 'none',
            'validate_cert' => false,
            'username'      => 'log@darstek.com',
            'password'      => 'Password@321',
            'protocol'      => 'imap'
        ]);
        /* Alternative by using the Facade
        $oClient = Webklex\IMAP\Facades\Client::account('default');
        */
        
        //Connect to the IMAP Server
        $oClient->connect();
        
        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders();
        
        //Loop through every Mailbox
        /** @var \Webklex\IMAP\Folder $oFolder */
        foreach($aFolder as $oFolder){
        
            //Get all Messages of the current Mailbox $oFolder
            /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
           // $aMessage = $oFolder->messages()->all()->get();
            $aMessage = $oFolder->query()->from('buyershelp+enq@indiamart.com')->get();
           // print_r($aMessage);
            /** @var \Webklex\IMAP\Message $oMessage */
            foreach($aMessage as $oMessage){
                //echo $oMessage->getSubject().'<br />';
               // echo $oMessage->getFrom()[0]->mail.'<br />';
               // echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
               // echo $oMessage->getHTMLBody();
                $html_body_single= $oMessage->getHTMLBody();
               if( !in_array($html_body_single, $html_array))
               {
                array_push($html_array,$html_body_single);
               }
               // $dom = HtmlDomParser::str_get_html( $oMessage->getHTMLBody(true) );
               
                //Move the current Message to 'INBOX.read'
                        if($oMessage->moveToFolder('INBOX.read') == true){
                            foreach($html_array as $single_body)
                            {
                               // if($count==0)
                               // {
                                
                               // echo htmlentities($single_body);
                               ////byer name
                               $table_split=  explode("enquiry for",$single_body);
                               
                        $buyer_details=  explode("Buyer Details",$single_body);
                                //print_r($buyer_details);
                        $first_index_buyer=$buyer_details[1];
                              // echo htmlentities($first_index_buyer);
                        $test= explode('</span>',$first_index_buyer);
                              // print_r($test);
                              // echo htmlentities($test[0]);
                        $test= explode('<span>',$test[0]);
                               //print_r($test);
                        $test= explode('">',$test[1]);
                               //print_r($test);

                       //Mayur
                       //  if (empty($test[1]) || count($test[1])==0){
            //return back()->withError('Please reload current page');
                        //}

                        if ( ! isset($test[1])) {
                           return view('indiamart/list_indiamart_enquires');
                        }

        //Mayur end
                        $byer_name = $test[1];
                              // echo $byer_name;
                              // echo "<br />";
                               /////byer name ends
                    
                                /////address
                        $test_address= explode('</span>',$first_index_buyer);
                                //print_r($test_address);
                        $new_test_address=$test_address[1];
                                //print_r($new_test_address);
                                //echo htmlentities($new_test_address);
                        $new_test_address=explode('">',$new_test_address);
                                //print_r($new_test_address);
                        $address= $new_test_address[2];
                              // echo $address;
                               //echo "<br />";
                                /////address ends
                    
                                /////mobile
                        $trpostion= substr($first_index_buyer, strpos($first_index_buyer, "Mobile:") + 1);
                              // print_r($trpostion);
                        $test_address= explode('tel:+',$trpostion);  
                        $mobile= $test_address[1];
                             
                        $mobile5= explode('">',$mobile); 
                        $mobile0= explode('"',$mobile5[0]); 
                              //print_r($mobile0);
                        $mobile = $mobile0[0]; 
                              //echo htmlentities($mobile0[0]);
                              //echo "<br />";
                             
                               ///////
                    
                               //////email
                      //  $trpostion= substr($first_index_buyer, strpos($first_index_buyer, "Email:") + 1);
                               //print_r($trpostion);
                       // $test_email = explode(':', $trpostion);
                            //    print_r($test_email);
                    //$test_email=$test_email[4];
                       // $test_email = explode ('">', $test_email);
                                //print_r($test_email);
                               // echo $test_email[0];
                                //echo " <br/>";
                                 $trpostion= substr($first_index_buyer, strpos($first_index_buyer, "Email:") + 1);
                              // print_r($trpostion);
                        $test_email = explode(':', $trpostion);
                                //print_r($test_email);
                              $test_email=  $test_email[2];
                               $test_email= explode ('"', $test_email);
                               //print_r($test_email);
                               //echo htmlentities($test_email[0]);
                               $true_mail=$test_email[0];
                        if(strpos($test_email[0],'@')== true )
                        {
                            $email= $test_email[0];
                             //  echo " <br/>";
                               }else{
                               $email="Note:Email Id not available bt buyer ";
                              // echo " <br/>";
                               }
                               //echo $email;
                               //print_r($test_email);
                               //echo htmlentities($test_email[0]);
                               //echo $test_email[0];
                              // echo "<br />";
                              
                               //$test_email= explode(':',$trpostion);
                               // print_r($test_email);
                                //echo htmlentities($test_email[1]);
                    
                               ////////////
                    
                               ////////enquiry for
                               //print_r($table_split);
                               $test_description= $table_split[1];
                               $test_description1= explode('.',$test_description);
                                //print_r($test_description1);
                                $test_description2= $test_description1[0];
                                $test_description1= explode('</strong>',$test_description2);
                                //print_r($test_description1);
                                $test_description= strip_tags($test_description1[0]);    
                               
                                $test_description= trim($test_description,' " ');   
                                $description= $test_description;
                               // echo $description;
                               // echo "<br />";
                                //echo "|||";
                               //////////////quantity
                               $quantity = '1';          
                               //////////
                    
                               ////////saving data
                               $india_marts= new IndiaMart ;
                               $india_marts->byer_name = $byer_name;
                               $india_marts->address = $address;
                               $india_marts->mobile = $mobile;
                               $india_marts->email = $email;
                               $india_marts->description = $description;
                               $india_marts->quantity = $quantity;
                               $india_marts->save();                    
                               ///////
                               $Organisation_true = DB::table('clients')->get();
                               $indiamart_datas = IndiaMart::all();
                               $Assign_toID = Employee::all();
                               $productID = Product::all();
                               return view('indiamart/list_indiamart_enquires',compact('Organisation_true','Assign_toID','productID'))->with('indiamart_datas',$indiamart_datas);
                       //
                               
                            }
                                
                             
                          
       
                 }else{
                    $Organisation_true = DB::table('clients')->get();
                    $indiamart_datas = IndiaMart::all();
                    $Assign_toID = Employee::all();
                    $productID = Product::all();
                    return view('indiamart/list_indiamart_enquires',compact('Organisation_true','Assign_toID','productID'))->with('indiamart_datas',$indiamart_datas);
                 }
                }
            }
            $Organisation_true = DB::table('clients')->get();
            $indiamart_datas = IndiaMart::all();
            $Assign_toID = Employee::all();
                    $productID = Product::all();
                    return view('indiamart/list_indiamart_enquires',compact('Organisation_true','Assign_toID','productID'))->with('indiamart_datas',$indiamart_datas);
               
                                     //$count=0;
       
        //print_r($html_array);
      
    }

   public function fetch_data(Request $request)
    {
      $from_date= date('Y-m-d H:i:s', strtotime($request->from_date));
 $to_date= date('Y-m-d H:i:s', strtotime($request->to_date));
     if($request->ajax())
     {
      if($request->from_date != '' &&  $request->to_date != '')
      {
       $data = DB::table('india_marts')
         ->whereBetween('created_at', array($from_date, $to_date))
         ->get();
      }
      else
      {
       $data = DB::table('india_marts')->orderBy('created_at', 'desc')->get();
      }
      echo json_encode($data);
     }
    }



    public function createEnquery($enqid)
    {
        $indiamart = IndiaMart::where('id', $enqid);
       
        $productID = Product::all();
        $enquiry_data_sources = EnquiryDataSource::where('is_active','1')->get();
       $referred_bies=ReferredBy::where('is_active','1')->get();
       $enquiry_types=EnquiryType::where('is_active','1')->get();
       $Assign_toID = Employee::all();
        return view('enquiry.createIndiaMartEnq',compact('productID','enquiry_data_sources','referred_bies','enquiry_types','Assign_toID'))->with('indiamart',$indiamart);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $indiamart_datas = IndiaMart::whereDate('created_at', Carbon::today())->get();
       // print_r($indiamart_datas[0]);
        $enq_count= $indiamart_datas->count();
        return response()->json($enq_count);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        $Meetings = IndiaMart::select('id', 'created_at')->get();
        foreach($Meetings as $singlemeet)
        {   
          $month_in_loop=  explode(" ",$singlemeet->created_at);
            $month_in_loop= $month_in_loop[0];
            $month_in_loop=explode("-",$month_in_loop);
            $month_in_loop=$month_in_loop[1];
            $month_value=$meeting_Data[$month_in_loop];
            $month_value=$month_value+1;
            $meeting_Data[$month_in_loop]=$month_value;
        }
      
        return response()->json($meeting_Data);
    }
    
}
