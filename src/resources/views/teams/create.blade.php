@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title', __("New team")) 


@section('actions')
    @buttongroup
        <label for="team-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Home"), "url"=>route('home'), 'icon'=>'home'],
          ['name'=>__("Authentication"), "url"=>route('auth.dashboard')],
          ['name'=>__("Permissions"), "url"=>route('teams.index')],
          ['name'=>__("New team")],
      ]
	 ])

  
@endsection

@section('body')
    @row
        @col(['size'=>8])     
            @include("auth.admin.teams._form_create")


        @endcol
    @endrow

@endsection

        
       


@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
