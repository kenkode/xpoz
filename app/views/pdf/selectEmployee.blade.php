@extends('layouts.main')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Select Employee</h3>

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

		 <form target="_blank" method="POST" action="{{URL::to('reports/occurence')}}" accept-charset="UTF-8">
   
    <fieldset>
            <div class="form-group">
                        <label for="username">Select:</label>
                        <select name="employeeid" class="form-control" required>
                            <option></option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id }}"> {{ $employee->first_name.' '.$employee->last_name }}</option>
                            @endforeach

                        </select>
                
        </div>

         <div class="form-group">
                        <label for="username">Download as: <span style="color:red">*</span></label>
                        <select required name="format" class="form-control">
                            <option></option>
                            <option value="excel"> Excel</option>
                            <option value="pdf"> PDF</option>
                        </select>
                
            </div>


        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Select Employee</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop