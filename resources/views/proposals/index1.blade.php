@extends('layouts.master')

@section('content')

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style>
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}
</style>
<script type="text/javascript">
  

</script>
<style>
.required:after {color: #e32;content:'*';display:inline;}
</style>

<br>
    <span id="form_output"></span>
    <form role="form" id="sub_form">
    {{-- hidden fields --}}
        <input type="text" name="enqid_hidden" id="enqid_hidden" value="{{$enqId}}" hidden/>
        <input type="text" name="entryLevelHidden" id="entryLevelHidden" value="{{$entryLevel}}" hidden/>
   <div class="card card-secondary" id="container_div">
              <div class="card-header" id="headername">
                <h3 class="card-title">Add Quotation1</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  <!-- text input -->
                    <div class="form-group row">
                    {{csrf_field()}}
                      <div class="col-6">
                            <label for="prop_sub" class="form-label required">Subject</label>
                            <input type="text" class="form-control" id="prop_sub" name="prop_sub" placeholder="Proposal's Subject" maxlength="180" >
                        </div>
                        <div class="col-6">
                            <label class="form-label">Related</label>
                            <input list="prop_related" name="prop_related" class="form-control">
                                  <datalist id="prop_related">                                 
                                  @foreach($relations as $relation)
                                      <option  value="{{$relation->Relation_Name}}"></option>
                                  @endforeach
                                  </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                        <div class="row" id="myTooltips">
                          <div class="col-12">
                            <label class="form-label required">Organization Name</label>
                          </div>
                          <div class="col-9">
                           
                                {{csrf_field()}} 
                                  @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                            <input list="organization_name" value="{{$enquiry_detail->organization_name}}" onchange="populate_details()"  name="organization_name1" id="organization_name1" class="form-control populate" placeholder="Organization Name" maxlength="180"> 
                                    @endif
                                @endforeach
                            <datalist id="organization_name" >
                           @foreach ($organaization as $organisation)
                            <option value="{{$organisation->organization_name}}" label="{{$organisation->id}}">{{$organisation->id}}</option>
                             @endforeach
                            </datalist>
                           
                          </div>
                
                            <button class="btn btn-default" type="button" title="Create Organization" data-toggle="modal" data-target="#ajaxModel"><i class="fas fa-plus"></i></button>
                            @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                            <input type="text" id="hidden_orgid" value="{{$enquiry_detail->organisation_id}}"  name="hidden_orgid" hidden/>
                                    @endif
                                @endforeach 
                          </div>
                        </div>
                        
                        <div class="col-3">
                            <label for="prop_to" class="form-label required">To</label>
                            
                                @foreach ($enquiry_details as $enquiry_detail)
                                     @if($enquiry_detail->id==$enqId)
                                     @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                                        
                            <input type="text" class="form-control" value="{{$organisation->contact_person_name}}" name="prop_to" id="prop_to" placeholder="To" maxlength="180">
                                    @endif
                                  @endforeach
                                 @endif  
                                @endforeach
                        </div>
                        
                          
                        <div class="col-6">
                            <label class="form-label required">Address</label>
                                @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                                            
                                        
                                 
                            <input type="text" class="form-control" value="{{$organisation->address}}" name="prop_address" id="prop_address" placeholder="Address" maxlength="400">
                                  @endif
                                  @endforeach
                                    @endif  
                           @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Status</label>
                                <select class="form-control" name="prop_status" id="prop_status">
                                <option>Draft</option>
                                <option>Sent</option>
                                <option>Open</option>
                                <option>Revised</option>
                                <option>Declined</option>
                                <option>Accepted</option>
                                </select>
                        </div>
                        <div class="col-3">
                        <label>Assigned</label>
                            <input list="Assign_To" class="form-control" name="prop_assigned" id="prop_assigned" placeholder="Assigned to" maxlength="400">
                                  <datalist id="Assign_To" name="prop_assigned">
                                  @foreach($prop_assigned as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                        </div>
                        <div class="col-3">
                            <label for="prop_date" class="form-label required">Date</label>
                            <div class="input-group date" data-provide="datepicker">
                               <input type="text" id="prop_date" name="prop_date" class="form-control">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div> 

                        </div>
                        <div class="col-3">
                            <label>Open Till</label>
                            <div class="input-group date" data-provide="datepicker">
                               <input type="text" id="prop_opentill" name="prop_opentill" class="form-control">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div> 

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label class="form-label required">Currency</label>
                            <input list="prop_currency" name="prop_currency" class="form-control">
                                  <datalist id="prop_currency">                                 
                                  @foreach($currencies as $currency)
                                      <option  value="{{$currency->Currency_Name}}"></option>
                                  @endforeach
                                  </datalist>
                        </div>                        
                        <div class="col-3">
                                <label class="form-label required">City </label>
                                     @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                                            
                                <input type="text" class="form-control" value="{{$organisation->city_town}}" name="prop_city" id="prop_city" placeholder="City" maxlength="100" onKeyPress="return ValidateAlpha(event);">
                                      @endif
                                  @endforeach
                                    @endif  
                           @endforeach
                        </div>
                        <div class="col-3">
                        
                                <label class="form-label required">State </label>
                                  @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                               <input type="text" class="form-control" value="{{$organisation->state}}"  name="prop_state" id="prop_state" placeholder="State" maxlength="100" onKeyPress="return ValidateAlpha(event);">
                                     @endif
                                  @endforeach
                                    @endif  
                           @endforeach
                        
                        </div>
                       
                        <div class="col-3">
                            <label class="form-label required">Country</label>
                              @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                                <input type="text" class="form-control" value="{{$organisation->country}}" name="prop_country" id="prop_country" placeholder="Country" maxlength="100" onKeyPress="return ValidateAlpha(event);">
                                    @endif
                                  @endforeach
                                    @endif  
                           @endforeach
                      
                        </div>

                    </div>   
                    <div class="form-group row">
                         <div class="col-3">
                            <label class="form-label required">Zip Code </label>
                           @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                            <input type="text" class="form-control" value="{{$organisation->postal_code}}" name="prop_zip" id="prop_zip" placeholder="Zip Code" maxlength="15" onkeypress="return isNumber(event)">
                                       @endif
                                  @endforeach
                                    @endif  
                           @endforeach   
                        </div>
                        <div class="col-3">
                            <label for="prop_email" class="form-label">Email</label>
                               @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                            <input type="text" class="form-control" value="{{$organisation->primary_email}}" name="prop_email" id="prop_email" onblur="validate_email()" placeholder="Email">
                                    @endif
                                  @endforeach
                                    @endif  
                           @endforeach  
                                
                        </div>
                        <div class="col-3">
                            <label for="prop_phone" class="form-label">Phone </label>
                             @foreach ($enquiry_details as $enquiry_detail)
                                      
                                    @if($enquiry_detail->id==$enqId)
                                    @foreach ($organaization as $organisation)
                                        @if ($enquiry_detail->organisation_id==$organisation->id)
                            <input type="text" class="form-control" value="{{$organisation->mobile_number}}" name="prop_phone" id="prop_phone" placeholder="Phone Number" maxlength="15" onkeypress="return Validate(event)">
                                         @endif
                                  @endforeach
                                    @endif  
                           @endforeach  
                        </div>
                         <div class="col-3">
                            <input type="text" class="form-control" name="warranty_date" id="warranty_date" placeholder="Warranty Date" maxlength="15" onkeypress="return Validate(event)" hidden>
                            <input type="text" class="form-control" name="exp_date7" id="exp_date7" placeholder="Expiry Date" maxlength="15" onkeypress="return Validate(event)" hidden>

                         </div> 
                    </div> 
                     <div class="form-group row">
                        <div class="col-6">
                        </div>
                         <div class="col-6">
                        </div>
                    </div>  
                  

  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            
             <th class="text-center"> Select </th>
            <th class="text-center"> Product </th>
            <th class="text-center"> Qty </th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Discount </th>
            <th class="text-center"> Discounted Amount </th>
            <th class="text-center"> SGST </th>
            <th class="text-center"> CGST </th>
            <th class="text-center"> IGST </th>
            <th class="text-center"> GST Amount </th>
            <th class="text-center"> Total </th>
          </tr>
        </thead>
        <tbody>
        <?php //print_r($enquiry_products); ?>
        @foreach ($enquiry_products as $enquiry_product)
            
       
          <tr>
            <td><input type="checkbox" name="record"></td>
            <td>
             {{-- <select name='product[]' class="form-control product">  --}}
              <input list="browsers" value="{{$enquiry_product->Product}}" name="product[]" id="product" class="form-control product" onchange ="price_populate()" autocomplete="off">
              <datalist id="browsers">
              <option value="0" selected="true" disabled="true">Select Product </option>
              @foreach (  $products as $product )
              
              <option data-price="{{$product->price}}" value="{{$product->product_name}}" label="{{$product->id}}" data-attri_id="{{$product->id}}">{{$product->product_name}}</option> 
               
             @endforeach
             </datalist>
            </td>
            {{-- <td><input type="text" name='product[]' id="product" placeholder='Enter Product' class="form-control product"/></td> --}}
            <td><input type="number" value="{{$enquiry_product->Requested_Quantity}}" name='qty[]' id="qty" placeholder='Quantity' class="form-control qty" step="0" min="0"/></td>
            <td>
            
           
            <input type="number" name='price[]' value="{{$enquiry_product->Price}}" id="price" value="" placeholder='Price' class="form-control Price" step="0.00" min="0" >
           
            </td>
            <td>
            
           
            <input type="number" name='discount[]' id="discount" value="" placeholder='Discount' class="form-control discount" step="0.00" min="0">
           
            </td>
             <td>
            <input type="number" name='discount_amt[]' id="discount_amt" value="" placeholder='Discounted Amount' class="form-control discount_amt" step="0.00" min="0" >
            </td>
            <td>
            
           
            <input type="number" name='tax_sgst[]' id="tax_sgst" value="" placeholder='SGST' class="form-control sgst" step="0.00" min="0">
           
            </td>
            <td>
            
           
            <input type="number" name='tax_cgst[]' id="tax_cgst" value="" placeholder='CGST' class="form-control cgst" step="0.00" min="0">
           
            </td>
             <td>
            
           
            <input type="number" name='tax_igst[]' id="tax_igst" value="" placeholder='IGST' class="form-control igst" step="0.00" min="0">
           
            </td>
             <td>
            <input type="number" name='gst_amt[]' id="gst_amt" value="" placeholder='Amount' class="form-control gst_amt" step="0.00" min="0" >
            </td>
            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
  <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-default pull-left addrow">Add Row</button>
      <button id="delete_row" type="button" class="btn btn-default pull-right remove">Delete Row</button>
     
    </div>
  </div>
  <div class="row clearfix pull-right" style="margin-top:20px">
    <div class="pull-right col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
           <tr>
            <th class="text-center">Sub Total</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Freight</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" name="Fr_charges" id="Fr_charges" placeholder="">
                <div class="input-group-addon"></div>
              </div></td>
          </tr>
         
            <th class="text-center">Grand Total</th>
            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
        </tbody>
      </table>
      
    </div>
    
  </div>
</div>
 </form>
 <div class="modal fade" id="ajaxModel" aria-hidden="true" style="margin-left:30%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Create Organization</h4>
            </div>
            <div class="modal-body">
                <form id="orgForm" name="orgForm" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group row">
                      {{csrf_field()}}
                          <div class="col-6">
                              <label class="form-label required">Organization Name</label>
                              <input type="text" class="form-control" name="org_name" id="org_name" placeholder="Organization Name" value="" maxlength="150">
                          </div>
                          <div class="col-6">
                              <label class="form-label required">Contact Person Name</label>
                              <input type="text" class="form-control" name="cp_name" id="cp_name" placeholder="Contact Person Name" maxlength="150">
                          </div>
                      </div>
                      <div class="form-group row">
                        
                          <div class="col-6">
                              <label>Mobile Number</label>
                              <input type="text" class="form-control" name="mob_number" id="mob_number" placeholder="Mobile Number" onkeypress="return isNumber(event)">
                          </div>
                          <div class="col-6">
                              <label>Email Id</label>
                              <input type="text" class="form-control" name="cre_email" id="cre_email" placeholder="Email Id" onblur="validate_email1()">
                          </div>
                      </div>
                       <div class="form-group row">
                      <div class="col-12">
                            <label class="form-label required">Address</label>
                            <textarea name="cre_address" id="cre_address" class="form-control" placeholder="Address" maxlength="400"></textarea>
                        </div>
                       
                    </div>
                  </div>
                    <div class="form-group row">
                      <div class="col-5" ></div>
                      
                      <input type="button" name="saveBtn" id="saveBtn" class="btn btn-success" value="save"/>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
       
</div> 


    </div>
    <center>
         <input type="submit" class="btn btn-success text-center" id="submit_btn" name="submit_btn" value="Submit">
          <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Create Order</button>

    </center>
    </div>
     
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
     <form role="form" id="modal_form">
     <div class="row">
      <div class="col-sm-6">
      <label for="prop_date" class="form-label required">Warranty Date</label>
                           
        <div class="input-group date" data-provide="datepicker">
            <input type="text" id="warranty_date1" name="warranty_date1" placeholder="Warranty Date" class="form-control">
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
      </div>
     
     <div class="col-sm-6">
       <label for="exp_date7" class="form-label required">Invoice Valid Upto</label>                           
        <div class="input-group date" data-provide="datepicker">
            <input type="text" id="exp_date71" name="exp_date71" placeholder="Valid Upto" class="form-control">
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div>
     </div>
     </div>

     </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" name="creat_order" id="creat_order" >Create Order</button>

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>       


 
             

@endsection

@section('javascript')

<script>
 $(document).ready(function(){
    var i=1;
  
    $('.addrow').on ('click', function(){
      event.preventDefault();
      addrow();
    });

    function addrow(){
      b=i-1;
      debugger;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
        
         var addrow ='<tr id="addr0">'+
            '<td><input type="checkbox"  name="record"></td>'+
            '<td>'+            
                    '<input list="browsers" name="product[]" id="product" data-attri_id="" class="form-control product" onchange="price_populate(this);" autocomplete="off">'+
                    '<datalist id="browsers">'+
                    '<option value="0" selected="true" disabled="true">Select Product </option>'+
                    '@foreach ($products as $product )'+
                    
                    '<option data-price="{{$product->price}}" value="{{$product->product_name}} label="{{$product->id}}" data-attri_id="{{$product->id}}" >{{$product->product_name}}</option>' +
                    
                  '@endforeach'+
                  '</datalist>'+
            '</td>'+            
            '<td><input type="number" name="qty[]" placeholder="Enter Qty" class="form-control qty" step="0" min="0"/></td>'+
            
            '<td><input type="number" name="price[]" placeholder="Enter Unit Price" class="form-control Price" step="0.00" min="0" /></td>'+
            '<td>'+
            
           
            '<input type="number" name="discount[]" id="discount" value="" placeholder="Discount" class="form-control discount" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="discount_amt[]" id="discount_amt" value="" placeholder="Discounted Amount" class="form-control discount_amt" step="0.00" min="0" >'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="tax_sgst[]" id="tax_sgst" value="" placeholder="SGST" class="form-control sgst" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="tax_cgst[]" id="tax_cgst" value="" placeholder="CGST" class="form-control cgst" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="tax_igst[]" id="tax_igst" value="" placeholder="IGST" class="form-control igst" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="gst_amt[]" id="gst_amt" value="" placeholder="Amount" class="form-control gst_amt" step="0.00" min="0" >'+
           
            '</td>'+
            
            '<td><input type="number" name="total[]" placeholder="0.00" class="form-control total" readonly/></td>'+
            '</tr>';
      $('#tab_logic').find('tbody').append(addrow);
      i++;

      

    }
       $("#delete_row").click(function(){
         debugger;
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
               
                    $(this).parents("tr").remove();
                
                }
            });
            });

          
  
	
      $('#sub_form')[0].reset();
      $('#form_output').html('');
      $('#button_action').val('insert');
        //$('#action').val('Add');



  $('#submit_btn').on('click', function(event){

        debugger;
        //alert('here');
        event.preventDefault();
        var form_data =document.getElementById('sub_form');
        var formdata=new FormData(form_data);
        var test=validateForm()
        if(test==true){
          $.ajax({
            url:"{{ route('quotation') }}",
            method:"POST",
            data:formdata,
            dataType:"json",
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                console.log(data);

                  swal("Proposal Created Succesfully","","success");
                   setTimeout(function() { window.location.href="{{ route('list_proposals') }}";}, 2000);  
                  //location.href ="{{route('quotation')}}";
                    $('#sub_form').trigger("reset");
                   
            }
        });
        }
    });

	

});

