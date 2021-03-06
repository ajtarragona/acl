@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('acl::auth.Team :name',['name'=>$team->name]))


@section('actions')
        <label for="team-form-submit-btn" role="button" class="btn btn-primary btn-sm" tabindex="0">
          @icon('save') @lang('tgn::strings.save')
        </label>

       
        <form method="post" action="{{ route('teams.destroy',[$team->id]) }}" data-confirm="true" class="tgn-form d-inline-block">
            {{ csrf_field() }}
                
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm" type="submit" > @icon('trash') @lang("acl::auth.Remove team")</button>
        </form>

@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Teams"), "url"=>route('teams.index')],
          ['name'=>$team->name]
      ]
	 ])

  
@endsection

@section('body')
  <div class="pt-3">
    @row
        @col(['size'=>8])      
            @include("acl::teams._form_update")
        @endcol
    @endrow
  </div>
@endsection