@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-permission')

@section('title', ( !$permission->id ? __('acl::auth.New permission') : ( __('acl::auth.Permission :name',['name'=>$permission->name])  ) ) )


@section('body')
	
	@if($permission->id)
		@include('acl::permissions._form_update')
	@else
		@include('acl::permissions._form_create')
	@endif
@endsection



@section('footer')
<label for="permission-form-submit-btn" class="btn btn-sm btn-primary" role="button" tabindex="0"> @icon('save') @lang('tgn::strings.save')</label>
@endsection