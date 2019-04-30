@if($user->roles)
	<table class="table table-sm">
		<thead>
			<tr>
				<th>@lang("acl::auth.Role")</th>
				<th>@lang("acl::auth.Team")</th>
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
							    'confirm'=>__("acl::auth.Role will be removed from user.<br/>Are you sure?") 
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
	@modalopener(['href'=>route('users.addrolemodal',[$user->id]),'class'=>'btn btn-sm btn-light '])
		@icon('plus') @lang("acl::auth.New role")
	@endmodalopener
	
@endif
