@form([
        'method' => 'POST', 
        'id'=>'team-form', 
        'action' => route('teams.store'), 
        'validator'=>'Ajtarragona/ACL/Requests/NewTeamValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("acl::teams._form_fields")
    
    
    @buttongroup
        @button(['id'=>'team-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('tgn::strings.save') 
        @endbutton
        
        
    @endbuttongroup

@endform