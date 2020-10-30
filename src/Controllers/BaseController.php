<?php

namespace Ajtarragona\ACL\Controllers; 

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Ajtarragona\ACL\Models\User;
use Ajtarragona\ACL\Models\Role;
use Ajtarragona\ACL\Models\Permission;
use Ajtarragona\ACL\Models\Team;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{

	
	public function dashboard(){
		$data = [];
        $n_users = User::all()->count();
        $roles = Role::all();
        $n_roles = $roles->count();
        $permissions = Permission::all();
        $n_perms = $permissions->count();
        $n_logged = Auth::user()->name;

        $data = [
            'n_users' => $n_users,
            'n_roles' => $n_roles,
            'n_perms' => $n_perms,
            'n_logged' => $n_logged,
            'roles' => $roles,
            'permissions' => $permissions,

        ];

        if(config('laratrust.teams.enabled')) { 
            $teams = Team::all();
            $n_teams = $teams->count();

            $data['teams'] = $teams;
            $data['n_teams'] = $n_teams;
        }
        
        return $this->view('dashboard',$data); 
	}
	
	public function view($view, $args=[]){
        if(!str_contains($view,"::")) $view="acl::".$view;

		return view($view, $args);
	}


    public function denied()
     {
       
       $error=to_object([
        "code" =>403,
        "title"=> __("acl::auth.Permission denied"),
        "message" => __("acl::auth.Access denied to selected resource"),
       ]);

       return view("ajtarragona-web-components::layout.error",compact('error'));
    }

	
}