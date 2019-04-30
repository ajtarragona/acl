@extends('ajtarragona-web-components::layout/modal')

@section('id','modal-team')

@section('title', ( !$team->id ? __('acl::auth.New team') : ( __('acl::auth.Team :name'.['name'=>$team->name])  ) ) )


@section('body')
	
	@if($team->id)
		@include('acl::teams._form_update')
	@else
		@include('acl::teams._form_create')
	@endif
@endsection


@section('footer')
<label for="team-form-submit-btn" class="btn btn-sm btn-primary" role="button" tabindex="0"> @icon('save') @lang('tgn::strings.save')</label>
@endsection