@extends('layouts.master')


@section('content')
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
                <h3 class="card-title">Add Lead</h3>
              </div> 
              <!--my code-->
               </div>
               <br>
          
               
        
                   <p>Lead Information</p>
              
               
       <!--my code-->
               
              <!-- /.card-header -->
              <div class="card-body">
                <form id="lead_form" >
                
                  <!-- text input -->
                    <div class="form-group row">
                     
                        <div class="col-4">
                            <label for="Lead_Name" class="form-label required">Lead Name</label>
                            <input type="text" name="Lead_Name" id="Lead_Name" class="form-control" placeholder="Lead Name" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label for="Mobile_Number" class="form-label required">Mobile Number</label>
                            <input type="text" name="Mobile_Number" id="Mobile_Number" class="form-control" placeholder="Mobile_Number" maxlength="15" onkeypress="return Validate(event)" >
                        </div>
                        <div class="col-4">
                            <label for="Phone" class="form-label ">Phone</label>
                            <input type="text" name="Phone" id="Phone" class="form-control" placeholder="Phone " maxlength="15" onkeypress="return Validate(event)">
                        </div>
                          
                       
                      
                    </div>
               
                  
                     <!-- text input -->

                     <div class="form-group row">
                       <div class="col-4">
                          <label>Email Id</label>
                          <input type="text" name="Email_Id" id="Email_Id" class="form-control" placeholder="Email Id" maxlength="180"  >
                      </div>
                        <div class="col-4">
                            <label>Secondary Email</label>
                            <input type="text" name="Secondary_Email" id="Secondary_Email" class="form-control" placeholder="Secondary Email" maxlength="180" onkeypress="return Validate(event)">
                        </div>
                    <div class="col-4">
                          <label>Skype Id</label>
                          <input type="text" name="Skype_Id" id="Skype_Id"  class="form-control" placeholder="Skype Id " maxlength="100">
                      </div>    
                                         
                    </div>
                    <!-- text input -->
                     

                      <div class="form-group row">
                       <div class="col-4">
                          <label>Twitter</label>
                          <input type="text" name="Twitter" id="Twitter" class="form-control" placeholder="Twitter" maxlength="180"  >
                      </div>
                        <div class="col-4">
                            <label>Lead Status</label>
                            <input type="text" name="Lead_Status" id="Lead_Status" class="form-control" placeholder="Lead Status" maxlength="180" >
                        </div>
                    <div class="col-4">
                            <label>Lead Source</label>
                            <input type="text" name="Lead_Source" id="Lead_Source" class="form-control" placeholder="Lead Source" maxlength="180" >
                        </div>
                                         
                    </div>





                    <div class="form-group row">
                       <div class="col-4">
                          <label>Modified By</label>
                          <input type="text" name="Modified_By" id="Modified_By" class="form-control" placeholder="Modified By" maxlength="180"  >
                      </div>
                        <div class="col-4">
                            <label>Created By</label>
                            <input type="text" name="Created_By" id="Created_By" class="form-control" placeholder="Created By" maxlength="180" >
                        </div>
                   
                                         
                    </div>



                        <p>Requirement Information</p>





                        <div class="form-group row">
                       <div class="col-4">
                          <label>Requirement Type</label>
                          <input type="text" name="Requirement_Type" id="Requirement_Type" class="form-control" placeholder="Requirement Type" maxlength="180"  >
                      </div>
                        <div class="col-4">
                            <label>Requirement Category</label>
                            <input type="text" name="Requirement_Category" id="Requirement_Category" class="form-control" placeholder="Requirement Category" maxlength="180" >
                        </div>
                    <div class="col-4">
                            <label>Property Category</label>
                            <input type="text" name="Property_Category" id="Property_Category" class="form-control" placeholder="Property Category" maxlength="180" >
                        </div>
                                         
                    </div>




                    <div class="form-group row">
                       <div class="col-4">
                          <label>Property Type</label>
                          <input type="text" name="Property_Type" id="Property_Type" class="form-control" placeholder="Property Type" maxlength="180"  >
                      </div>
                         <div class="col-4">
                          <label>Price (Minimum)</label>
                          <input type="text" name="Price_Min" id="Price_Min" class="form-control" placeholder="Price (Minimum)" maxlength="20" >
                      </div>

                       <div class="col-4">
                          <label>Price (Maximum)</label>
                          <input type="text" name="Price_Max" id="Price_Max" class="form-control" placeholder="Price (Maximum)" maxlength="20" >
                      </div>
                                         
                    </div>





                    <div class="form-group row">
                             <div class="col-4">
                          <label>Area (Minimum SQFT)</label>
                          <input type="text" name="Area_Min" id="Area_Min" class="form-control" placeholder="Area  (Minimum SQFT)" maxlength="20" >
                      </div>
                      <div class="col-4">
                          <label>Area (Maximum SQFT)</label>
                          <input type="text" name="Area_Max" id="Area_Max" class="form-control" placeholder="Area (Maximum SQFT)" maxlength="20" >
                      </div>

                       <div class="col-4">
                          <label>Bathroom (Maximum)</label>
                          <input type="text" name="Bath_Max" id="Bath_Max" class="form-control" placeholder="Bathroom (Maximum)" maxlength="20" >
                      </div>



                    </div>






                    <div class="form-group row">
                            

                       <div class="col-4">
                          <label>Bathroom (Minimum)</label>
                          <input type="text" name="Bath_Min" id="Bath_Min" class="form-control" placeholder="Bathroom (Minimum)" maxlength="20" >
                      </div>
                       <div class="col-4">
                          <label>Parking Sapce</label>
                          <input type="text" name="Parking_Sapce" id="Parking_Sapce" class="form-control" placeholder="Parking Sapce" maxlength="20" >
                      </div>
                       <div class="col-4">
                          <label>Location </label>
                          <input type="text" name="Location" id="Location" class="form-control" placeholder="Location" maxlength="20" >
                      </div>           
            
                    </div>




                               <p>If Source= Brokerage Agency</p>







                                <div class="form-group row">
                       <div class="col-4">
                          <label>Brokerage Agency Name</label>
                          <input type="text" name="Brokerage_Agency_Name" id="Brokerage_Agency_Name" class="form-control" placeholder="Brokerage Agency Name" maxlength="15" >
                      </div>
                        <div class="col-4">
                            <label>Broker Name</label>
                            <input type="text" name="Broker_Name" id="Broker_Name" class="form-control" placeholder="Broker Name" maxlength="15">
                        </div>
                     
                                         
                    </div>
                    
                           



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
                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Zip Code" maxlength="15" onkeypress="return isNumber(event)" >
                        </div>                                         
                    </div>







                     <!-- text input -->
                     <div class="form-group row">
                                        
                      <div class="col-4">
                      <label>State</label>
                          <input list="state" name="state" id="state" placeholder="State"  class="form-control">
                                  

                        </div>
                          <div class="col-4">
                          <label>Country</label>
                          <input list="country" name="country" id="country" placeholder="Country"  class="form-control">
                            </div>      

                        </div>
                        


                        <p>Description Information</p>
                    
                
              
                 
                        <div class="form-group row">                                                                     
                   
                    <div class="col-12" style="align-items: center;">
                        <label>Description/Note</label>
                        <textarea class="form-control" name="description" rows="5" id="comment" maxlength="500"></textarea>
                    </div>
                     </div>
                                  
                        
                     <!-- text input -->
                     
                          <p> Visit Summary</p>





                           <div class="form-group row">
                       <div class="col-4">
                            <label>Average Time spend</label>
                            <input type="text" name="Average_Time_spend" id="Average_Time_spend" class="form-control" placeholder="Average Time spend In Houres" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label>Visited Date</label>
                            <input type="date" name="Visited_Date" id="Visited_Date" class="form-control" placeholder="Visited Date" maxlength="180">
                        </div>
                      <div class="col-4">
                            <label>Visited Time</label>
                            <input type="time" name="Visited_Time" id="Visited_Time" class="form-control" placeholder="Visited Time" maxlength="15"  >
                        </div>                                         
                    </div>









                                                                                     
           
                     <!-- text input -->
                     <div class="form-group row">                                                                     
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

function validate_email2()  
{  
var x=  document.getElementById('Email_Id').value;
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
  swal("Error", "Please enter valid email", "warning")  
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
      var myForm = document.getElementById('lead_form');
      var formData = new FormData(myForm);
      var test=validate();

      if(test==true){
       $.ajax({
        data: formData,
        url: "/add_lead/store",
        type: "POST",
        processData:false,
        contentType:false,
        cache:false,
        success: function (data) {

         
          swal("Lead Successfully Created.","","success");
          //setTimeout(function() { location.reload(); }, 2000); 

        },


      });
     }


   });

  function validate()
  {
    var name = document.getElementById('Lead_Name').value;
    var mobile_no = document.getElementById('Mobile_Number').value;
      
    if(name==""){
        swal("Required", "Please Enter Lead Name", "warning") 
        document.getElementById('Lead_Name').focus();
        return false;
    }else if(mobile_no==""){
        swal("Required", "Please Enter Mobile Number", "warning") 
        document.getElementById('Mobile_Number').focus();
        return false;
    }
  
   else{
        return true;
    }   

  }
   
</script>
@endsection