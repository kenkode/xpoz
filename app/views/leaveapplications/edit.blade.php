@extends('layouts.leave')

{{HTML::script('media/jquery-1.8.0.min.js') }}

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

     <form method="POST" action="{{{ URL::to('leaveapplications/update/'.$leaveapplication->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
            <label for="username">Employee</label>
            <select class="form-control" name="employee_id" id="employee">
            <option value="{{$leaveapplication->employee->id}}">{{$leaveapplication->employee->first_name." ".$leaveapplication->employee->last_name." ".$leaveapplication->employee->middle_name}}</option>
              @foreach($employees as $employee)  
                    <option value="{{$employee->id}}">{{$employee->first_name." ".$employee->last_name." ".$employee->middle_name}}</option>
              @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="username">Leave type</label>
            <select class="form-control" name="leavetype_id" id="leave">
            <option value="{{$leaveapplication->leavetype->id}}">{{$leaveapplication->leavetype->name}}</option>
              @foreach($leavetypes as $leavetype)  
                    <option value="{{$leavetype->id}}">{{$leavetype->name}}</option>
              @endforeach
            </select>
        </div>


        <div class="form-group">
                        <label for="username">Start Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="applied_start_date" id="appliedstartdate" value="{{$leaveapplication->applied_start_date}}">
                    </div>
       </div>


       <div class="form-group">
                        <label for="username">Days <span style="color:red">*</span></label>
                        
                        <input required class="form-control days"  placeholder="" type="text" name="days" id="days" value="{{Leaveapplication::getLeaveDays($leaveapplication->applied_start_date, $leaveapplication->applied_end_date)}}">
                   
       </div>


       <div class="form-group">
                        <label for="username">End Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="applied_end_date" id="applied_end_date" value="{{$leaveapplication->applied_end_date}}">
                    </div>
       </div>


        

      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>

    </fieldset>
</form>
    

  </div>

</div>


<script type="text/javascript">


$(document).ready(function(){

    $('#days').keyup(function(){

       var date = new Date($("#appliedstartdate").val()),
           days = parseInt($("#days").val(), 10);

        if(!isNaN(date.getTime())){
            date.setDate(date.getDate() + days);

            $("#applied_end_date").val(date.toInputFormat());
        } else {
             
        }

         $.get("{{ url('api/getDays')}}", 
         { employee: $('#employee').val(),
           leave: $('#leave').val(),
           option: $('#days').val()
         }, 
         function(data) {
         if(data<0){
          console.log(data);
          alert("Days given exceed assigned leave days! Current employee balance is "+(parseInt($("#days").val())+parseInt(data)));
          $('#days').val('{{Leaveapplication::getLeaveDays($leaveapplication->applied_start_date, $leaveapplication->applied_end_date)}}');
          $('#applied_end_date').val("{{$leaveapplication->applied_end_date}}");
         }
         
      });

    });


    //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    };


});



</script>

@stop

