<p>
Hello, 
</p>

<p>A new Leave application applied by {{$name}}: </p>
<br>

<table>

<thead style="background-color:gray; color:white;">
	<th colspan="2">Application Details</th>
</thead>
<tbody>
	<tr>
		<td>Employee</td><td>{{$name}}</td>
	</tr>
	<tr>
		<td>Leave Type</td><td>{{Leavetype::getName($application->leavetype_id)}}</td>
	</tr>
	<tr>
		<td>Application Date</td><td>{{$application->application_date}}</td>
	</tr>

	<tr>
		<td>Applied Start Date</td><td>{{$application->applied_start_date}}</td>
	</tr>


	<tr>
		<td>Applied End Date</td><td>{{$application->applied_end_date}}</td>
	</tr>


	<tr>
		<td>Days</td><td>{{Leaveapplication::getDays($application->applied_end_date,$application->applied_start_date,$application->is_weekend,$application->is_holiday)+1}}</td>
     </tr>

</tbody>
	
</table>




<br><br>
<p>Regards,</p>
<p>Xpose Limited.</p>
