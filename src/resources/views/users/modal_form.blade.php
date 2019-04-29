@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-user')

@section('title', ( !$user->id ? __('New user') : ( __('User') . " " . $user->username ) ) )


@section('body')
	
	@if($user->id)
		@include('acl::users._form_update')
	@else
		@include('acl::users._form_create')
	@endif
@endsection