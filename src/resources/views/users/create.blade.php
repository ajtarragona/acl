@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title' , __("acl::auth.New user"))


@section('actions')
    @buttongroup
        <label for="user-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('tgn::strings.Save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('auth.dashboard')],
          ['name'=>__("acl::auth.Users"), "url"=>route('users.index')],
          ['name'=>__("acl::auth.New role")]
      ]
	 ])

  
@endsection

@section('body')
    @row
        @col(['size'=>8])     
            @include("auth.admin.users._form_create")


        @endcol
    @endrow

@endsection

        
       

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
