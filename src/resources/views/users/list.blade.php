@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('Users'))


@section('actions')
 <button class="btn @if($userfilter->hasFilters()) btn-outline-dark @else btn-light @endif btn-sm" type="button" data-toggle="collapse" data-target="#userfilters" aria-expanded="false" aria-controls="userfilters">@icon('filter') @lang("Filters")</button>

<a class="btn btn-sm btn-light tgn-modal-opener"  data-size='lg' data-draggable='true' href="{{ route('users.usermodal')}}">@icon("plus")  @lang("New user") </a>

<a class="btn btn-sm btn-light tgn-modal-opener"  data-size='lg' data-draggable='true' href="{{ route('users.ldapmodalform')}}">@icon("plus")  @lang("auth.addfromldap") </a>
@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.authorizations"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.users")]
      ]
	 ])

  
@endsection

@section('body')
<div class="pt-3">
  <div id="userfilters" class="collapse @if($userfilter->hasFilters()) show @endif">@include('acl::users._filters')</div>


   <div class="table-responsive">
        <table class="table  table-response">
          <thead>
            <tr>
              <th>@sortablelink('id',__('ID'))</th>
              <th>@sortablelink('name',__('Name'))</th>
              <th>@sortablelink('username',__('Username'))</th>
              <th>@sortablelink('email',__('Email'))</th>
              <th>Role/s</th>
            </tr>
          </thead>
          <tbody>
              @foreach($users as $user)
                  <tr>
                    <td>{{$user->id }}</td>
                    <td><a href="{{ route('users.show',[$user->id]) }} ">{{ $user->name }}</a></td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                    @foreach($user->roles as $r)
                        @badge(['pill'=>true,'href'=>route('roles.show',[$r->id]) ]) {{$r->roleName()}} @endbadge
                    @endforeach
                    </td>
                    
                  </tr>
                  @endforeach
          </tbody>
        </table>
        @pagination(['collection'=>$users,'align'=>'center'])
  
      </div>
</div>      

@endsection