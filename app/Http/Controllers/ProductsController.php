<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;
use File;
use App\Category;
use App\client;
use \stdClass;
use App\Mail\ProposalMail;

class ProductsController extends Controller
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
    
    public function index(Request $request)
    { 
       $products = Product::all();
       $categories=Category::where('is_active','1')->get();
       $organaization = client::all();
        return view('products.product_list',compact('categories','organaization'))->with('products',$products);
    }
   
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.add_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function price()
    {
        $prices = Product::all();
        return response()->json($prices);
    //     $main = array();
    //     $Price_getter = new stdClass();
    //    // dd($prices);
    //     foreach ($prices as $price)
    //     {   
    //        // $Price_getter->$price['id']=$price['price'];
    //        $true_id=$price['product_name'];
    //        echo $true_id;
    //         $true_price =$price['price'];
    //       echo $true_price;
    //     }
      
       // array_push($main, $Price_getter);
       // print_r($main);
        //return response()->json($main);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'broucher' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,docx|max:2048',
          ]);
    
    
          if ($validator->passes()) {
            $input = $request->all();
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('images', $input['image']);
            $input['broucher'] = time().'.'.$request->broucher->getClientOriginalExtension();
            $request->broucher->move('brochure', $input['broucher']);
           
             Product::create($input);
    
    
            return response()->json(['success'=>'done']);
          }
    
    
          return response()->json(['error'=>$validator->errors()->all()]);
        
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
         $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $image ,$broucher)
    {
       
        
        $employee = Product::find($id);
        $employee->product_name = $request->input('product_name');
        $employee->price = $request->input('price');
        $employee->link = $request->input('link');
        $employee->category = $request->input('category');
        $employee->description = $request->input('description');
        
        
        if ($request->hasFile('image'))
            {
            $employee['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('images', $employee['image']);
            $filename = '/images/'.$image;
            File::delete($filename);    
            } 
            if($request->hasFile('broucher'))  
            {
            $employee['broucher'] = time().'.'.$request->broucher->getClientOriginalExtension();
            $request->broucher->move('brochure', $employee['broucher']);                      
            $filename = '/brochure/'.$broucher;
            File::delete($filename);
            } 
            
            $employee->save();
           
            return response()->json(['success'=>'done']);
          
         }
         
    
            
     


    public function productActive(Request $request, $id)
    {
       
        Product::whereId($id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return response($data);
     
    }*/


public function send(Request $request)
    {
        //echo "here";
       // echo $request->prd_id;
      // echo $request->maildata;
        $post1 = Product::where('id',$request->prd_id)->first();
        //$to= $post1->to ;
      // $to= 'ameya.pukale@darstek.com' ;
        $subject= 'Product- '.$post1->product_name;
      $prd_name=$post1->product_name;
      $quo_link=$post1->broucher;
      $pro_link=$post1->link;
      $pro_desc=$post1->description;



        $data = array('pro_name'=>$prd_name, 'quo_link'=>$quo_link, 'pro_link'=>$pro_link, 'pro_desc'=>$pro_desc);
        Mail::send(['text'=>'products.email_body'], $data, function($message) use($post1)
         {

             $message->to($request->cre_email)->subject($subject);
             $message->attach('https://crm.orizzi.com/brochure/'.$post1->broucher);
         });
    }
    
    
    
    public function destroy(Request $request, $post_id)
    {

         $post =Product::where('id',$post_id)->first();
            echo $post;
                if ($post != null) {
                    $post->delete();
                    }

    }

    public function price_for_proposal($product_id)
    {
       return DB::table('products')->select('price')->where('id', $product_id)->first();
    }
}