$('#creat_order').on('click', function(event){
  //alert("here");
  debugger;
    event.preventDefault();
   
   // var x = document.getElementById('warranty_date').value; 
   // var y = document.getElementById('exp_date7').value;
    var x = document.getElementById('warranty_date1').value;
    var y = document.getElementById('exp_date71').value;
    //alert(x);


    x = $("#warranty_date").val(x);
    y = $("#exp_date7").val(y);
   var form_data =document.getElementById('sub_form');
        var formdata=new FormData(form_data);
   
    var test=validateForm()
        if(test==true){
          $.ajax({
            url:"/direct_order",
            method:"POST",
            data:formdata,
            dataType:"json",
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                console.log(data);

                  swal("Proposal Created Succesfully","","success");
                   setTimeout(function() { window.location.href="{{ route('list_orders') }}";}, 2000);  
                  //location.href ="{{route('quotation')}}";
                    $('#sub_form').trigger("reset");
                   
            }
        });
        }



});
function parse_og_id(){
debugger;
 var og_id= document.getElementById('organization_name1').innerHTML;
 //alert(og_id);
}


 $("#prop_sub").keypress(function(e) {
   
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });

  $("#prop_city").keypress(function(e) {

   var key = e.keyCode;
   if (key >= 48 && key <= 57) {
       e.preventDefault();
   }
   });

   $("#prop_state").keypress(function(e) {

   var key = e.keyCode;
   if (key >= 48 && key <= 57) {
       e.preventDefault();
   }
   });

   $("#prop_country").keypress(function(e) {

   var key = e.keyCode;
   if (key >= 48 && key <= 57) {
       e.preventDefault();
   }
   });             

 

  function Validate(event) 
 {
        var regex = new RegExp("^[0-9-!@#$%*?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
 }  

 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

  function validate_email()  
  {  
    
  var x=  document.getElementById('prop_email').value;
  var atposition=x.indexOf("@");  
  var dotposition=x.lastIndexOf(".");  
  if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
    swal("Error", "Please enter valid email", "danger")
    return false;  
    }  
  } 

  function validate_email1()  
  {  
    debugger;
  var x=  document.getElementById('cre_email').value;
  var atposition=x.indexOf("@");  
  var dotposition=x.lastIndexOf(".");  
  if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
    swal("Error", "Please enter valid email", "danger")
    return false;  
    }  
  } 
