<?php

namespace Ajtarragona\ACL\Controllers;

use Illuminate\Http\Request;
use Ajtarragona\ACL\Controllers\BaseController as Controller;
use Ajtarragona\ACL\Models\User;
use Ajtarragona\ACL\Models\Role;
use Ajtarragona\ACL\Models\Team;
use Ajtarragona\ACL\Requests\TeamValidate;
use Ajtarragona\ACL\Requests\NewTeamValidate;


class TeamsController extends Controller
{
    
    
    // Index Page 
    public function index()
    {
        $teams = Team::sortable()->paginate(10);
        $params = [
            'teams' => $teams,
        ];

        return $this->view('teams.list')->with($params);
    }

    // Create Page
    public function create()
    {
        
        $params = [
            'team' => new Team()
        ];

        return $this->view('teams.create')->with($params);
    }

    // Create Page modal
    public function teammodal($team_id=false)
    {
        
        $team=new Team();
        if($team_id) $team=Team::find($team_id);

        $params = [
            'team' => $team
        ];

        return $this->view('teams.modal_form')->with($params);
    }

    // Store New
    public function store(NewTeamValidate $request)
    {
        $request->merge(['name' => kebab_case(strtolower($request->name))]);
            
        $team = Team::create($request->all());
        
        return redirect()->route('teams.index')->with('success', __("acl::auth.Team <strong>:name</strong> has successfully been created.",['name'=>$team->name]));
    }

    public function show(Team $team)
    {
      return $this->edit($team);
    }

    
    // Editing Information Page
    public function edit(Team $team)
    {
        try {
           
            $params = [
                'team' => $team
            ];
            return $this->view('teams.show')->with($params);
         } catch (ModelNotFoundException $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->view('ajtarragona-web-components::errors.' . '404',compact($exception));
            }
        }
    }

    // Update Information to DB
    public function update(TeamValidate $request, Team $team)
    {
        try {

            $request->merge(['name' => kebab_case(strtolower($request->name))]);
            $team->update($request->all());
            
            

            return redirect()->route('teams.show',[$team->id])->with('success', __("acl::auth.Team <strong>:name</strong> has successfully been updated.",['name'=>$team->name]));
         } catch (ModelNotFoundException $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->view('ajtarragona-web-components::errors.' . '404',compact($exception));
            }
        }
    }

    // Remove from DB 
    public function destroy(Team $team)
    {
        try{
            $teamname=$team->name;
            $team->delete();

            return redirect()->route('teams.index')->with('success', __("acl::auth.Team <strong>:name</strong> has successfully been deleted.",['name'=>$teamname])); 
        }catch(Exception $e){
             return redirect()->route('teams.index')->with(['error'=>__('acl::auth.Error deleting team.')]); 
        }
    }

    /*define el team de sesion*/
    public function teamset($team_id)
    {
        //dd($team_id);
        $team=Team::find($team_id);
        //dd($team);
        Team::setCurrent($team);

        return redirect()->route('home');
    }
}

