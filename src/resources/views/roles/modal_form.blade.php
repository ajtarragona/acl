@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-role')

@section('title', ( !$role->id ? __('acl::auth.New role') : ( __('acl::auth.Role :name',['name'=>$role->name]) ) ) )


@section('body')
	
	@if($role->id)
		@include('acl::roles._form_update')
	@else
		@include('acl::roles._form_create')
	@endif
@endsection



@section('footer')
<label for="role-form-submit-btn" class="btn btn-sm btn-primary" role="button" tabindex="0"> @icon('save') @lang('tgn::strings.save')</label>
@endsection