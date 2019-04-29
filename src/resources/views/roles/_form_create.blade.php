@form([
        'method' => 'POST', 
        'id'=>'role-form', 
        'action' => route('roles.store'), 
        'validator'=>'App/Http/Requests/Auth/NewRoleValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("auth.admin.roles._form_fields")
    
    <hr/>
    
    @buttongroup
        @button(['id'=>'role-form-submit-btn', 'hidden'=>false, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
        @endbutton
        
        
    @endbuttongroup

@endform