@form([
    'method' => 'PUT', 
    'id'=>'user-form', 
    'action' => route('users.update', [$user->id]), 
    'validator'=>'Ajtarragona/ACL/Requests/UserValidate',
    //'validateonchange' => true //'confirm'=>'estàs seguro?'
])  



	@include("acl::users._form_fields")


	@buttongroup
	    @button(['id'=>'user-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
	    @endbutton
	    
	    
	@endbuttongroup

@endform