$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
 
  $('.discount_amt').on('keyup change',function(){
    calc();
  });
     $('.cgst').on('keyup change',function(){
    calc();
  });
   $('.sgst').on('keyup change',function(){
    calc();
  });
   $('.igst').on('keyup change',function(){
    calc();
  });
 

  
$('#Fr_charges').on('keyup change',function(){
  
  calc_total();
	});


  

function calc()
{ 
  
	$('#tab_logic tbody tr').each(function(i, element) {
    
    		var q = $(this).find('.qty').val();
			var p = $(this).find('.Price').val();
			var cgst = $(this).find('.cgst').val();
			var sgst = $(this).find('.sgst').val();
			var igst = $(this).find('.igst').val();
       var di=$(this).find('.discount').val();
			var d = $(this).find('.discount_amt').val();
			var pro = $(this).find('.product').val();


     
     cgst= parseInt(cgst);
    dis_amt= parseInt(di);
    dis= parseInt(d);
    sgst= parseInt(sgst);
    igst= parseInt(igst);
    var qty = parseInt(q);
    var price = parseInt(p);
		var html = $(this).html();
    
		if(html!='')
		{ 
      var xyz = $('#browsers option').filter(function() {
        return this.value == pro;
   }).data('price');
    $(this).find('.Price').val(xyz);
     var amt = qty*price-dis;
      var tax  = sgst+cgst+igst;
      var tax_ttl = tax/100;
      var ttl = amt*tax_ttl;
      
      var g_amt=dis*(sgst+cgst+igst)/100;
      var fin = g_amt+dis;

			$(this).find('.discount').val(amt);
      $(this).find('.gst_amt').val(g_amt);
			$(this).find('.total').val(fin);
      
			calc_total();
		}
    });
}

