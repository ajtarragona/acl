@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("New permission")) 


@section('actions')
    @buttongroup
        <label for="permission-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Authentication"), "url"=>route('acl.dashboard')],
          ['name'=>__("Permissions"), "url"=>route('permissions.index')],
          ['name'=>__("New permission")])
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

