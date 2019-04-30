@form([
        'method' => 'POST', 
        'id'=>'permission-form', 
        'action' => route('permissions.store'), 
        'validator'=>'Ajtarragona/ACL/Requests/NewPermissionValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("acl::permissions._form_fields")
    
    
    @buttongroup
        @button(['id'=>'permission-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('tgn::strings.save') 
        @endbutton
        
        
    @endbuttongroup

@endform