function calc_total()
{
  debugger;
  total=0;
  
  Fr_charges= parseInt($('#Fr_charges').val());
  
  

	$('.total').each(function() {
        total += parseInt($(this).val());
        
    });
  
    $('#sub_total').val(total.toFixed(2));
	
  

  $('#total_amount').val((total+Fr_charges).toFixed(2));

}


   function validateForm() {
        //alert("here");
        var subject=document.getElementById("prop_sub").value;
        var related=document.getElementById("prop_related").value;
        var org=document.getElementById("organization_name1").value;
        var address=document.getElementById("prop_address").value;
        var city=document.getElementById("prop_city").value;
        var country=document.getElementById("prop_country").value;
        var state=document.getElementById("prop_state").value;
        var zip=document.getElementById("prop_zip").value;
        var to=document.getElementById("prop_to").value;
        var date=document.getElementById("prop_date").value;
        var currency=document.getElementById("prop_currency").value;
        var email=document.getElementById("prop_email").value;
        var discount=document.getElementById("discount").value;
        var tax_sgst=document.getElementById("tax_sgst").value;
        var tax_cgst=document.getElementById("tax_cgst").value;
        var tax_igst=document.getElementById("tax_igst").value;
        var Freight=document.getElementById("Fr_charges").value;
        
       // var product=document.getElementById("product").value;
       debugger;
        if($('#product').length){
         var product=document.getElementById("product").value;
        }
        else{
          var product="";
        }

        if($('.qty').length){
          debugger;
         var qty=document.getElementById("qty").value;
        }
        else{
          var qty="";
        }

         if (subject == "" ) {
            swal("Please Enter Subject field","Required","warning");
            document.getElementById("prop_sub").focus();
            return false;
          }
          else if(to ==""){
            swal("Please Enter To field","Required","warning");
            $("#prop_to").focus();
            return false;
          }
          else if(org ==""){
            swal("Please select Organisation","Required","warning");
            $("#organization_name1").focus();
            return false;
          }
          else if(address ==""){
            swal("Please select Organisation Address","Required","warning");
            $("#organization_name1").focus();
            return false;
          }
          
          else if(date ==""){
            swal("Please select Quotation Date","Required","warning");
            $("#prop_date").focus();
            return false;
          }
           else if(currency ==""){
            swal("Please select Currency","Required","warning");
            $("#prop_currency").focus();
            return false;
          }
          else if(city ==""){
            swal("Please Enter City","Required","warning");
            $("#prop_city").focus();
            return false;
          }
           else if(country ==""){
            swal("Please Enter Country","Required","warning");
            $("#prop_country").focus();
            return false;
          }
           else if(state ==""){
            swal("Please Enter State","Required","warning");
            $("#prop_state").focus();
            return false;
          }
          else if(zip ==""){
            swal("Please Enter Zip code","Required","warning");
            $("#prop_state").focus();
            return false;
          }
          
          else if(product ==""){
            swal("Please Select Atleast One Product","Required","warning");
            $("#product").focus();
            return false;
          }
          else if(qty =="" ){
            swal("Please Enter Quantity","Required","warning");
            $("#qty").focus();
            return false;
          }
          else if(discount =="" ){
            swal("Please Enter Discount amount or enter 0","Required","warning");
            $("#discount").focus();
            return false;
          }
          else if(tax_sgst =="" ){
            swal("Please Enter SGST(%) or enter 0","Required","warning");
            $("#sgst").focus();
            return false;
          }
          else if(tax_cgst =="" ){
            swal("Please Enter CGST(%) or enter 0","Required","warning");
            $("#cgst").focus();
            return false;
          }
          else if(tax_igst =="" ){
            swal("Please Enter IGST(%) or enter 0","Required","warning");
            $("#igst").focus();
            return false;
          }
          else if(Freight =="" ){
            swal("Please Enter Freight amount or enter 0","Required","warning");
            $("#Fr_charges").focus();
            return false;
          }
          else{
          //swal("success");
          return true;
          } 

      }


    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  $('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
   
});

