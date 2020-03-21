@extends('layouts.master')


@section('content')
<?php use App\Project;
$Projects = Project::all(); ?>
<style>
.required:after {color: #e32;content:'*';display:inline;}
#container_div {
    background:orange;

}
#headername {
 background:#6495ed;
 color:white;
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<br>
<div class="card bg-primary" id="container_div">
              <div class="card-header" id="headername">
                <h3 class="card-title">Add Property</h3>
              </div> 
              <!--my code-->
               </div>
               <br>
          
                  <p class="card-title">Property Information</p>
        
              
              
               
       <!--my code-->
               
              <!-- /.card-header -->
              <div class="card-body">
                <form id="prop_form" >
                
                  <!-- text input -->
                    <div class="form-group row">
                      <div class="col-4">
                            <label for="property_owner_name" class="form-label required">Property Owner</label>
                            <input type="text" name="property_owner_name" id="property_owner_name" class="form-control" placeholder="Owner Name" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label for="property_code" class="form-label">Property Code</label>
                            <input type="text" name="property_code" id="property_code" class="form-control" placeholder="Property code" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label for="property_name" class="form-label required">Property Name</label>
                            <input type="text" name="property_name" id="property_name" class="form-control" placeholder="Property Name" maxlength="180">
                        </div>
                          
                       
                      
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                        <div class="col-4">
                            <label>Listing Type</label>
                                <select class="form-control" name="listing_type" id="listing_type">
                                <option>Sale</option>
                                <option>Rent</option>
                               
                                </select>
                        </div>
                         <div class="col-4">
                            <label>Listing Category</label>
                                <select class="form-control" name="listing_category" id="listing_category" placeholder="Listing Category">
                                <option>New</option>
                                <option>Resale</option>
                               
                                </select>
                        </div>                    
                        <div class="col-4">
                            <label>Property Category</label>
                                <select class="form-control" name="property_category" id="property_category">
                                <option value="">-- Please Select --</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                               
                                </select>
                        </div>                  
                       
                    </div>


                     <div class="form-group row">
                                       
                       <div class="col-4">
                            <label>Property Type</label>
                                <select class="form-control" name="property_type" id="property_type">
                                <option value="">-- Please Select --</option>
                                </select>
                        </div>
                    </div>

                     <!-- text input -->

                     <div class="form-group row">
                       <div class="col-3">
                          <label>Area(SQFT)</label>
                          <input type="text" name="area_sqft" id="area_sqft" class="form-control" placeholder="Area In SQFT" maxlength="15" onkeypress="return Validate(event)" >
                      </div>
                        <div class="col-3">
                            <label>Bedroom</label>
                            <input type="text" name="bedroom" id="bedroom" class="form-control" placeholder="Bedroom" maxlength="15" onkeypress="return Validate(event)">
                        </div>
                    <div class="col-3">
                          <label>Bathroom</label>
                          <input type="text" name="bathroom" id="bathroom"  class="form-control" placeholder="Bathroom" maxlength="15" onkeypress="return Validate(event)" >
                      </div>    
                         <div class="col-3">
                          <label>Parking Space</label>
                          <input type="text" name="Parking_space" id="Parking_space"  class="form-control" placeholder="Parking Space" maxlength="15"  onkeypress="return Validate(event)" >
                      </div>                   
                    </div>
                    <!-- text input -->
                     <div class="form-group row">                   
                                           
                      <div class="col-4">
                              <label>Project Name</label>
                              <input list="Project_Name" name="Project_Name" id="Project_Name" placeholder="Project Name"  class="form-control product">
                                  <datalist id="Project_name">                                 
                                  @foreach($Projects  as $Project)
                                      <option  value="{{ $Project->proj_project_name}}"></option>
                                  @endforeach
                                  </datalist>
                          </div>           
                           <div class="col-3">
                            <label>Floor</label>
                                <input class="form-control" name="floor" id="floor" onkeypress="return Validate(event)" placeholder="Floor" >
                                
                        </div>                   
                         <div class="col-3">
                            <label>Property Status</label>
                                <select class="form-control" name="property_status" id="property_status" >
                                <option>Available</option>
                                <option>Offer</option>
                                <option>Contract Out </option>
                                <option>Contract In</option>
                               
                                </select>
                        </div>          
                      <div class="col-3">
                          <label>property Active</label><br>
                          <input type="checkbox" id="property_active" name="property_active" value="" style="margin-left: 5%;" checked>
                      </div>                  
                    </div>
                        <div class="form-group row">                    
                         <div class="col-3">
                           <label for="img">Property Image:</label>
                            <input type="file" id="property_image" name="property_image[]" accept="image/*" class="form-control" multiple="" required="">
                         
                     
             
                 
                        </div>
                         </div>
                        <br>
                        <hr>
                        
                  <p>Address Information</p>
        

                    
                     <!-- text input -->
                     <div class="form-group row">
                       <div class="col-4">
                            <label>Street</label>
                            <input type="text" name="street" id="street" class="form-control" placeholder="Street" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label>City/Town</label>
                            <input type="text" name="city_town" id="city_town" class="form-control" placeholder="City/Town" maxlength="180">
                        </div>
                      <div class="col-4">
                            <label>Zip Code</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Zip Code" maxlength="15" onkeypress="return Validate(event)" >
                        </div>                                         
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                                        
                      <div class="col-4">
                              <label>State</label>
                              <input list="state" name="state" id="stateID" placeholder="State"  class="form-control product">
                                  <datalist id="state">                                 
                                  @foreach($states as $state)
                                      <option  value="{{$state->State_Name}}"></option>
                                  @endforeach
                                  </datalist>
                          </div>         
                          <div class="col-4">
                          <label>Country</label>
                          <!--<input list="country" name="country" id="country" placeholder="Country"  class="form-control">-->
                                 <select class="form-control" name="Country" id="Country">
                                <option>India</option>
                            
                                </select>                       
                                 
                                    
                                 
                                  
                            </div>      

                        </div>
                        
                    
                    <hr>
                   
                  <p>Property Price/(Rent Per Month)</p>
        


                     <!-- text input -->
                     <div class="form-group row">                                            
                        
                         
                                   <div class="col-6">        
                          <label>Unit Price</label>
                          <input list="unit_price" name="unit_price" id="unit_price" placeholder="Unit Price" class="form-control"onkeypress="return Validate(event)">
                                 

                        </div>  
                        <div class="col-6">
                            <label>Deposite Money(Rent)</label>
                            <input list="deposite_money" name="deposite_money" id="deposite_money" placeholder="Deposite Money(Rent)" class="form-control product" onkeypress="return Validate(event)">
                                 

                        </div> 
                      </div>

                      <hr>
                  <p>Owner/Landloard Information</p>
        
 
                                       
                        
                                                                         
                    
                     <!-- text input -->
                     <div class="form-group row">                                                                             
                     <div class="col-6">
                          <label>Listing Owner/Landlord Company</label>
                          <input type="text" name="listing_owner_lanlord_company" id="listing_owner_lanloard_company" class="form-control" placeholder="" maxlength="40">
                          </div>
                          <div class="col-6">
                          <label>Listing Owner/Landloard Contact</label>
                          <input type="text" name="listing_owner_lanloard_contact" id="listing_owner" class="form-control" placeholder="" maxlength="15" onkeypress="return Validate(event)">
                      </div> 
                    </div>
                       <div class="form-group row">
                      <div class="col-6">
                            <label>New Owner/Landloard Company</label>
                            <input list="new_owner_lanloard_company" name="new_owner_lanloard_company" id="new_owner_lanloard_company" placeholder="" class="form-control">
                          </div>
                            <div class="col-6">
                          <label>New Owner/Landloard Contactt</label>
                          <input type="text" name="new_owner_landloard_contact" id="new_owner_landloard_contact" class="form-control" placeholder="" maxlength="15" onkeypress="return Validate(event)">
                      </div> 
                    </div>
                                 

                      
                      
                                                                  
                                                     
                    <hr>
              
                  <p>Description Information</p>
        

                                  
                        
                     <!-- text input -->
                     
                           
                                                                                     
           
                     <!-- text input -->
                     <div class="form-group row">                                                                     
                      </div>
                    <div class="col-12" style="align-items: center;">
                        <label>Description/Note (Only 800 charcter allow)</label>
                        <textarea class="form-control" name="description" rows="5" id="comment" maxlength="1000"></textarea>
                    </div>
                    <br>
                
                    <div class="form-group row">
                       <div class="col-12" style="justify-content: center;display: flex; padding-bottom: 10px;">
                   <input type="submit" name="saveBtn" id="saveBtn" class="btn btn-success">
                      </div>
              </div>

                </form>
              </div>
              
           
              <!-- /.card-body -->
           

