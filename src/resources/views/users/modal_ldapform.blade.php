@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-ldap')

@section('title', __('acl::auth.searchldapusers') )


@section('body')
	
	
		@form([
		    'method' => 'POST', 
		    'id'=>'search-ldap-form', 
		    'action' => route('users.ldapmodalsearch'),
		    'data' =>[
		    	'target'=> '#ldap-search-results'
		    ],
		    'validator'=>'Ajtarragona/ACL/Requests/LdapSearchValidate',
		])  
			@row(['class'=>'gap-0'])
					@col(['size'=>10])

						@input(['name'=>'ldap_filter'])
					@endcol

					@col(['size'=>2])
				        @button(['id'=>'search-ldap-btn', 'class'=>'btn-block', 'type'=>'submit','value'=>'submit','name'=>'submitaction','style'=>'light','size'=>'sm'])  @icon('search') @lang('acl::auth.Search') 
				        @endbutton
				    @endcol
			@endrow
		@endform
        
        @row()
        	@col(['size'=>12])
        	<div id="ldap-search-results"></div>
		    @endcol
        @endrow
        

@endsection