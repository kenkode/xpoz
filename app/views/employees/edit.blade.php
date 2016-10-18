@extends('layouts.main')

{{HTML::script('media/jquery-1.8.0.min.js') }}
<style>
#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-image:url("{{asset('/public/uploads/employees/photo/'.$employee->photo) }}");
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
#signPreview {
    width: 180px;
    height: 100px;
    background-position: center center;
    background-image:url("{{asset('/public/uploads/employees/signature/'.$employee->signature) }}");
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {


    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
            }
    });

    $('#bank_id').change(function(){
        $.get("{{ url('api/dropdown')}}", 
        { option: $(this).val() }, 
        function(data) {
            $('#bbranch_id').empty(); 
            $.each(data, function(key, element) {
                $('#bbranch_id').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });

});
</script>



<script type="text/javascript">
$(document).ready(function() {
    $("#signFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#signPreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>

@section('content')
<br/>

<div class="row">
  <div class="col-lg-12">
  <h3>Update Employee</h3>

<hr>
</div>  
</div>


<div class="row">
  <div class="col-lg-12">

    
    
     @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

    <form method="POST" action="{{{ URL::to('employees/update/'.$employee->id) }}}" accept-charset="UTF-8" enctype="multipart/form-data">

            <div class="row">
            
<!--
            <div class="col-lg-3">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Member Photo</label>
                        <input  type="file" name="photo" id="name">
                    </div>


                     <div class="form-group">
                        <label for="username">Member Signature</label>
                        <input  type="file" name="signature" id="signature" >
                    </div>
                </fieldset>

            </div>

-->        
            <input class="form-control" placeholder="" type="hidden" name="photo" id="photo" value="{{{ $employee->photo}}}" >
            <input class="form-control" placeholder="" type="hidden" name="sign" id="sign" value="{{{ $employee->signature}}}" >
            <div class="col-lg-4">

                 <fieldset>
                   <div class="form-group"><h3 style='color:Green;strong'>Personal Details</h3></div>

                    <div class="form-group">
                        <label for="username">Personal File Number <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" readonly="readonly" type="text" name="personal_file_number" id="personal_file_number" value="{{{ $employee->personal_file_number}}}" >
                    </div>

                    <div class="form-group">
                        <label for="username">Surname <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="lname" id="lname" value="{{{ $employee->last_name }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">First Name <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="fname" id="fname" value="{{{ $employee->first_name }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Other Names </label>
                        <input class="form-control" placeholder="" type="text" name="mname" id="mname" value="{{{ $employee->middle_name }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">ID Number <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="identity_number" id="identity_number" value="{{{ $employee->identity_number }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Passport number</label>
                        <input class="form-control" placeholder="" type="text" name="passport_number" id="passport_number" value="{{{ $employee->passport_number }}}">
                    </div>

                   
                    <div class="form-group">
                        <label for="username">Date of birth</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker1" readonly="readonly" placeholder="" type="text" name="dob" id="dob" value="{{{ $employee->yob }}}">
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Marital Status</label>
                        <select name="status" class="form-control">
                            <option></option>
                            <option value="Single"<?= ($employee->marital_status=='Single')?'selected="selected"':''; ?>>Single</option>
                            <option value="Married"<?= ($employee->marital_status=='Married')?'selected="selected"':''; ?>>Married</option>
                            <option value="Divorced"<?= ($employee->marital_status=='Divorced')?'selected="selected"':''; ?>>Divorced</option>
                            <option value="Separated"<?= ($employee->marital_status=='Separated')?'selected="selected"':''; ?>>Separated</option>
                            <option value="Widowed"<?= ($employee->marital_status=='Widowed')?'selected="selected"':''; ?>>Widowed</option>
                            <option value="Others"<?= ($employee->marital_status=='Others')?'selected="selected"':''; ?>Others</option>
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Citizenship</label>
                        <select name="citizenship" class="form-control">
                            <option></option>
                            <option value="Kenyan"<?= ($employee->citizenship=='Kenyan')?'selected="selected"':''; ?>>Kenyan</option>
                            <option value="Ugandian"<?= ($employee->citizenship=='Ugandian')?'selected="selected"':''; ?>>Ugandan</option>
                            <option value="Tanzanian"<?= ($employee->citizenship=='Tanzanian')?'selected="selected"':''; ?>>Tanzanian</option>
                            <option value="Others"<?= ($employee->citizenship=='others')?'selected="selected"':''; ?>>Others</option>
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Education Background</label>
                        <select name="education" id="education" class="form-control">
                            <option></option>
                            @foreach($educations as $education)
                            <option value="{{ $education->id }}"<?= ($employee->education_type_id==$education->id)?'selected="selected"':''; ?>> {{ $education->education_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Assign Supervisor</label>
                        <select name="supervisor" id="supervisor" class="form-control">
                            <option></option>
                            @if($count>0)
                            @foreach($subordinates as $subordinate)
                            <option value="{{ $subordinate->id }}"<?= ($subordinate->id==$supervisor->supervisor_id)?'selected="selected"':''; ?>> {{ $subordinate->first_name.' '.$subordinate->last_name }}</option>
                            @endforeach
                            @else
                            @foreach($subordinates as $subordinate)
                            <option value="{{ $subordinate->id }}"> {{ $subordinate->first_name.' '.$subordinate->last_name }}</option>
                            @endforeach
                            @endif
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Date joined <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="djoined" id="djoined" value="{{{ $employee->date_joined }}}">
                        </div>
                        </div>

                    <div class="form-group">
                        <label for="username">Gender</label><br>
                        <input class=""  type="radio" name="gender" id="gender" value="male"<?= ($employee->gender=='male')?'checked="checked"':''; ?>> Male
                        <input class=""  type="radio" name="gender" id="gender" value="female"<?= ($employee->gender=='female')?'checked="checked"':''; ?>> Female
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Photo</label><br>
                        <div id="imagePreview"></div>
                        <input class="img" placeholder="" type="file" name="image" id="uploadFile" value="{{{ $employee->signature }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Signature</label><br>
                        <div id="signPreview"><img src="{{{ $employee->signature }}}" alt=""></div>
                        <input class="img" placeholder="" type="file" name="signature" id="signFile" value="{{{ $employee->signature }}}">
                    </div>

                </fieldset>

            </div>

            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Pin Information</h3></div>
                    <div class="form-group">
                        <label for="username">KRA Pin</label>
                        <input class="form-control" placeholder="" type="text" name="pin" id="pin" value="{{{ $employee->pin }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Nssf Number</label>
                        <input class="form-control" placeholder="" type="text" name="social_security_number" id="social_security_number" value="{{{ $employee->social_security_number }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Nhif Number</label>
                        <input class="form-control" placeholder="" type="text" name="hospital_insurance_number" id="hospital_insurance_number" value="{{{ $employee->hospital_insurance_number }}}">
                    </div>
                     </fieldset>
                     <fieldset>
                      
                      <div class="form-group"><h3 style='color:Green;strong;margin-top:15px'>Deductions Applicable</h3></div>

                        <div class="checkbox">
                        <label>
                            <input type="checkbox" id="itax" value="{{{ $employee->income_tax_applicable }}}" name="i_tax"<?= ($employee->income_tax_applicable=='1')?'checked="checked"':''; ?>>
                              Apply Income Tax
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="irel" value="{{{ $employee->income_tax_relief_applicable }}}" name="i_tax_relief"<?= ($employee->income_tax_relief_applicable=='1')?'checked="checked"':''; ?>>
                               Apply Income Tax Relief
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="{{{ $employee->social_security_applicable }}}" name="a_nssf"<?= ($employee->social_security_applicable=='1')?'checked="checked"':''; ?>>
                               Apply Nssf
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="{{{ $employee->hospital_insurance_applicable }}}" name="a_nhif"<?= ($employee->hospital_insurance_applicable=='1')?'checked="checked"':''; ?>>
                                Apply Nhif
                        </label>
                    </div>
                     </fieldset>

                     <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Payment Information</h3></div>

                    <div class="form-group">
                        <label for="username">Mode of Payment</label>
                        <select name="modep" class="form-control">
                            <option></option>
                            <option value="Bank"<?= ($employee->mode_of_payment=='Bank')?'selected="selected"':''; ?>>Bank</option>
                            <option value="Cash"<?= ($employee->mode_of_payment=='Cash')?'selected="selected"':''; ?>>Cash</option>
                            <option value="Cheque"<?= ($employee->mode_of_payment=='Cheque')?'selected="selected"':''; ?>>Cheque</option>
                        </select>
                
                    </div>                    

                    <div class="form-group">
                        <label for="username">Bank</label>
                        <select id="bank_id" name="bank_id" class="form-control">
                            <option></option>
                            @foreach($banks as $bank)
                            <option value="{{ $bank->id }}"<?= ($employee->bank_id==$bank->id)?'selected="selected"':''; ?>> {{ $bank->bank_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                      
                     <div class="form-group">
                        <label for="username">Bank Branch</label>
                        <select id="bbranch_id" name="bbranch_id" class="form-control">
                            <option></option>
                            @foreach($bbranches as $bbranch)
                            <option value="{{$bbranch->id }}"<?= ($employee->bank_branch_id==$bbranch->id)?'selected="selected"':''; ?>> {{ $bbranch->bank_branch_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Bank Account Number</label>
                        <input class="form-control" placeholder="" type="text" name="bank_account_number" id="bank_account_number" value="{{{ $employee->bank_account_number }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Bank Eft Code</label>
                        <input class="form-control" placeholder="" type="text" name="bank_eft_code" id="bank_eft_code" value="{{{ $employee->bank_eft_code }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Swift Code</label>
                        <input class="form-control" placeholder="" type="text" name="swift_code" id="swift_code" value="{{{ $employee->swift_code }}}">
                    </div>
                     

              </fieldset>

              <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Next of Kin</h3></div>

                    <div class="form-group">
                        <label for="username">Kin name</label>
                        <input class="form-control" placeholder="" type="text" name="kin_name" id="kin_name" value="{{ $employee->kin_name }}">
                
                    </div>                    

                    <div class="form-group">
                        <label for="username">ID Number</label>
                       <input class="form-control" placeholder="" type="text" name="kin_idno" id="kin_idno" value="{{$employee->kin_idno }}">
                
                    </div>

                      
                     <div class="form-group">
                        <label for="username">Email Address</label>
                        <input class="form-control" placeholder="" type="text" name="kin_email" id="kin_email" value="{{$employee->kin_email}}">
                
                    </div>

                    <div class="form-group">
                        <label for="username">Telephone Number</label>
                        <input class="form-control" placeholder="" type="text" name="kin_phone" id="kin_phone" value="{{$employee->kin_phone}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Relationship</label>
                        <input class="form-control" placeholder="" type="text" name="relationship" id="relationship" value="{{$employee->kin_relationship}}">
                    </div>
                     

              </fieldset>


            </div>

            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Branch Information</h3></div>
                    <div class="form-group">
                        <label for="username">Employee Branch <span style="color:red">*</span></label>
                        <select name="branch_id" class="form-control">
                            <option></option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}"<?= ($employee->branch_id==$branch->id)?'selected="selected"':''; ?>> {{ $branch->name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Employee Department <span style="color:red">*</span></label>
                        <select name="department_id" class="form-control">
                            <option></option>
                            @foreach($departments as $department)
                            <option value="{{$department->id }}"<?= ($employee->department_id==$department->id)?'selected="selected"':''; ?>> {{ $department->department_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                     <div class="form-group">
                        <label for="username">Job Group <span style="color:red">*</span></label>
                        <select name="jgroup_id" class="form-control">
                            <option></option>
                            @foreach($jgroups as $jgroup)
                            <option value="{{ $jgroup->id }}"<?= ($employee->job_group_id==$jgroup->id)?'selected="selected"':''; ?>> {{ $jgroup->job_group_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                     
                     <div class="form-group">
                        <label for="username">Employee Type</label>
                        <select name="type_id" class="form-control">
                            <option></option>
                            @foreach($etypes as $etype)
                            <option value="{{$etype->id }}"<?= ($employee->type_id==$etype->id)?'selected="selected"':''; ?>> {{ $etype->employee_type_name }}</option>
                            @endforeach

                        </select>

                         <div class="form-group">
                        <label for="username">Work Permit Number</label>
                        <input class="form-control" placeholder="" type="text" name="work_permit_number" id="work_permit_number" value="{{{ $employee->work_permit_number }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Job Title</label>
                        <input class="form-control" placeholder="" type="text" name="jtitle" id="jtitle" value="{{{ $employee->job_title }}}">
                    </div>
                    
                     <div class="form-group">
            
                        <label for="username">Basic Salary</label>
                        <input class="form-control" placeholder="" type="text" name="pay" id="pay" value="{{{ $employee->basic_pay }}}">
                        <script type="text/javascript">
                        $(document).ready(function() {
                        $('#pay').priceFormat();
                        });
                     </script>
                    </div>
                
                    </div>
                    
                    <div style='margin-top:0px'></div>

                    <fieldset>

                    <div class="form-group"><h3 style='color:Green;strong'>Contact Information</h3></div>
                    <div class="form-group">
                        <label for="username">Phone Number</label>
                        <input class="form-control" placeholder="" type="text" name="telephone_mobile" id="telephone_mobile" value="{{{ $employee->telephone_mobile }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Office Email <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="email_office" id="email_office" value="{{{ $employee->email_office }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Personal Email</label>
                        <input class="form-control" placeholder="" type="text" name="email_personal" id="email_personal" value="{{{ $employee->email_personal }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Postal Zip</label>
                        <input class="form-control" placeholder="" type="text" name="zip" id="zip" value="{{{ $employee->postal_zip }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Postal Address</label>
                        <textarea class="form-control"  name="address" id="address">{{{ $employee->postal_address }}}</textarea>
                    </div>

        
                   </fieldset>
                  
                   <fieldset>
                    
                     <div class="checkbox">
                        <label>
                            <input type="checkbox" value="{{{ $employee->in_employment }}}"<?= ($employee->in_employment=='Y')?'checked="checked"':''; ?> name="active">
                                In Employment
                        </label>
                    </div>
                      
                    </fieldset>

                    <div style='margin-top:260px'></div>

                    </fieldset>
                        <div align='right' class="form-actions form-group">
        
                            <button type="submit" class="btn btn-primary btn-sm">Update Employee</button>
                        </div>

                    
                </fieldset>

            </div>
</div>


<div class="row">


             <div class="col-lg-12"><hr>

                
<div class="row">


             <div class="col-lg-4">

                 <fieldset>
                    


                </fieldset>


             </div>


             <div class="col-lg-4">

                 
                     </div>


             
</div>






<div class="row">


             <div class="col-lg-4 pull-right">
   
                
            </div>

        </div>
</form>
    

  </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
$("#itax").click(function(){
if($(this).is(':checked')){
 $("#irel").prop('checked', true);
}else{
$("#irel").prop('checked', false);
}
});
});
</script>


@stop
