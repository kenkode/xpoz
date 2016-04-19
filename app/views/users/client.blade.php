@extends('layouts.membercss')
@section('content')

<br/>

<div class="row">

	<div class="col-lg-5">

		<table class="table table-condensed table-bordered">

            <tr>
                <td>username</td><td>{{ $user->username}}</td>
            </tr>
            <tr>
                <td>email</td><td>{{ $user->email}}</td>
            </tr>
            <tr>
                <td>password</td><td><a class="btn btn-info btn-xs" href="{{URL::to('users/change/'.$user->id)}}">change</a></td>

            </tr>
           
        </table>
		

  </div>
</div>










@stop