$('#discount').on('keyup change',function(){
   selectedOption = $('option:selected:true', this);
    $('input[name=price]').val( selectedOption.data('price') );

 });


//character validation
function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }

 $('#saveBtn').click( function(event){

        debugger;
        //alert('here');
        event.preventDefault();
        var form_data1 =document.getElementById('orgForm');
        var formdata1=new FormData(form_data1);
          $.ajax({
            url:"{{ route('create_org1') }}",
            method:"POST",
            data:formdata1,
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                console.log(data);
                
                    $('#orgForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                      swal("Organization successfully Created","","success");
                       document.getElementById('organization_name1').value=data.organization_name;
                       document.getElementById('prop_email').value=data.email_id;
                       document.getElementById('prop_phone').value=data.mobile_number;
                       document.getElementById('prop_address').value=data.address;
                       
                    
                   
            }
        });
        
    });
    
    
    

    //function populate_details() { 
   //  debugger;
   // var orgid=$("#organization_name option[value='" + $("#organization_name1").val() + "']").attr("label");
     
    // $('#hidden_orgid').val(orgid);
    // $.get("/proposals/edit/" + orgid, function (data){
    //   console.log(data);
          
        
     //     $('#prop_phone').val(data.mobile_number);
    //      $('#prop_email').val(data.email_id);
     //     $('#prop_address').val(data.address);

     //})
//} 





 $(".populate").change(function(){
   debugger;
    var orgid=$("#organization_name option[value='" + $("#organization_name1").val() + "']").attr("label");
     
     $('#hidden_orgid').val(orgid);
  
});
   $.get("/proposals/edit/" + orgid, function (data){
     debugger;
     console.log(data);
          
        
          $('#prop_phone').val(data.mobile_number);
          $('#prop_email').val(data.email_id);
          $('#prop_address').val(data.address);
          $('#prop_city').val(data.city_town);
          $('#prop_state').val(data.state);
          $('#prop_country').val(data.country);
          $('#prop_zip').val(data.postal_code);
          $('#prop_assigned').val(data.Assign_To);
          $('#prop_to').val(data.contact_person_name);

     })
</script>
@endsection
