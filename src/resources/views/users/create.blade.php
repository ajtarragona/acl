@extends('ajtarragona-web-components::layout/master-sidebar') 

@section('title' , __("New user"))


@section('actions')
    @buttongroup
        <label for="user-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>
    @endbuttongroup

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Home"), "url"=>route('home'), 'icon'=>'home'],
          ['name'=>__("Authentication"), "url"=>route('auth.dashboard')],
          ['name'=>__("Users"), "url"=>route('users.index')],
          ['name'=>__("New role")]
      ]
	 ])

  
@endsection

@section('body')
    @row
        @col(['size'=>8])     
            @include("auth.admin.users._form_create")


        @endcol
    @endrow

@endsection

        
       

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
