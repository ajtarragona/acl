@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('Permissions'))


@section('actions')
 <a class="btn btn-sm btn-light tgn-modal-opener"  data-size='large' data-draggable='true' href="{{ route('permissions.permissionmodal')}}">@icon("plus")  @lang("New permission") </a>
@endsection

@section('breadcrumb')
  @breadcrumb([
      "items"=>[
          ['name'=>__("Home"), "url"=>route('home'), 'icon'=>'home'],
          ['name'=>__("Authorization"), "url"=>route('auth.dashboard')],
          ['name'=>__("Permissions")]
      ]
	 ])

  
@endsection

@section('body')
  @tablecount(['collection'=> $permissions,'align'=>'left','class'=>'mb-3'])

   <div class="table-responsive">
        <table class="table  table-response">
          <thead>
            <tr>
              <th>@sortablelink('id',__('ID'))</th>
              <th>@sortablelink('name',__('Name'))</th>
              <th>@sortablelink('display_name',__('Display name'))</th>
              <th>@sortablelink('description',__('Description'))</th>
            </tr>
          </thead>
          <tbody>
              @foreach($permissions as $permission)
                  <tr>
                    <td>{{$permission->id }}</td>
                    <td><a href="{{ route('permissions.show',[$permission->id]) }} ">{{ $permission->name }}</a></td>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ $permission->description }}</td>
                                       
                  </tr>
                  @endforeach
          </tbody>
        </table>
        @pagination(['collection'=>$permissions,'align'=>'center'])
  
      </div>
      

@endsection


@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
