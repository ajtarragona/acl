<?php

namespace Ajtarragona\ACL\Controllers;

use Illuminate\Http\Request;
use Ajtarragona\ACL\Controllers\BaseController as Controller;
use Ajtarragona\ACL\Models\User;
use Ajtarragona\ACL\Models\Role;
use Ajtarragona\ACL\Models\Permission;
use Ajtarragona\ACL\Requests\RoleValidate;
use Ajtarragona\ACL\Requests\NewRoleValidate;


class RolesController extends Controller
{
    
    
    // Index Page for Users
    public function index()
    {
        $roles = Role::sortable()->paginate(10);
        $params = [
            'roles' => $roles,
        ];

        return $this->view('roles.list')->with($params);
    }

    // Create role Page
    public function create()
    {
        $permissions = Permission::getAllCombo();

        $params = [
            'role' => new Role(),
            'permissions' => $permissions
        ];

        return $this->view('roles.create')->with($params);
    }

    // Create User Page
    public function rolemodal($role_id=false)
    {
        $permissions = Permission::getAllCombo();

        $role=new Role();
        if($role_id) $role::find($role_id);

        $params = [
            'role' => $role,
            'permissions' => $permissions
        ];

        return $this->view('roles.modal_form')->with($params);
    }

    // Store New User
    public function store(NewRoleValidate $request)
    {
        $request->merge(['name' => sanitizeName($request->name)]);
            
        $role = Role::create($request->all());
        $role->attachPermissionIds($request->input('permission_id'));

        return redirect()->route('roles.index')->with('success', "The role <strong>$role->name</strong> has successfully been created.");
    }

    // Delete Confirmation Page
    public function show(Role $role)
    {
      return $this->edit($role);
    }

    // Editing User Information Page
    public function edit(Role $role)
    {
        try {
            $permissions = Permission::getAllCombo();

            $params = [
                'role' => $role,
                'permissions' => $permissions
            ];
            ///dd($params);

            return $this->view('roles.show')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return $this->view('errors.' . '404');
            }
        }
    }

    // Update User Information to DB
    public function update(RoleValidate $request, Role $role)
    {
        try {

            $request->merge(['name' => sanitizeName($request->name)]);
            $role->update($request->all());
            
            // Update permissions of the role
            $role->detachAllPermissions();
            $role->attachPermissionIds($request->input('permission_id'));

            

            return redirect()->route('roles.show',[$role->id])->with('success', "The role <strong>$role->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return $this->view('errors.' . '404');
            }
        }
    }

    // Remove User from DB with detaching Role
    public function destroy(Role $role)
    {
        try{
            //$user->detachAllRoles();
            $role->delete();

            return redirect()->route('roles.index')->with(['success'=>"The role <strong>$role->name</strong> has successfully been deleted"]); 
         }catch(Exception $e){
             return redirect()->route('roles.index')->with(['error'=>'Error borrando rol']); 
        }
    }
}

