@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Test</h3>

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

		 <form method="POST" action="{{{ URL::to('tests') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username"> Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}" required>
        </div>

         

        <div class="form-group">
            <label for="username">Description </label>
            <textarea class="form-control" name="description"></textarea>
            
        </div>

        

       
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create </button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop