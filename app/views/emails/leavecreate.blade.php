<p>
Hello {{$name}}, 
</p>

<p>Your Leave application has been approved: </p>
<br>

<table>

<thead style="background-color:gray; color:white;">
	<th colspan="2">Application Details</th>
</thead>
<tbody>
	<tr>
		<td>Leave Type</td><td>{{Leavetype::getName($application->id)}}</td>
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
		<td>Days</td><td>{{Leaveapplication::getLeaveDays($application->applied_start_date, $application->applied_end_date )}}</td>
	</tr>

</tbody>
	
</table>




<br><br>
<p>Regards,</p>
<p>Xpose Limited.</p>
