@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-user')

@section('title', __('Add role to user') )


@section('body')
	
	@form([
	    'method' => 'POST', 
	    'id'=>'add-role-form', 
	    'action' => route('users.addrole', [$user->id]), 
	])  



	
    	@select([
    		'icon'=>'lock',
    		'name'=>'role_id', 
    		'label'=>__('Role'),
    		'options'=>$roles,
    		'multiple'=>false,
    		'required'=>true,
    		'data'=>['width'=>'100%']
    	]) 

    	@select([
    		'icon'=>'briefcase',
    		'name'=>'team_id', 
    		'label'=>__('Team'),
    		'options'=>$teams,
    		'multiple'=>false,
    		'required'=>false,
    		'data'=>['width'=>'100%']
    	]) 

	<hr/>

        @button(['id'=>'add-role-btn', 'type'=>'submit','value'=>'submit','name'=>'submitaction','style'=>'secondary','size'=>'sm'])  @icon('plus') @lang('Add role') 
        @endbutton
        
	@endform
        

@endsection