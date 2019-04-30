@form([
    'method' => 'PUT', 
    'id'=>'role-form', 
    'action' => route('roles.update', [$role->id]), 
    'validator'=>'Ajtarragona/ACL/Requests/RoleValidate',
    //'validateonchange' => true //'confirm'=>'estàs seguro?'
])  



	@include("acl::roles._form_fields")


	@buttongroup
	    @button(['id'=>'role-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('tgn::strings.save') 
	    @endbutton
	    
	    
	@endbuttongroup

@endform