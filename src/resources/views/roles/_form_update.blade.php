@form([
    'method' => 'PUT', 
    'id'=>'role-form', 
    'action' => route('roles.update', [$role->id]), 
    'validator'=>'App/Http/Requests/Auth/RoleValidate',
    //'validateonchange' => true //'confirm'=>'estàs seguro?'
])  



	@include("auth.admin.roles._form_fields")


	@buttongroup
	    @button(['id'=>'role-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
	    @endbutton
	    
	    
	@endbuttongroup

@endform