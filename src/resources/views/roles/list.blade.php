@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('Roles'))


@section('actions')
 <a class="btn btn-sm btn-light tgn-modal-opener"  data-size='large' data-draggable='true' href="{{ route('roles.rolemodal')}}">@icon("plus")  @lang("New role") </a>
@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Authorization"), "url"=>route('acl.dashboard')],
          ['name'=>__("Roles")],
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
                <th>@sortablelink('id',__('ID'))</th>
                <th>@sortablelink('name',__('Name'))</th>
                <th>@sortablelink('display_name',__('Display name'))</th>
                <th>@sortablelink('description',__('Description'))</th>
                <th>@lang('Permissions')</th>
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