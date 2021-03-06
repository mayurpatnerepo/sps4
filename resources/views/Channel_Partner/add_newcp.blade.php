@extends('layouts.master')


@section('content')
<style>
.form_header{border-bottom: dashed 1px #d1d0d0;padding-bottom: 10px;}
form{margin-bottom:5px;}
.form .seperator{border: 0px;border-bottom: 1px dashed #b5babd;	width:97%;}
#ipd_display{display:none;}
.form-control{margin-bottom: 0.5rem!important;border: 0px;border-bottom:1px solid #868e96;border-radius: .1rem;}
.form-control:focus{color: #495057;background-color: #fff;border-color: #868e96;outline: 0;box-shadow: 4px 4px 0px 0rem #dae0e5;}
.radio:focus {color: #495057;background-color: #fff;border-color: #868e96;outline: 0;box-shadow: 0px 0px 20px 0rem #dae0e5;}
a{-webkit-transition: .25s all;  transition: .25s all;}
.card {overflow: hidden;  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);  -webkit-transition: .25s box-shadow;  transition: .25s box-shadow;}
.card:focus,.card:hover {box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);}
.card-inverse .card-img-overlay {background-color: rgba(51, 51, 51, 0.85);  border-color: rgba(51, 51, 51, 0.85);}
.form .button_login:hover, .form .button_login:active, .form .button_login:focus {box-shadow: 3px 3px 3px 0.2rem #5C885C;}
.form .seperator, .seperator{border: 0px;border-bottom: 1px dashed #b5babd;}
.required {font-weight: bold;}
.required:after {color: #e32;content:'*';display:inline;}
.error select{color:red;}
.noerror select{color:#9e9e9e;}
.error::-webkit-input-placeholder {color: red;}
.noerror::-webkit-input-placeholder {color: #9e9e9e;}
input:not([type='submit']):not([type='button']), select, summary, textarea{background-color: #fff0!important; border-radius: .25rem;}
.error select{color:red;}
.noerror select{color:#9e9e9e;}
.department_parent{display:none;}
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}
#img{
width: 148px;
    height: 155px;
}
</style>
<br>
<meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="container" >
	<div class="card " id="container_div">
    <div class="card-header" id="headername" style="font-weight:solid">
    Add New Channel Pertner
    </div>
	  <div class="card-body">
        <div class="cc_wrapper">
			<form name="user_form"  id="staff_reg_form" enctype="multipart/form-data">
			<div class="form-group  row justify-content-md-center  " >
			   <label for="fileToUpload" >
					<div id="my_camera"></div>
				</label>

				<!--<input id="fileToUpload" name="fileToUpload" type="file"  accept="image/*;capture=camera" onchange="loadFile(event)"/>-->

			</div>
			<div class="form-group  row justify-content-md-center  ">
				<button id="take_snapshots" type="button" class="col-2 btn btn-outline-success btn-sm" onClick="take_snapshot()">capture image</button>
				&nbsp;&nbsp;&nbsp;<input id="upload_image" type="file" name="image_photo" >
                <input type="hidden" name="image" id="image" class="image-tag">
			</div>
			 <input id="mydata" type="hidden" value=""/>
				<hr class="seperator">
			<div class="form-group  row justify-content-md-center"><!--name-->

			  <label for="Channel_Partner_Id" class="col-2 col-form-label required">Channel Partner Id</label>
			  <div class="col-3">
				<input class="form-control noerror" type="text" placeholder="Channel Partner" name="Channel_Partner_Id" value="" id="Channel_Partner_Id">
			  </div>
			
			  <div class="col-2">
			  </div>
			</div>
			<div class="form-group  row justify-content-md-center  "><!--name-->

			  <label for="name" id="name" class="col-2 col-form-label required">Name</label>
			  <div class="col-3">
				<input class="form-control noerror" type="text" placeholder="First Name" maxlength="50" name="first_name" value="" id="first_name" onKeyPress="return ValidateAlpha(event);">
			  </div>
			  <div class="col-3">
				<input class="form-control noerror" type="text" placeholder="Last Name" maxlength="50" name="last_name" value="" id="last_name" onKeyPress="return ValidateAlpha(event);">
			  </div>
			  <div class="col-2">
			  </div>
			</div>
			<div class="form-group  row justify-content-md-center  "><!--name-->

			  <label for="username" id="user-name-input" class="col-2 col-form-label required ">Username<span style="position:relative;left: 225%;z-index: 1001;" id="user-result"></span></label>
			  <div class="col-3">
				<input class="form-control" type="text" placeholder="Username" maxlength="30" name="cp_username" value="" id="cp_username" >
			  </div>
			   <label for="password" id="password" class="col-2 col-form-label required noerror">Password</label>
			  <div class="col-3">
				<input class="form-control" type="password" placeholder="Password" maxlength="20" minlength="8" name="password" value="" id="cp_password" >
			  </div>
			</div>
		
			<div class="form-group  row justify-content-md-center "><!--Email--><!--Alt Contact no-->
			  <label for="email-input" class="col-md-2 col-form-label required noerror">Email</label>
			  <div class="col-md-3">
				<input class="form-control noerror" type="email" value="" name="cp_email" placeholder="Enter email" onblur="validate_email()" id="email-input" autocomplete="off" >
			  </div>
			  <label for="tel-input-staff" class="col-2 col-form-label required noerror">Contact No. <span id="user-result-mumbai" style="position:relative;left: 215%;z-index: 1001;"></span></label><!--Contact no-->
			  <div class="col-md-3">
<input class="form-control noerror" type="text" placeholder="Channel Partner Contact" maxlength="15" onkeypress="return isNumber(event)" name="Channel_Partner_Contact" value="" id="Channel_Partner_Contact">			  </div>
			</div>
			<div class="form-group  row justify-content-md-center "><!--Sex male--><!--Marital Status-->
			<label class="col-md-2 col-form-label required" for="sex-input" > Gender </label>
				<div id="gebder_input" class="form-input col-md-3 ">
					<select name="gender" class="form-control noError" id="sel1">
						<option value="" disabled selected>Select gender</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
				</div>
			<label for="marital-status-input" class="col-2 col-form-label">Marital Status</label>
			  <div id="marital-status-input" class="form-input col-3">
					<select name="Marital_status" class="form-control" id="marital-status-input-select" >
					<option value="" disabled selected> Select marital status </option>
					<option value="Single"> Single </option>
					<option value="Married"> Married </option>
					<option value="Divorced"> Divorced </option>
					<option value="Legally separated"> Legally separated </option>
					<option value="Widowed"> Widowed </option>
					</select>
			  </div>

			</div>
			<div class="form-group  row justify-content-md-center "><!--Date of birth--><!--Contact no-->
			  <label for="dob" class="col-2 col-form-label required">D.O.B</label>
			  
			  <div class="col-3 ">
				<div class="input-group date" data-provide="datepicker">
                               <input type="text" class="form-control" name="dob" id="dob">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                </div> 
			  </div>
			  <label for="blood_group" class="col-2 col-form-label">Blood group</label>
				<div class="col-3">
					<select name="blood_group" name="blood_group" class="form-control" id="bloodgroup-input-select" >
            
                        <option value="" disabled selected> Select Blood group </option>
                        <option value="A+"> A+ </option>
                        <option value="A-"> A- </option>
                        <option value="B+"> B+ </option>
                        <option value="B-"> B- </option>
                        <option value="O+"> O+ </option>
                        <option value="O-"> O- </option>
                        <option value="AB+"> AB+ </option>
                        <option value="AB-"> AB- </option>
					</select>
				</div>
			  
			</div>
			
			<div class="form-group  row justify-content-md-center "><!--Address-->
				<label for="address-input" class="col-2 col-form-label">Address</label>
				<div class="col-3">

				<textarea class="form-control" id="address" placeholder="Enter address here" maxlength="400" name="address"></textarea>
				</div>
				
				
				<div class="col-0">
			  </div>
			</div>
			<div id="ICE_segment" class="ICE_segment">
				<hr class="seperator">
				<div class="form-subHeader" >
						  <label style="margin-left:40px;font-weight:normal">In case of emergency</label>
				</div>
				<br>
				<div class="form-group row justify-content-md-center  "><!--emergency contact name--><!--emergency contact relation-->
				  <label for="ICE-name-input" class="col-2 col-form-label">Name</label>
				  <div class="col-3">
					<input name="relative_name" class="form-control" type="text" value="" placeholder="Name" maxlength="50" id="ICE-name-input" onKeyPress="return ValidateAlpha(event);">
				  </div>
				  <label for="ICE-relation-input" class="col-2 col-form-label">Relation</label>
				  <div class="form-input col-2">
					<input name="relation" class="form-control" type="text" value="" placeholder="Relation" maxlength="20" id="ICE-relation-input" onKeyPress="return ValidateAlpha(event);">
				  </div>
				  <div class="col-1">
				  </div>
				</div>
				<div class="form-group row justify-content-md-center  "><!--emergency contact number-->
				  <label for="ICE-tel-input" class="col-2 col-form-label" >Contact No.</label>
				  <div class="col-3">
					<input name="relative_contact" class="form-control noerror" type="text" value="" placeholder="Contact Number" maxlength="15" onkeypress="return isNumber(event)" id="ICE-tel-input" autocomplete="off" maxlength="10">
				  </div>
				  <div class="col-5">
				  </div>
				</div>
				<div class="form-group row justify-content-md-center  ipd"><!--Address-->
				   <label for="alt-address-input" class="col-2 col-form-label">Address</label>
					<div class="col-3">
					<textarea name="relative_address" id="ICE_address" class="form-control" placeholder="Enter Address here" maxlength="400" style="width:100%;"></textarea>
					</div>
					<div class="col-5"></div>
					<!--<div class="col-offset-2  col-xs-offset-2  col-sm-offset-2 col-md-offset-2  col-5">
					<label><input  name="address_value"  class="form-control" style="width:auto;display:inline;"  type="checkbox">
					address same as above</label>
					</div>-->
					<input type="hidden" id="hidden" />
				</div>
			</div >
				<hr class="seperator">
			<br>
			</div>
			<div class=" row justify-content-md-center ">
				<div class="col-2">
					<input type="submit" class="btn btn-success " name="staff_registration" id="staff_registration" value="Create Staff" style="width:100%"/>
				</div><!--/* button_login */-->
				<div class="col-2">
					<input type="button" class="btn btn-danger " id="reset_btn"  name="reset_btn" value="Reset" style="width:100%"/><!-- class="/* button_reset */"-->
				</div>

			</div>
		
			</form>
			</div>
		</div>
	</div>
@endsection
