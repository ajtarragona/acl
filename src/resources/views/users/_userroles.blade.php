@if($user->roles)
	<table class="table table-sm">
		<thead>
			<tr>
				<th>@lang("Role")</th>
				<th>@lang("Group")</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($user->roles as $role)
				<tr>
					<td>{{$role->display_name}}</td>
					<td>{{ $role->team()?$role->team()->display_name:'' }}</td>
					<td class="text-right">
							@form([
							    'method' => 'DELETE', 
							    'id'=>'remove-role-form-'.$role->id, 
							    'action' => route('users.removerole', [$user->id]), 
							])  
								<input type="hidden" name="role_id" value="{{$role->id}}"/>
								<input type="hidden" name="team_id" value="{{$role->pivot->team_id}}"/>
								<button type="submit" class="btn btn-xs btn-danger">@icon('times')</button>

							@endform
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a class="btn btn-xs btn-light tgn-modal-opener" href="{{ route('users.addrolemodal',[$user->id])}}">@icon('plus') @lang("New role")</a>
@endif

