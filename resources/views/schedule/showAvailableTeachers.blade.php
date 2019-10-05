<option>--- Select Teacher ---</option>
@if(!empty($user_names_ary) or $user_names_ary!=0)
	@foreach($user_names_ary as $key => $usernames)
		<option value="{{$usernames['id']}}" >{{ $usernames['fname'] }} {{ $usernames['lname'] }} </option>
	@endforeach
@else
	<option value="0" >No Data</option>
@endif


