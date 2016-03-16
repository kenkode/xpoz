@extends('layouts.main')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Emergency Contact</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

     @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('EmergencyContacts/create')}}">new contact</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Employee</th>
        <th>Contact Name</th>
         <th>ID Number</th>
         <th>Relationship</th>
         <th>Telephone number</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($contacts as $contact)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $contact->first_name.' '.$contact->last_name }}</td>
          <td>{{ $contact->name }}</td>
          @if($contact->id_number!=' ' || $contact->id_number!=null)
          <td>{{ $contact->id_number }}</td>
          @else
          <td></td>
          @endif
          @if($contact->id_number!=' ' || $contact->id_number!=null)
          <td>{{ $contact->relationship }}</td>
           @else
          <td></td>
          @endif
          
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('EmergencyContacts/view/'.$contact->id)}}">View</a></li>   

                    <li><a href="{{URL::to('EmergencyContacts/edit/'.$contact->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('EmergencyContacts/delete/'.$contact->id)}}" onclick="return (confirm('Are you sure you want to delete this employee`s emergency contact?'))">Delete</a></li>
                     

                 
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>

  </div>


  </div>

</div>

@stop


       
