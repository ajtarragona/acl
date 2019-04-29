@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-team')

@section('title', ( !$team->id ? __('New team') : ( __('Team') . " " . $team->name ) ) )


@section('body')
	
	@if($team->id)
		@include('acl::teams._form_update')
	@else
		@include('acl::teams._form_create')
	@endif
@endsection