@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('acl::auth.user :name',['name'=>$user->name]))


@section('actions')
        <label for="user-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>

       
        <form method="post" action="{{ route('users.destroy',[$user->id]) }}" data-confirm="true" class="tgn-form d-inline-block">
            {{ csrf_field() }}
                
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm" type="submit" > @icon('trash') @lang("Remove user")</button>
        </form>

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.authorizations"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.users"), "url"=>route('users.index')],
          ['name'=>$user->name]
      ]
	 ])

  
@endsection

@section('body')
  <div class="pt-3">

    @row
        @col(['size'=>4])      
            @include("acl::users._form_update")
        @endcol
        @col(['size'=>8])      
          {{-- @select(['icon'=>'lock','name'=>'role_id', 'label'=>__('Roles'),'options'=>$roles,'selected'=>$user->roleIds(),'multiple'=>true,'required'=>false,'data'=>['live-search'=>true,'width'=>'100%']])  --}}
          @include("acl::users._userroles")
          

        @endcol
    @endrow
  </div>
@endsection
