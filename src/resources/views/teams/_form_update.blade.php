@form([
    'method' => 'PUT', 
    'id'=>'team-form', 
    'action' => route('teams.update', [$team->id]), 
    'validator'=>'App/Http/Requests/Auth/TeamValidate',
    //'validateonchange' => true //'confirm'=>'estàs seguro?'
])  



	@include("auth.admin.teams._form_fields")


	@buttongroup
	    @button(['id'=>'team-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
	    @endbutton
	    
	    
	@endbuttongroup

@endform