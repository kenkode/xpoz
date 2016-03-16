@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Maintenance</h3>

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

		 <form method="POST" action="{{{ URL::to('maintenances') }}}" accept-charset="UTF-8">
   
    <fieldset>
        

         

        <div class="form-group">
            <label for="username">Item <span style="color:red">*</span> :</label>
            <select name="item_id" class="form-control" required>

                @foreach($items as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            
        </div>


         <div class="form-group">
            <label for="username">Test <span style="color:red">*</span> :</label>
            <select name="test_id" class="form-control" required>

                @foreach($tests as $test)
                <option value="{{$test->id}}">{{$test->name}}</option>
                @endforeach
            </select>
            
        </div>


         <div class="form-group">
            <label for="username">Outcome <span style="color:red">*</span> :</label>
            <select name="outcome" class="form-control" required>

                <option value="passed">Passed</option>
                <option value="failed">Failed</option>
               
            </select>
            
        </div>


        <div class="form-group">
            <label for="username">Remarks:</label>
            <textarea name="remarks" class="form-control"></textarea>
            
        </div>



        

       
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop