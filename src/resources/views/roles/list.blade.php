@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('acl::auth.Roles'))


@section('actions')
 <a class="btn btn-sm btn-light tgn-modal-opener"  data-size='large' data-draggable='true' href="{{ route('roles.rolemodal')}}">@icon("plus")  @lang("acl::auth.New role") </a>
@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Roles")],
      ]
	 ])

  
@endsection

@section('body')
  <div class="pt-3">

    @tablecount(['collection'=> $roles,'align'=>'left','class'=>'mb-3'])

     <div class="table-responsive">
          <table class="table  table-response">
            <thead>
              <tr>
                <th>@sortablelink('id',__('acl::auth.ID'))</th>
                <th>@sortablelink('name',__('acl::auth.Name'))</th>
                <th>@sortablelink('display_name',__('acl::auth.Display name'))</th>
                <th>@sortablelink('description',__('acl::auth.Description'))</th>
                <th>@lang('acl::auth.Permissions')</th>
              </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                      <td>{{$role->id }}</td>
                      <td><a href="{{ route('roles.show',[$role->id]) }} ">{{ $role->name }}</a></td>
                      <td>{{ $role->display_name }}</td>
                      <td>{{ $role->description }}</td>
                      <td>
                      @foreach($role->permissions as $p)
                          @badge(['pill'=>true,'href'=>route('permissions.show',[$p->id])]) {{$p->display_name}} @endbadge
                      @endforeach
                      </td>
                      
                    </tr>
                    @endforeach
            </tbody>
          </table>
          @pagination(['collection'=>$roles,'align'=>'center'])
    
        </div>
        
  </div>
@endsection