@row(['class'=>'gap-sm'])
	@col(['size'=>8])
		@input(['name'=>'name', 'required'=>true, 'label'=>__('acl::auth.Name'),'value'=>$user->name]) 
	@endcol
	@col(['size'=>4])
		@input(['name'=>'username', 'required'=>true,'label'=>__('acl::auth.Username'),'value'=>$user->username]) 
	@endcol
@endrow
@input(['icon'=>'envelope','required'=>true,'name'=>'email','label'=>__('acl::auth.Email'),'value'=>$user->email]) 

