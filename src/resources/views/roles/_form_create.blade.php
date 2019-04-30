@form([
        'method' => 'POST', 
        'id'=>'role-form', 
        'action' => route('roles.store'), 
        'validator'=>'Ajtarragona/ACL/Requests/NewRoleValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("acl::roles._form_fields")
    
    
    @buttongroup
        @button(['id'=>'role-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('tgn::strings.save') 
        @endbutton
        
        
    @endbuttongroup

@endform