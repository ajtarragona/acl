@form([
        'method' => 'POST', 
        'id'=>'user-form', 
        'action' => route('users.store'), 
        'validator'=>'Ajtarragona/ACL/Requests/NewUserValidate',
        //'validateonchange' => true //'confirm'=>'estàs seguro?'
    ])  

    

    @include("acl::users._form_fields")
    @row(['class'=>'gap-sm'])
        @col(['size'=>6])
            @input(['name'=>'password', 'type'=>'password', 'required'=>true, 'label'=>__('acl::auth.Password'),'value'=>$user->name]) 
        @endcol
        @col(['size'=>6])
        
            @input(['name'=>'password_confirmation', 'type'=>'password', 'required'=>true, 'label'=>__('acl::auth.Confirm Password'),
            'value'=>$user->name]) 
        @endcol
    @endrow

    
    @buttongroup
        @button(['id'=>'user-form-submit-btn', 'hidden'=>true, 'type'=>'submit','value'=>'submit','name'=>'submitaction'])  @icon('save') @lang('tgn::strings.save') 
        @endbutton
        
        
    @endbuttongroup

@endform