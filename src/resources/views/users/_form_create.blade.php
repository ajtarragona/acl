@form([
        'method' => 'POST', 
        'id'=>'user-form', 
        'action' => route('users.store'), 
        'validator'=>'App/Http/Requests/Auth/NewUserValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("auth.admin.users._form_fields")
    @row(['class'=>'gap-sm'])
        @col(['size'=>6])
            @input(['name'=>'password', 'type'=>'password', 'required'=>true, 'label'=>__('Password'),'value'=>$user->name]) 
        @endcol
        @col(['size'=>6])
        
            @input(['name'=>'password_confirmation', 'type'=>'password', 'required'=>true, 'label'=>__('Confirm Password'),
            'value'=>$user->name]) 
        @endcol
    @endrow

    <hr/>
    
    @buttongroup
        @button(['id'=>'user-form-submit-btn', 'hidden'=>false, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('Save') 
        @endbutton
        
        
    @endbuttongroup

@endform