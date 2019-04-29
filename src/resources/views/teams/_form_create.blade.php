@form([
        'method' => 'POST', 
        'id'=>'team-form', 
        'action' => route('teams.store'), 
        'validator'=>'Ajtarragona/ACL/Requests/NewTeamValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("acl::teams._form_fields")
    
    <hr/>
    
    @buttongroup
        @button(['id'=>'team-form-submit-btn', 'hidden'=>false, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
        @endbutton
        
        
    @endbuttongroup

@endform