@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('User :name',['name'=>$user->name]))


@section('actions')
        <label for="user-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>

       
        <form method="post" action="{{ route('users.destroy',[$user->id]) }}" data-confirm="@lang("Are you sure?")" class="tgn-form d-inline-block">
            {{ csrf_field() }}
                
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm" type="submit" > @icon('trash') @lang("Remove user")</button>
        </form>

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Home"), "url"=>route('home'), 'icon'=>'home'],
          ['name'=>__("Authorization"), "url"=>route('auth.dashboard')],
          ['name'=>__("Users"), "url"=>route('users.index')],
          ['name'=>$user->name]
      ]
	 ])

  
@endsection

@section('body')
  
    @row
        @col(['size'=>4])      
            @include("auth.admin.users._form_update")
        @endcol
        @col(['size'=>8])      
          {{-- @select(['icon'=>'lock','name'=>'role_id', 'label'=>__('Roles'),'options'=>$roles,'selected'=>$user->roleIds(),'multiple'=>true,'required'=>false,'data'=>['live-search'=>true,'width'=>'100%']])  --}}
          @include("auth.admin.users._userroles")
          

        @endcol
    @endrow

@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection