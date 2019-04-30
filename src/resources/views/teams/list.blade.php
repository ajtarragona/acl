@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('acl::auth.Teams'))


@section('actions')
 <a class="btn btn-sm btn-light tgn-modal-opener"  data-size='large' data-draggable='true' href="{{ route('teams.teammodal')}}">@icon("plus")  @lang("acl::auth.New team") </a>
@endsection

@section('breadcrumb')
    @breadcrumb([
      "items"=>[
          ['name'=>__("acl::auth.Auth admin"), "url"=>route('acl.dashboard')],
          ['name'=>__("acl::auth.Teams")]
      ] 
	 ])

  
@endsection

@section('body')
  <div class="pt-3">

    @tablecount(['collection'=> $teams,'align'=>'left','class'=>'mb-3'])

     <div class="table-responsive">
          <table class="table  table-response">
            <thead>
              <tr>
                <th>@sortablelink('id',__('acl::auth.ID'))</th>
                <th>@sortablelink('name',__('acl::auth.Name'))</th>
                <th>@sortablelink('display_name',__('acl::auth.Display name'))</th>
                <th>@sortablelink('description',__('acl::auth.Description'))</th>
              </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                    <tr>
                      <td>{{$team->id }}</td>
                      <td><a href="{{ route('teams.show',[$team->id]) }} ">{{ $team->name }}</a></td>
                      <td>{{ $team->display_name }}</td>
                      <td>{{ $team->description }}</td>
                                         
                    </tr>
                    @endforeach
            </tbody>
          </table>
          @pagination(['collection'=>$teams,'align'=>'center'])
    
        </div>
    </div>    

@endsection