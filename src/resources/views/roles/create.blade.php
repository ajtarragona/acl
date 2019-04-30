@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("acl::auth.New role")) 


@section('actions')
    @buttongroup
        <label for="role-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('tgn::strings.save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Roles"), "url"=>route('roles.index')],
          ['name'=>__("acl::auth.New role")],
      ]
	 ])

  
@endsection

@section('body')
 <div class="pt-3">
   @row
        @col(['size'=>8])     
            @include("acl::roles._form_create")


        @endcol
    @endrow
</div>
@endsection
