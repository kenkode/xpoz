@extends('layouts.erp')
@section('content')

<br><br>
		

<div class="row">
	
	<div class="col-lg-12">
  ASSET REGISTER MIGRATION
		<hr>

    @if (Session::get('notice'))
            <div class="alert alert-success">{{ Session::get('notice') }}</div>
        @endif


<p><strong>Migrate Asset Register</strong></p>

<a href="{{URL::to('template/assetregister')}}" > <i class="glyphicon glyphicon-file"></i> Download Asset Register Template</a>
    <p>&nbsp;</p>
    <form method="post" action="{{URL::to('import/assetregister')}}" accept-charset="UTF-8" enctype="multipart/form-data">

    <div class="form-group">

        <label>Upload Asset Register (excel)</label>
        <input type="file" class="" name="asset" />
            
    </div>
    
      
      <button type="submit" class="btn btn-primary">Import Asset Register</button>
    </form>

<!-- ############################################################  -->

    <hr>

  </div>
</div>


@stop