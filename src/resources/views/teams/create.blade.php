@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("acl::auth.New team")) 


@section('actions')
    @buttongroup
        <label for="team-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('tgn::strings.save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Permissions"), "url"=>route('teams.index')],
          ['name'=>__("acl::auth.New team")],
      ]
	 ])

  
@endsection

@section('body')
  <div class="pt-3">

    @row
        @col(['size'=>8])     
            @include("acl::teams._form_create")


        @endcol
    @endrow
  </div>
  
@endsection
