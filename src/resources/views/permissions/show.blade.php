@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('acl::auth.Permission :name',['name'=>$permission->name]))


@section('actions')
      <label for="permission-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
        @icon('save') @lang('tgn::strings.save')
      </label>

     
      <form method="post" action="{{ route('permissions.destroy',[$permission->id]) }}" data-confirm="true" class="tgn-form d-inline-block">
          {{ csrf_field() }}
              
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-danger btn-sm" type="submit" > @icon('trash') @lang("acl::auth.Remove permission")</button>
      </form>

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Permissions"), "url"=>route('permissions.index')],
          ['name'=>$permission->name]
      ]
	 ])

  
@endsection

@section('body')
   <div class="pt-3">

    @row
        @col(['size'=>8])      
            @include("acl::permissions._form_update")
        @endcol
    @endrow
  </div>  
@endsection
