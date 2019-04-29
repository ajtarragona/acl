@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('Team :name',['name'=>$team->name]))


@section('actions')
        <label for="team-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('Save')
        </label>

       
        <form method="post" action="{{ route('teams.destroy',[$team->id]) }}" data-confirm="@lang("Are you sure?")" class="tgn-form d-inline-block">
            {{ csrf_field() }}
                
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm" type="submit" > @icon('trash') @lang("Remove team")</button>
        </form>

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Home"), "url"=>route('home'), 'icon'=>'home'],
          ['name'=>__("Authorization"), "url"=>route('auth.dashboard')],
          ['name'=>__("Teams"), "url"=>route('teams.index')],
          ['name'=>$team->name]
      ]
	 ])

  
@endsection

@section('body')
    @row
        @col(['size'=>8])      
            @include("auth.admin.teams._form_update")
        @endcol
    @endrow

@endsection


@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
