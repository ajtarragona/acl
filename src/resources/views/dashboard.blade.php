@extends('ajtarragona-web-components::layout/master-sidebar') 
@section('title')
  @lang('Auth dashboard')
@endsection


@section('breadcrumb')
    @breadcrumb([
      "items"=>[
        ['name'=>__("Home"),"url"=>route('home'),'icon'=>'home'],
        ['name'=>__("Authorization")]
      ]
    ])
  
@endsection

@section('body')

   
      @row
        @col(['size'=>3])
            @card(['title'=> icon('users'). ' '.$n_users." ".__("Users")])
              @slot('footer')
                <a class="btn btn-sm btn-light" href="{{ route('users.index')}}"> @lang("View all") </a>
                <a class="btn btn-sm btn-light tgn-modal-opener"  data-size="large" data-draggable='true' href="{{ route('users.usermodal')}}">@icon("plus")  @lang("New user") </a>
              @endslot
            @endcard
        @endcol
        @col(['size'=>3])

            @card(['title'=> icon('lock'). ' '.$n_roles." ".__("Roles"),'type'=>'info'])
              @slot('footer')
                <a class="btn btn-sm btn-info" href="{{ route('roles.index')}}"> @lang("View all") </a>
                <a class="btn btn-sm btn-info tgn-modal-opener"  data-draggable='true' href="{{ route('roles.rolemodal')}}">@icon("plus")  @lang("New role") </a>
              @endslot

              @foreach($roles as $role)
                @badge(['href'=>route('roles.show',[$role->id]),'type'=>'dark']) {{ $role->name }}  @endbadge
              @endforeach
            @endcard



        @endcol


        @col(['size'=>3])

            @card(['title'=> icon('key'). ' '.$n_perms." ".__("Permissions"),'type'=>'warning'])
              @slot('footer')
                <a class="btn btn-sm btn-warning" href="{{ route('permissions.index')}}"> @lang("View all") </a>
                 <a class="btn btn-sm btn-warning tgn-modal-opener"  data-draggable='true' href="{{ route('permissions.permissionmodal')}}">@icon("plus")  @lang("New permission") </a>
              @endslot

              @foreach($permissions as $permission)
               @badge(['href'=>route('permissions.show',[$permission->id]),'type'=>'dark']) {{ $permission->name }}  @endbadge
              @endforeach
            @endcard



        @endcol

        @col(['size'=>3])

            @card(['title'=> icon('briefcase'). ' '.$n_teams." ".__("Teams"),'type'=>'success'])
              @slot('footer')
                <a class="btn btn-sm btn-success" href="{{ route('teams.index')}}"> @lang("View all") </a>
                 <a class="btn btn-sm btn-success tgn-modal-opener"  data-draggable='true' href="{{ route('teams.teammodal')}}">@icon("plus")  @lang("New team") </a>
              @endslot

              @foreach($teams as $team)
               @badge(['href'=>route('teams.show',[$team->id]),'type'=>'dark']) {{ $team->name }}  @endbadge
              @endforeach
            @endcard



        @endcol

      @endrow
           


     
@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection