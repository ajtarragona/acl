@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("New team")) 


@section('actions')
    @buttongroup
        <label for="team-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Authentication"), "url"=>route('acl.dashboard')],
          ['name'=>__("Permissions"), "url"=>route('teams.index')],
          ['name'=>__("New team")],
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
