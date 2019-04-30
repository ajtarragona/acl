@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-user')

@section('title', ( !$user->id ? __('acl::auth.New user') : ( __('acl::auth.User :name',['name'=>$user->username]) ) ) )


@section('body')
	
	@if($user->id)
		@include('acl::users._form_update')
	@else
		@include('acl::users._form_create')
	@endif
@endsection


@section('footer')
<label for="user-form-submit-btn" class="btn btn-sm btn-primary" role="button" tabindex="0"> @icon('save') @lang('tgn::strings.save')</label>
@endsection