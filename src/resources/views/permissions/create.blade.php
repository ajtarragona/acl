@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("acl::auth.New permission")) 


@section('actions')
    @buttongroup
        <label for="permission-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('tgn::strings.save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Permissions"), "url"=>route('permissions.index')],
          ['name'=>__("acl::auth.New permission")])
    ]
	 ])

  
@endsection

@section('body')
<div class="pt-3">
    @row
        @col(['size'=>8])     
            @include("acl::permissions._form_create")


        @endcol
    @endrow
</div>
@endsection

