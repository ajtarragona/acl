@form([
    'method' => 'PUT', 
    'id'=>'user-form', 
    'action' => route('users.update', [$user->id]), 
    'validator'=>'App/Http/Requests/Auth/UserValidate',
    //'validateonchange' => true //'confirm'=>'estàs seguro?'
])  



	@include("auth.admin.users._form_fields")


	@buttongroup
	    @button(['id'=>'user-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
	    @endbutton
	    
	    
	@endbuttongroup

@endform