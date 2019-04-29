@form([
        'method' => 'POST', 
        'id'=>'permission-form', 
        'action' => route('permissions.store'), 
        'validator'=>'Ajtarragona/ACL/Requests/NewPermissionValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("acl::permissions._form_fields")
    
    <hr/>
    
    @buttongroup
        @button(['id'=>'permission-form-submit-btn', 'hidden'=>false, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
        @endbutton
        
        
    @endbuttongroup

@endform