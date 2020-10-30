@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title')
  @lang('acl::auth.Auth admin')
@endsection


@section('breadcrumb')
    @breadcrumb([
      "items"=>[
        ['name'=>__("acl::auth.Auth admin")]
      ]
    ])
  
@endsection

@section('body')
<div class="pt-3">
    
      @row
        @col(['size'=>3])
            @card(['title'=> icon('users'). " ".trans_choice("acl::auth.users",$n_users,['num'=>$n_users])])
              @slot('footer')
                <a class="btn btn-sm btn-light" href="{{ route('users.index')}}"> @lang("acl::auth.View all") </a>
                @modalopener(['class'=>'btn btn-sm btn-light','href'=>route('users.usermodal')])
                  @icon("plus")  @lang("acl::auth.New user") 
                @endmodalopener
              @endslot
            @endcard
        @endcol
        @col(['size'=>3])

            @card(['title'=> icon('lock'). " ".trans_choice("acl::auth.roles",$n_roles,['num'=>$n_roles]),'type'=>'info'])
              @slot('footer')
                <a class="btn btn-sm btn-info" href="{{ route('roles.index')}}"> @lang("acl::auth.View all") </a>
                @modalopener(['class'=>'btn btn-sm btn-info','href'=>route('roles.rolemodal')])
                  @icon("plus")  @lang("acl::auth.New role") 
                @endmodalopener
              @endslot

              @foreach($roles as $role)
                @badge(['href'=>route('roles.show',[$role->id]),'type'=>'dark']) {{ $role->name }}  @endbadge
              @endforeach
            @endcard



        @endcol


        @col(['size'=>3])

            @card(['title'=> icon('key'). " ".trans_choice("acl::auth.permissions",$n_perms,['num'=>$n_perms]),'type'=>'warning'])
              @slot('footer')
                <a class="btn btn-sm btn-warning" href="{{ route('permissions.index')}}"> @lang("acl::auth.View all") </a>
                 @modalopener(['class'=>'btn btn-sm btn-warning','href'=>route('permissions.permissionmodal')])
                    @icon("plus")  @lang("acl::auth.New permission") 
                 @endmodalopener
              @endslot

              @foreach($permissions as $permission)
               @badge(['href'=>route('permissions.show',[$permission->id]),'type'=>'dark']) {{ $permission->name }}  @endbadge
              @endforeach
            @endcard



        @endcol

        @if(config('laratrust.teams.enabled'))
          @col(['size'=>3])

              @card(['title'=> icon('briefcase'). ' '.trans_choice("acl::auth.teams",$n_teams,['num'=>$n_teams]),'type'=>'success'])
                @slot('footer')
                  <a class="btn btn-sm btn-success" href="{{ route('teams.index')}}"> @lang("acl::auth.View all") </a>
                   @modalopener(['class'=>'btn btn-sm btn-success','href'=>route('teams.teammodal')])
                      @icon("plus")  @lang("acl::auth.New team") 
                   @endmodalopener
                @endslot

                @foreach($teams as $team)
                 @badge(['href'=>route('teams.show',[$team->id]),'type'=>'dark']) {{ $team->name }}  @endbadge
                @endforeach
              @endcard



          @endcol
        @endif
        
      @endrow
           

</div>
     
@endsection
