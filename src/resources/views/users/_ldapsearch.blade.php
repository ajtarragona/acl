@if(isset($users) && $users->count()>0)
	@form([
	    'method' => 'POST', 
	    'action' => route('users.ldapaddusers')
	])  
    @tablecount(['collection'=> $users,'filter'=>false,'class'=>'mt-2 mb-3'])
  <div style="max-height: 60vh;overflow-y: auto">
     
     {{-- @dump($users->count()) --}}
	 <table class="table table-sm table-response " data-selectable="true">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>@lang("acl::auth.Username")</th>
              <th>@lang("acl::auth.Name")</th>
              <th>@lang("acl::auth.Email")</th>
              
            </tr>
          </thead>
          <tbody>
              @foreach($users as $user)
                  <tr>
                    <td>@checkbox(['renderhelper'=>false,'class'=>'row-selector','name'=>'user_dn[]','value'=>$user->distinguishedname[0]]) {{-- {{ $user->distinguishedname[0] }} --}} </td>
                    <td>{{$user->samaccountname[0] }}</td>
                    <td>{{$user->cn[0] }}</td>
                    <td>{{$user->mail[0] }}</td>
                  </tr>
               @endforeach
          </tbody>
        </table>
    </div>
    
    <hr/>
    
    @button(['type'=>'submit','size'=>'sm','style'=>'secondary'])
    	@icon('plus') @lang("acl::auth.addselectedusers")
    @endbutton

    @endform
@else
	@card(['type'=>'info'])
    @lang("acl::auth.noresults")
  @endcard
@endif