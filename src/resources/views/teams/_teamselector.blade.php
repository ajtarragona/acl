@if(config("laratrust.use_teams") && config("acl.team_selector") && Auth::user() && $teams=Auth::user()->userteams(true))
	{{-- @dump($currentteam) --}}
	@if($teams && $currentteam=currentteam()) 

		@nav([
			"navigation"=> 'dropdown',
			'class'=>'nav-dark',
			'id' => 'team-selector',
			'fullwidth'=>true,
			"items"=> [
				[
					"title" => __('acl::auth.Change team') ,
					"icon" => 'briefcase',
					"url" => '',
					"children" => $teams
				]
			]
		],['dropdown-vertical-direction' => 'top'])

	@endif
@endif