<div class="mb-3 align-items-end ">

	@form(['method'=>"POST", "action"=>route('users.filter'),"class"=>"form-inline justify-content-center "])
		@input(['container'=>true,'name'=>'textfilter', 'placeholder'=>__('Type user name or email'),'value'=>$userfilter->textfilter]) 
		
		@select(['container'=>true,'name'=>'role_id', 'multiple'=>true,'label'=>__('Roles'),'placeholder'=>__('Choose roles'),'required'=>false,'options'=>$roles,'selected'=>$userfilter->role_id ,'data'=>['actions-box'=>true,'live-search'=>true,'width'=>'fit']]) 

		@button(['type'=>'submit','value'=>'submit','name'=>'submitaction','size'=>'sm','style'=>'secondary']) @icon('search') @lang('Do filter') @endbutton
		@button(['type'=>'submit','style'=>'light','size'=>'sm','outline'=>false,'value'=>'clear','name'=>'submitaction']) @icon('times') @lang('Clear filter') @endbutton


	@endform

	@tablecount(['collection'=> $users,'filter'=>$userfilter,'class'=>'mt-3'])
</div>