@endsection

@section('javascript')

<!-- CK Editor -->
<script src="{{asset('admin-lte/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
/*
$( document ).ready(function() {
    document.getElementById("sub-Priority").disabled = true;
});*/

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function Validate(event) {
        var regex = new RegExp("^[0-9-!+@#$%*?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }      


 $('#saveBtn').click(function (e) {
      e.preventDefault();
      $(this).html('Sending..'); 
      //debugger;
      var myForm = document.getElementById('prop_form');
      var formData = new FormData(myForm);
      var test=validate();

      if(test==true){
       $.ajax({
        data: formData,
        url: "/add_property/store",
        type: "POST",
        processData:false,
        contentType:false,
        cache:false,
        success: function (data) {

         
          swal("Property Successfully Created.","","success");
          //setTimeout(function() { location.reload(); }, 2000); 

        },


      });
     }


   });

  function validate()
  {
    var name = document.getElementById('property_owner_name').value;
    var property_name = document.getElementById('property_name').value;
      var type = document.getElementById('property_type').value;
    if(name==""){
        swal("Required", "Please enter Property Owner name", "warning") 
        document.getElementById('property_owner_name').focus();
        return false;
    }else if(property_name==""){
        swal("Required", "Please enter Property name", "warning") 
        document.getElementById('property_name').focus();
        return false;
    }
  
   else{
        return true;
    }   

  }





  $(document).ready(function(){

//let's create arrays
var Residential = [
  {display: "Residential Apartment", value: "Residential-Apartment" }, 
  {display: "Independent Floor", value: "Independent-Floor" }, 
  {display: "Independent Villa", value: "Independent-Villa" },
  {display: "Residential land", value: "Residential-land" },
   {display: "Studio Apartment", value: "Studio-Apartment" },
    {display: "Farm House", value: "Farm-House" },
    {display: "Serviced Apartment", value: "Serviced-Apartment" },
    {display: "Residential Others", value: "Residential-Others" }];
  
var Commercial = [
  {display: " Commercial Shops", value: " Commercial-Shops" }, 
  {display: "Commercial Showrooms", value: "Commercial-Showrooms" },
  {display: "Commercial Office", value: "Commercial-Office" },
  {display: "Commercial Land", value: "Commercial-Land" },
  {display: "Hotel", value: "Hotel" },
  {display: "Guest House", value: "Guest-House" }, 
  {display: "Time Share", value: "Time-Share" },
  {display: "Space in Retail Mall", value: "Space-in-Retail-Mall" },
  {display: "Office in Business Park", value: "Office-in-Business-Park" },
  {display: "Office In IT Park", value: "Office-In-IT-Park" }];
   


//If parent option is changed
$("#property_category").change(function() {
    var parent = $(this).val(); //get option value from parent 
    
    switch(parent){ //using switch compare selected option and populate child
        case 'Residential':
        list(Residential);
        break;
        case 'Commercial':
        list(Commercial);
        break;        
        default: //default child option is blank
        $("#property_type").html('');  
        break;
       }
});

//function to populate child select box
function list(array_list)
{
  $("#property_type").html(""); //reset child options
  $(array_list).each(function (i) { //populate child options 
    $("#property_type").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
  });
}

});
   
</script>
@endsection