<?php

namespace App\Http\Controllers;
use Validator;
use App\Proposal;
use App\Product;
use App\prop_product;
use App\enquiry_products;
use App\client;
use App\enquiry;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProposalMail;
use PDF;
use App\Currency;
use App\Relation;
use App\MainOrder;
use App\OrderParticular;
use App\Employee;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {      
        $currencies=Currency::where('is_active','1')->get();
        $prop_assigned=Employee::all();
        $relations=Relation::where('is_active','1')->get();
        if($id == 0){
            $entryLevel='1';
            $products = Product::all();
            $organaization = client::all();
            $enqId = 0;
            return view('proposals/index',compact('prop_assigned','enqId','organaization','entryLevel','currencies','relations'))->with('products',$products);


        }else if($id > 0){

            $entryLevel='0';
            $products = Product::all();
            $prop_assigned=Employee::all();
            $enqId =$id;
            $organaization = client::all();  
            $enquiry_details = enquiry::all();
            $enquiry_products = enquiry_products::where('enquiry_id',$id)->get();
            //print_r($enquiry_products);         
           return view('proposals/index1',compact('prop_assigned','enquiry_products','enquiry_details','enqId','organaization','entryLevel','currencies','relations'))->with('products',$products);



        }
        else{
            echo "no is negative";
        }
      

    }
   
          
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('proposals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$tim)
    {
      
     
                $proposal = new Proposal;
                $proposal->subject = $request->prop_sub;
                $proposal->related = $request->prop_related;
                $proposal->status  = $request->prop_status;
                $proposal->assigned= $request->prop_assigned;
                $proposal->to     =  $request->prop_to;
                $proposal->date=  $request->prop_date;
                $proposal->open_till= $request->prop_opentill;
                $proposal->address  = $request->prop_address;
                $proposal->currency = $request->prop_currency;
              
                $proposal->city = $request->prop_city;
                $proposal->state = $request->prop_state;
                $proposal->country = $request->prop_country;
                $proposal->zipcode = $request->prop_zip;
                $proposal->email   = $request->prop_email;
                $proposal->phone   = $request->prop_phone;  
              
                $proposal->sub_total   = $request->sub_total;                
                            
               
                $proposal->Fr_charges   = $request->Fr_charges;  
                
                $proposal->enqid_hidden   = $request->enqid_hidden;  
                $proposal->entryLevelHidden   = $request->entryLevelHidden;
                $proposal->organization_name   = $request->organization_name1;  
                $proposal->organization_id   = $request->hidden_orgid;  
                $proposal->path = 'pdf/'.$tim.'.pdf';
               // $path='pdf/'.$tim.'.pdf';
               if( $proposal->save()){
                   
              //  $proposal=Proposal::get('id');
              $id = DB::getPdo()->lastInsertId();
             
              
                   //print_r($id);
                   foreach ($request->product as $key => $value) {
                    $data=array(
                        'particulars'=>$value,
                        'qty'=>$request->qty[$key],
                        'price'=>$request->price[$key],
                        'total'=>$request->total[$key],
                        'sgst' => $request->tax_sgst[$key],
                        'cgst' => $request->tax_cgst[$key],
                        'igst' => $request->tax_igst[$key],
                        'discount' => $request->discount[$key],


                      
                        'proposal_id'=>$id);
                    prop_product::insert($data);        
                    
                }
               
                   
                   
               }
                
               return response()->json(['success'=> 'data saved successfully']);
    }

    public function direct_order(Request $request, $dir_tim)
    {
        $proposal_order = new Proposal;
        $proposal_order->subject = $request->prop_sub;
        $proposal_order->related = $request->prop_related;
        $proposal_order->status  = $request->prop_status;
        $proposal_order->assigned= $request->prop_assigned;
        $proposal_order->to     =  $request->prop_to;
        $proposal_order->date=  $request->prop_date;
        $proposal_order->open_till= $request->prop_opentill;
        $proposal_order->address  = $request->prop_address;
        $proposal_order->currency = $request->prop_currency;
      
        $proposal_order->city = $request->prop_city;
        $proposal_order->state = $request->prop_state;
        $proposal_order->country = $request->prop_country;
        $proposal_order->zipcode = $request->prop_zip;
        $proposal_order->email   = $request->prop_email;
        $proposal_order->phone   = $request->prop_phone;  
      
        $proposal_order->sub_total   = $request->sub_total;                
                    
       
        $proposal_order->Fr_charges   = $request->Fr_charges;  
        
        $proposal_order->enqid_hidden   = $request->enqid_hidden;  
        $proposal_order->entryLevelHidden   = $request->entryLevelHidden;
        $proposal_order->organization_name   = $request->organization_name1;  
        $proposal_order->organization_id   = $request->hidden_orgid;  
        $proposal_order->path = 'pdf/'.$dir_tim.'.pdf';
       // $path='pdf/'.$tim.'.pdf';
       $id=0;
       if( $proposal_order->save()){
           
      //  $proposal=Proposal::get('id');
      $id = DB::getPdo()->lastInsertId();
     
      
           //print_r($id);
           foreach ($request->product as $key => $value) {
            $data=array(
                'particulars'=>$value,
                'qty'=>$request->qty[$key],
                'price'=>$request->price[$key],
                'total'=>$request->total[$key],
                'sgst' => $request->tax_sgst[$key],
                'cgst' => $request->tax_cgst[$key],
                'igst' => $request->tax_igst[$key],
                'discount' => $request->discount[$key],


              
                'proposal_id'=>$id);
            prop_product::insert($data);        
            
        }

        $order_direct = new MainOrder;
        $order_direct->contact_person_name = $request->prop_to;
        $order_direct->org_id = $request->hidden_orgid;
        $order_direct->organization_name = $request->organization_name1;
        $order_direct->mobile_number = $request->prop_phone;
        $order_direct->email_id = $request->prop_email;
        $order_direct->address = $request->prop_address;
        $order_direct->subtotal = $request->sub_total;
        
        $order_direct->Warranty_date = $request->warranty_date;
        $order_direct->grand_total = $request->total_amount;
        $order_direct->enqid_hidden = $request->enqid_hidden;
        $order_direct->entryLevelHidden = $request->entryLevelHidden;
        $order_direct->proposalIDHidden = $id;
        $order_direct->exp_date = $request->exp_date7;

        if($order_direct->save()){

            foreach($request->product as $key=>$value){
                $data = array(
                    'products' => $value,
                    'qty' => $request->qty[$key],
                    'sgst'=> $request->tax_sgst[$key],
                    'igst' => $request->tax_igst[$key],  
                    'cgst' => $request->tax_cgst[$key],  
                    'discount' => $request->discount[$key],  
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                    'orders_id' => $order_direct->id
                );
                OrderParticular::insert($data);  
            }
        }
        }
                
        return response()->json(['success'=> 'data saved successfully']);
    }


    public function pdf_for_directorder(Request $request)

    {   
        $pdfdata = ['address' => $request->prop_address,
        'prop_to'=> $request->prop_to,
       'city' => $request->prop_city,
        'state' => $request->prop_state,
       'country' => $request->prop_country,
       'zip' =>  $request->prop_zip,
         'to' => $request->prop_to,
         'date' => $request->prop_date,
         'subject' =>$request->prop_sub,
         
         'product'=>$request->product,
         'qty'=>$request->qty,
         'price'=>$request->price,
         'discount' => $request->discount,
         'sgst' => $request->tax_sgst,
         'igst' => $request->tax_igst,
         'cgst' => $request->tax_cgst,
         'Fr_charges' => $request->Fr_charges,
         
         'total' => $request->total,

         'grand_total'=>$request->total_amount       
        ];
        // $pdfdata = [];
        // $pdfdata = ['subject'=>$request->prop_subject];
         
        // $pdfdata = ['product'=>$request->product];
        // $pdfdata = ['qty'=>$request->qty];
        // $pdfdata = ['price'=>$request->price];
        // $pdfdata = ['tax_amount'=>$request->tax_amount];
        // $pdfdata = ['grand_total'=>$request->total_amount];

            $t=time();
            //dd($pdfdata);

        $pdf = PDF::loadView('proposals.quotation', array('pdfdata' => $pdfdata));
  
        $pdf->save('pdf/'.$t.'.pdf', compact('pdfdata'));

        return $this->direct_order($request,$t);

       //return view('proposals.quotation')->with($pdfdata);
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
    public function destroy(Request $request, $post_id)
    {
        $prop_pro = prop_product::where('proposal_id',$post_id);
        
            if ($prop_pro != null) {
                $prop_pro->delete();
            $post = Proposal::where('id',$post_id)->first();
            if ($post != null) {
                    $post->delete();
                    }

            }

            return response()->json(['success'=> 'data deleted']);
        
    }
    
    public function display()
    {
        $list=Proposal::all();
        $prop_pro = prop_product::all();
        return view('proposals/list_proposal',compact('prop_pro'))
        ->with('list',$list);
    }

    public function view(Request $request, $id)
    {
        $user = DB::table('users')->find($id);

        return view(public_path().'proposals/quatotion');
    }

    public function send(Request $request)
    {
        //echo $request->id;
        $post1 = Proposal::where('id',$request->id)->first();
        //$to= $post1->to ;
       // $to= 'ameya.pukale@darstek.com' ;
        $subject= $post1->subject;
       $org_name=$post1->organization_name;



        $data = array('name'=>$org_name);
        Mail::send(['text'=>'proposals.email_body'], $data, function($message) use($post1)
         {

             $message->to($post1->email)->subject($post1->subject);
             $message->attach('https://crm.orrizi.com/'.$post1->path);
         });
    }
    

    public function sendsms(Request $request)
    {
        $post1 = Proposal::where('id',$request->id)->first();
        
        $username="darshan.kadam@darstek.com";
        //$username="hemantmedicam@yahoo.co.in";
        $hash="a4062df1001185b6f4cada45ff3cd9e3c2b1c99f19a636cbe7cf832537bd3d92";
        //$hash="d5e9cb55c64838e8d09fea36b51bcfe5c1cd1251701c6d561db237aecf5fa0e1";
        
        $test="0";
          // Account details
      $apiKey = urlencode('3p6o76+dusk-fxSollzvgv9mdHKNyGN42XN2kd74IM');
      //$apiKey = urlencode('Ui8+S+xjiv8-9FV1rKEjvmEItF9pXrlV0naVwmYw9N');
      
      // Message details
      //$message1 ="Hi $post1->organization_name,%nThe Product of your choice has been listed in the following link.%ndownload the pdf for your reference.%n $post1->path%nThank you,%nMedicam";
      $message1 ="Hi $post1->organization_name,%nGreetings from our company!!!%nPlease find below is the link for requested Quotation.%nhttps://crm.orrizi.com/$post1->path%nThank you,%nCompany Name";
      
      $numbers = urlencode($post1->phone);
      $sender = urlencode('DARSTK');
      $message = rawurlencode($message1);
          
      //$numbers = implode(',', $numbers);
   
      // Prepare data for POST request
      //$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message, "username"=> $username, "hash" => $hash, "test" => $test);
        //  print_r( $data);
        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
          echo $data;
      // Send the POST request with cURL
      $ch = curl_init('https://api.textlocal.in/send/?'.$data);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($ch);
                  curl_close($ch);
      
      
      // Process your response here
      echo $response;
  
	// Process your response here
    //print_r($response);exit;



    }




    public function view_quotation(Request $request)

    {   
        $pdfdata = ['address' => $request->prop_address,
       'city' => $request->prop_city,
        'state' => $request->prop_state,
       'country' => $request->prop_country,
       'zip' =>  $request->prop_zip,
       'particulars' =>  $request->particulars,
         'to' => $request->prop_to,
         'date' => $request->prop_date,
         'subject' =>$request->prop_sub,
         
         'product'=>$request->product,
         'qty'=>$request->qty,
         'price'=>$request->price,
         'discount' => $request->discount,
         'sgst' => $request->tax_sgst,
         'igst' => $request->tax_igst,
         'cgst' => $request->tax_cgst,
         'Fr_charges' => $request->Fr_charges,
         
         'total' => $request->total,

         'grand_total'=>$request->total_amount       
        ];
        // $pdfdata = [];
        // $pdfdata = ['subject'=>$request->prop_subject];
         
        // $pdfdata = ['product'=>$request->product];
        // $pdfdata = ['qty'=>$request->qty];
        // $pdfdata = ['price'=>$request->price];
        // $pdfdata = ['tax_amount'=>$request->tax_amount];
        // $pdfdata = ['grand_total'=>$request->total_amount];

            $t=time();
            //dd($pdfdata);

        $pdf = PDF::loadView('proposals.quotation', array('pdfdata' => $pdfdata));
  
        $pdf->save('pdf/'.$t.'.pdf', compact('pdfdata'));

        return $this->store($request,$t);

       //return view('proposals.quotation')->with($pdfdata);
    }

 public function sendmail_for_wa(Request $request)
 {
        echo "here";
        echo $request->prd_id;
        $wa_email = $request->cre_email;
        echo $wa_email;
      // echo $request->maildata;
        $post1 = Product::where('id',$request->prd_id)->first();
        //$to= $post1->to ;
      // $to= 'ameya.pukale@darstek.com' ;
        $subject= 'Company Product- '.$post1->product_name;
      $prd_name=$post1->product_name;
      $quo_link=$post1->broucher;
      $pro_link=$post1->link;
      $pro_desc=$post1->description;
    //   $arra = [];
    //     array_push($arra,$request);
    //     array_push($arra,$subject);
        
        


        $data = array('pro_name'=>$prd_name, 'quo_link'=>$quo_link, 'pro_link'=>$pro_link, 'pro_desc'=>$pro_desc);
        Mail::send(['text'=>'products.email_body'], $data, function($message) use($request,$subject,$post1)
         {

             $message->to($request->cre_email)->subject($subject);
             $message->attach('https://crm.orrizi.com/brochure/'.$post1->broucher);
         });
    }
}
