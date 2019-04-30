<div class="mb-3 align-items-end ">

	@form(['method'=>"POST", "action"=>route('users.filter'),"class"=>"form-inline justify-content-center "])
		@input(['container'=>true,'name'=>'textfilter', 'placeholder'=>__('acl::auth.Type user name or email'),'value'=>$userfilter->textfilter]) 
		
		@select(['container'=>true,'name'=>'role_id', 'multiple'=>true,'label'=>__('acl::auth.Roles'),'placeholder'=>__('acl::auth.Choose roles'),'required'=>false,'options'=>$roles,'selected'=>$userfilter->role_id ,'data'=>['actions-box'=>true,'live-search'=>true,'width'=>'fit']]) 

		@button(['type'=>'submit','value'=>'submit','name'=>'submitaction','size'=>'sm','style'=>'secondary']) @icon('search') @lang('acl::auth.Do filter') @endbutton
		@button(['type'=>'submit','style'=>'light','size'=>'sm','outline'=>false,'value'=>'clear','name'=>'submitaction']) @icon('times') @lang('acl::auth.Clear filter') @endbutton


	@endform

	@tablecount(['collection'=> $users,'filter'=>$userfilter,'class'=>'mt-3'])
</div>