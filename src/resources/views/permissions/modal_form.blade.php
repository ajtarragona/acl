@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-permission')

@section('title', ( !$permission->id ? __('New permission') : ( __('Permission') . " " . $permission->name ) ) )


@section('body')
	
	@if($permission->id)
		@include('acl::permissions._form_update')
	@else
		@include('acl::permissions._form_create')
	@endif
@endsection