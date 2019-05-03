@if(config("acl.team_selector") && Auth::user() && $teams=Auth::user()->userteams(true))
	{{-- @dump($currentteam) --}}
	@if($teams && $currentteam=currentteam()) 

		@nav([
			"navigation"=> 'collapse',
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
		])

	@endif
@endif