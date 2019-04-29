@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-role')

@section('title', ( !$role->id ? __('New role') : ( __('Role') . " " . $role->name ) ) )


@section('body')
	
	@if($role->id)
		@include('auth.admin.roles._form_update')
	@else
		@include('auth.admin.roles._form_create')
	@endif
@endsection