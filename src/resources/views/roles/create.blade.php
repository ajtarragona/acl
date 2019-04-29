@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("New role")) 


@section('actions')
    @buttongroup
        <label for="role-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Authentication"), "url"=>route('acl.dashboard')],
          ['name'=>__("Roles"), "url"=>route('roles.index')],
          ['name'=>__("New role")],
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
