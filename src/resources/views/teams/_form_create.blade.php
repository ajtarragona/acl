@form([
        'method' => 'POST', 
        'id'=>'team-form', 
        'action' => route('teams.store'), 
        'validator'=>'App/Http/Requests/Auth/NewTeamValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("auth.admin.teams._form_fields")
    
    <hr/>
    
    @buttongroup
        @button(['id'=>'team-form-submit-btn', 'hidden'=>false, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
        @endbutton
        
        
    @endbuttongroup

@endform