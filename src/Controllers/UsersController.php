<?php

namespace Ajtarragona\ACL\Controllers;

use Illuminate\Http\Request;
use Ajtarragona\ACL\Controllers\BaseController as Controller;
use Ajtarragona\ACL\Models\User;
use Ajtarragona\ACL\Models\Role;
use Ajtarragona\ACL\Models\Permission;
use Ajtarragona\ACL\Models\Team;
use Ajtarragona\ACL\Requests\UserValidate;
use Ajtarragona\ACL\Requests\NewUserValidate;
use Ajtarragona\ACL\Requests\LdapSearchValidate;
use Ajtarragona\ACL\Models\Filters\UserFilter;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\DB;
use Exception;  //si no se importa coge la Exception de PhP

class UsersController extends Controller
{
    
    
    // Index Page for Users
    public function index()
    {
        $userfilter=session('userfilter',new UserFilter());
        $roles = Role::getAllCombo();
        
        //$users = User::sortable()->paginate(10);


        
        $users=User::getFiltered($userfilter);


        $params = [
            'users' => $users,
            'userfilter' => $userfilter,
            'roles' => $roles,
        ];

        return $this->view('auth.admin.users.list')->with($params);
    }

    // Create User Page
    public function create()
    {
        $roles = Role::getAllCombo();
        $permissions = Permission::getAllCombo();

        $params = [
            'user' => new User(),
            'roles' => $roles,
            'permissions' => $permissions
        ];

        return $this->view('auth.admin.users.create')->with($params);
    }

    // Create User Page
    public function usermodal($user_id=false)
    {
        $roles = Role::getAllCombo();
        $permissions = Permission::getAllCombo();

        $user=new User();
        if($user_id) $user::find($user_id);

        $params = [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ];

        return $this->view('auth.admin.users.modal_form')->with($params);
    }

    // Store New User
    public function store(NewUserValidate $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'username' => sanitizeName($request->input('username')),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->attachRoleIds($request->input('role_id'));

        return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been created.");
    }

    // Delete Confirmation Page
    public function show(User $user)
    {
      return $this->edit($user);
    }

    // Editing User Information Page
    public function edit(User $user)
    {
        try {
            
            $roles = Role::getAllCombo();
            //$roles = Role::with('permissions')->get();
            $permissions = Permission::getAllCombo();

            $params = [
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions
            ];
            ///dd($params);

            return $this->view('auth.admin.users.show')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return $this->view('errors.' . '404');
            }
        }
    }

    // Update User Information to DB
    public function update(UserValidate $request, User $user)
    {
        try {

            $request->merge(['username' => sanitizeName($request->username)]);
            $user->update($request->all());
            
            // Update role of the user
            //$user->detachAllRoles();
            //$user->attachRoleIds($request->input('role_id'));


            // Update permission of the user
            //$permission = Permission::find($request->input('permission_id'));
            //$user->attachPermission($permission);

            return redirect()->route('users.show',[$user->id])->with('success', "The user <strong>$user->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return $this->view('errors.' . '404');
            }
        }
    }

    // Remove User from DB with detaching Role
    public function destroy(User $user)
    {
         //borra la categoria
        try{
            $user->detachAllRoles();
            $user->delete();

            return redirect()->route('users.index')->with(['success'=>"The user <strong>$user->name</strong> has successfully been deleted"]); 
         }catch(Exception $e){
             return redirect()->route('users.index')->with(['error'=>'Error borrando usuario']); 
        }
    }


     public function filter(Request $request){
        //dd($request->all());
        if($request->submitaction=="clear"){
           session(['userfilter'=> new UserFilter()]);
        }else{
            session(['userfilter'=> new UserFilter($request->all())]);
        }

        
        return redirect()->route('users.index');
    }

    public function addrolemodal($user_id){
         $user=User::find($user_id);
         $roles = Role::getAllCombo();
         $teams=Team::getAllCombo();

         return $this->view('auth.admin.users.modal_addrole',compact('user','roles','teams'));
    }


    public function addrole($user_id,Request $request){
        
        $user=User::find($user_id);

        try{
            $role=Role::find($request->role_id);

            if(isset($request->team_id)){
               
               $team=Team::find($request->team_id);
               $user->attachRole($role, $team); 

            }else{
                $user->attachRole($role); 
            }

            return redirect()->route('users.show',[$user_id])->with(['success'=>"Role added successfully "]); 
            
        }catch(Exception $e){
             return redirect()->route('users.show',[$user_id])->with(['error'=>'Error adding role']); 
        }
        //dd($request->all());
    }



    public function removerole($user_id,Request $request){
        $user=User::find($user_id);
        try{
            $role=Role::find($request->role_id);
            if(isset($request->team_id)){
                $team=Team::find($request->team_id);
                $user->detachRole($role, $team); 
            }else{
                 $user->detachRole($role);
            }
           
            return redirect()->route('users.show',[$user_id])->with(['success'=>"Role removed successfully "]); 
        }catch(Exception $e){
             return redirect()->route('users.show',[$user_id])->with(['error'=>'Error removing role']); 
        }
    }


    public function ldapmodalform(){
        return $this->view('auth.admin.users.modal_ldapform');
    }

    private function ldapsearch($filter){
        return Adldap::search()
            ->where('objectclass','=','user')
            ->orWhere('samaccountname','contains',$filter)
            ->orWhere('givenname','contains',$filter)
            ->orWhere('sn','contains',$filter)
            ->select(['distinguishedname','cn', 'givenname','sn', 'samaccountname', 'telephone', 'mail'])->get();

    }

    public function ldapcombosearch(Request $request){
        $filter=$request->term;
        $users=$this->ldapsearch($filter);
        //dd($users);
        $ret=[];
        foreach($users as $user){
            $ret[]=["value"=>$user->samaccountname[0], "name"=>$user->cn[0]  . " (".$user->samaccountname[0].")"];
        }
        return $ret;
    }

    public function ldapmodalsearch(LdapSearchValidate $request){
        //dd($request->all());
        // $users = Adldap::search()->users()->find('martinez')
        //$query="(&(objectclass=user)(|(samaccountname=*".$filtre."*)(givenname=*".$filtre."*)(sn=*".$filtre."*)))";
         $filter=$request->ldap_filter;
         $users = $this->ldapsearch($filter);

        return $this->view('auth.admin.users._ldapsearch',compact('users'));
        

    }
    public function ldapaddusers(Request $request){
        //dd($request->user_dn);
        try{
            
            if($request->user_dn){
                DB::beginTransaction();
                foreach($request->user_dn as $user_dn){
                    $ldapuser=Adldap::search()->findByDn($user_dn);
                    $user = User::create([
                        'name' => $ldapuser->cn[0],
                        'username' => $ldapuser->samaccountname[0],
                        'email' => $ldapuser->mail[0],
                        'password' => bcrypt('password'), //fake password, ldap pwd will be used
                    ]);

                }
                DB::commit();

                return redirect()->route('users.index')->with('success', __("auth.ldapusersadded"));
            }
            return redirect()->route('users.index');
       }catch(Exception $e){
           DB::rollBack();
           return redirect()->route('users.index')->with(['error'=>__("auth.ldapusersadderror")]); 
       }
    }
}
