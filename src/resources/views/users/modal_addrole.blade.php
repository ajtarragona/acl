@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-user')

@section('title', __('acl::auth.Add role to user') )


@section('footer')
<label for="add-role-btn" class="btn btn-sm btn-primary" role="button" tabindex="0"> @icon('plus') @lang('acl::auth.Add role') </label>
@endsection
@section('body')
	
	@form([
	    'method' => 'POST', 
	    'id'=>'add-role-form', 
	    'action' => route('users.addrole', [$user->id]), 
	])  



	
    	@select([
    		'icon'=>'lock',
    		'name'=>'role_id', 
    		'label'=>__('acl::auth.Role'),
    		'options'=>$roles,
    		'multiple'=>false,
    		'required'=>true,
    		'data'=>['width'=>'100%']
    	]) 

        @if(config('laratrust.use_teams'))
        	@select([
        		'icon'=>'briefcase',
        		'name'=>'team_id', 
        		'label'=>__('acl::auth.Team'),
        		'options'=>$teams,
        		'multiple'=>false,
        		'required'=>false,
        		'data'=>['width'=>'100%']
        	]) 
        @endif
	

        @button(['hidden'=>true,'id'=>'add-role-btn', 'type'=>'submit','value'=>'submit','name'=>'submitaction','style'=>'secondary','size'=>'sm'])  @icon('plus') @lang('acl::auth.Add role') 
        @endbutton
        
	@endform
        

@endsection