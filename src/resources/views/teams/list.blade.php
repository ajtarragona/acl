@extends('ajtarragona-web-components::layout/master-sidebar') 


@section('title', __('Teams'))


@section('actions')
 <a class="btn btn-sm btn-light tgn-modal-opener"  data-size='large' data-draggable='true' href="{{ route('teams.teammodal')}}">@icon("plus")  @lang("New team") </a>
@endsection

@section('breadcrumb')
    @breadcrumb([
      "items"=>[
          ['name'=>__("Home"), "url"=>route('home'), 'icon'=>'home'],
          ['name'=>__("Authorization"), "url"=>route('auth.dashboard')],
          ['name'=>__("Teams")]
      ] 
	 ])

  
@endsection

@section('body')
  @tablecount(['collection'=> $teams,'align'=>'left','class'=>'mb-3'])

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
      

@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
