@extends('layouts.leave')
@section('content')
<div class="row">
	<div class="col-lg-12">
 

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('leaveapplications') }}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
            <label for="username">Employee</label>
            <select class="form-control" name="employee_id">
            <option> select employee</option>
              @foreach($employees as $employee)
		@if($employee->in_employment == 'Y')  
                    <option value="{{$employee->id}}">{{$employee->first_name." ".$employee->last_name." ".$employee->middle_name}}</option>
@endif             
 @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="username">Leave type</label>
            <select class="form-control" name="leavetype_id">
            <option> select leave</option>
              @foreach($leavetypes as $leavetype)  
                    <option value="{{$leavetype->id}}">{{$leavetype->name}}</option>
              @endforeach
            </select>
        </div>



        



        <div class="form-group">
                        <label for="username">Start Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21 appliedstartdate" readonly="readonly" placeholder="" type="text" name="applied_start_date" id="applied_start_date" value="">
                    </div>
       </div>


       <div class="form-group">
                        <label for="username">Days<span style="color:red">*</span></label>
                        
                     
                        <input required class="form-control days"  placeholder="" type="text" name="days" id="days" value="">
                    
       </div>
       


       <div class="form-group">
                        <label for="username">End Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control enddate" readonly="readonly" placeholder="" type="text" name="applied_end_date" id="enddate"  id="end_date">
                    </div>
       </div>


        

      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


<script type="text/javascript">

    $(document).ready(function() {

        $('#days').keyup(function(){
          var start_date = $("#applied_start_date").val();
          var days = $("#days").val();
          
          alert(start_date);
          

          

    });

    });
</script>


@stop



<script type="text/javascript">








    



/*
$(document).ready(function(){

   
   alert('days');
            
    $("#days").keyup(function(){

        //var start_date = $("#applied_start_date").val();

        alert('days');

        /*
        var base_url = 'http://localhost/seller/public/clients/edit/'+id;

        $.ajax({

            type : 'GET',
            url :  base_url,
            dataType : 'json',
            success : function(data){
                  
                $("#supplierid").val(data.id);
                $("#supplierpaymentterms :selected").text(data.payment_terms);
                $("#suppliername").val(data.name);
                $("#supplieremail").val(data.email);
                $("#supplierphone").val(data.phone);
                $("#suppliercontactperson").val(data.contact_person);
                $("#suppliercontactpersonphone").val(data.contact_person_phone);
                
            },

            error : function(xhr, ajaxOptions, thrownError){

                alert(xhr.status);
            }

        });

        
    event.preventDefault();

    */

    //});



//});


</script>


