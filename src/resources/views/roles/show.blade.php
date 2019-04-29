@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('Role :name',['name'=>$role->name]))


@section('actions')
        <label for="role-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>

       
        <form method="post" action="{{ route('roles.destroy',[$role->id]) }}" data-confirm="@lang("Are you sure?")" class="tgn-form d-inline-block">
            {{ csrf_field() }}
                
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm" type="submit" > @icon('trash') @lang("Remove role")</button>
        </form>

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Authorization"), "url"=>route('acl.dashboard')],
          ['name'=>__("Roles"), "url"=>route('roles.index')],
          ['name'=>$role->name],
      ]
	 ])

  
@endsection

@section('body')
<div class="pt-3">

    @row
        @col(['size'=>8])      
            @include("acl::roles._form_update")
        @endcol
    @endrow
</div>
@endsection
