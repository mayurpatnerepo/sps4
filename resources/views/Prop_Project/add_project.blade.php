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
                <h3 class="card-title">Add Project SPS</h3>
              </div> 
              <!--my code-->
               </div>
               <br>
          
               
        
              
              
               
       <!--my code-->
               
              <!-- /.card-header -->
              <div class="card-body">
                <form id="proj_form" >
                
                  <!-- text input -->
                    <div class="form-group row">
                     
                        <div class="col-6">
                            <label for="Project_Name" class="form-label required">Project Name</label>
                            <input type="text" name="Project_Name" id="Project_Name" class="form-control" placeholder="Project Name" maxlength="180">
                        </div>
                        <div class="col-6">
                            <label for="Owner_Name" class="form-label required">Owner Name</label>
                            <input type="text" name="Owner_Name" id="Owner_Name" class="form-control" placeholder="Owner Name" maxlength="180">
                        </div>
                          
                       
                      
                    </div>
                    <p>Address Information</p>
                  
                     <!-- text input -->

                     <div class="form-group row">
                       <div class="col-4">
                          <label>Address</label>
                          <input type="text" name="Address" id="Address" class="form-control" placeholder="Address" maxlength="180" >
                      </div>
                        <div class="col-4">
                            <label>Phone Number</label>
                            <input type="text" name="Phone_Number" id="Phone_Number" class="form-control" placeholder="Phone Number" maxlength="15" onkeypress="return Validate(event)">
                        </div>
                    <div class="col-4">
                          <label>Email Id</label>
                          <input type="text" name="Email_Id" id="Email_Id" onblur="validate_email2()" class="form-control" placeholder="Email Id" maxlength="40">
                      </div>    
                                         
                    </div>
                    <!-- text input1 -->



                    <div class="form-group row">
                       <div class="col-4">
                          <label>Website</label>
                          <input type="text" name="Website" id="Website" class="form-control" placeholder="Website" maxlength="15" >
                      </div>
                        <div class="col-4">
                            <label>Developer Name</label>
                            <input type="text" name="Developer_Name" id="Developer_Name" class="form-control" placeholder="Developer Name" maxlength="15">
                        </div>
                    <div class="col-4">
                          <label>Project Code</label>
                          <input type="text" name="Project_Code" id="Project_Code"  class="form-control" placeholder="Project Code" maxlength="40">
                      </div>    
                                         
                    </div>
                    
                        
         
        

                    
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
                        
                    
                
              
                 
        

                                  
                        
                     <!-- text input -->
                     
                           
                                                                                     
           
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
      var myForm = document.getElementById('proj_form');
      var formData = new FormData(myForm);
      var test=validate();

      if(test==true){
       $.ajax({
        data: formData,
        url: "/add_project/store",
        type: "POST",
        processData:false,
        contentType:false,
        cache:false,
        success: function (data) {

         
          swal("Project Successfully Created.","","success");
          //setTimeout(function() { location.reload(); }, 2000); 

        },


      });
     }


   });

  function validate()
  {
    var name = document.getElementById('Project_Name').value;
    var owner_name = document.getElementById('Owner_Name').value;
      
    if(name==""){
        swal("Required", "Please Enter Project Name", "warning") 
        document.getElementById('Project_Name').focus();
        return false;
    }else if(owner_name==""){
        swal("Required", "Please Enter owner name", "warning") 
        document.getElementById('Owner_Name').focus();
        return false;
    }
  
   else{
        return true;
    }   

  }
   
</script>
@endsection