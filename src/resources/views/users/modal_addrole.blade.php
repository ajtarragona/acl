@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-user')

@section('title', __('acl::auth.Add role to user') )


@section('footer')
<label for="add-role-btn" class="btn btn-sm btn-primary" role="button" tabindex="0"> @icon('save') @lang('acl::auth.Save roles') </label>
@endsection
@section('body')
	
	@form([
	    'method' => 'POST', 
	    'id'=>'add-role-form', 
	    'action' => route('users.addrole', [$user->id]), 
	])  



	
    	
        @if(config('laratrust.teams.enabled'))
			@select([
				'icon'=>'lock',
				'name'=>'role_id', 
				'label'=>__('acl::auth.Role'),
				'options'=>$roles,
				'multiple'=>false,
				'required'=>true,
				'data'=>['width'=>'100%']
			]) 

        	@select([
        		'icon'=>'briefcase',
        		'name'=>'team_id', 
        		'label'=>__('acl::auth.Team'),
        		'options'=>$teams,
        		'multiple'=>false,
        		'required'=>false,
        		'data'=>['width'=>'100%']
        	]) 
        @else
			@select([
				'icon'=>'lock',
				'name'=>'role_id', 
				'label'=>__('acl::auth.Role'),
				'options'=>$roles,
				'selected'=>$user_roles,
				'multiple'=>true,
				'required'=>true,
				'data'=>['width'=>'100%']
			]) 
        @endif
	

        @button(['hidden'=>true,'id'=>'add-role-btn', 'type'=>'submit','value'=>'submit','name'=>'submitaction','style'=>'secondary','size'=>'sm'])  @icon('plus') @lang('acl::auth.Add roles') 
        @endbutton
        
	@endform
        

@endsection