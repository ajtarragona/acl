@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-permission')

@section('title', ( !$permission->id ? __('New permission') : ( __('Permission') . " " . $permission->name ) ) )


@section('body')
	
	@if($permission->id)
		@include('auth.admin.permissions._form_update')
	@else
		@include('auth.admin.permissions._form_create')
	@endif
@endsection