<?php

namespace Ajtarragona\ACL\Controllers;

use Illuminate\Http\Request;
use Ajtarragona\ACL\Controllers\BaseController as Controller;
use Ajtarragona\ACL\Models\User;
use Ajtarragona\ACL\Models\Role;
use Ajtarragona\ACL\Models\Permission;
use Ajtarragona\ACL\Requests\PermissionValidate;
use Ajtarragona\ACL\Requests\NewPermissionValidate;


class PermissionsController extends Controller
{
    
    
    // Index Page 
    public function index()
    {
        $permissions = Permission::sortable()->paginate(10);
        $params = [
            'permissions' => $permissions,
        ];

        return $this->view('permissions.list')->with($params);
    }

    // Create Page
    public function create()
    {
        
        $params = [
            'permission' => new Permission()
        ];

        return $this->view('permissions.create')->with($params);
    }

    // Create Page modal
    public function permissionmodal($permission_id=false)
    {
        
        $permission=new Permission();
        if($permission_id) $permission::find($permission_id);

        $params = [
            'permission' => $permission
        ];

        return $this->view('permissions.modal_form')->with($params);
    }

    // Store New
    public function store(NewPermissionValidate $request)
    {
        $request->merge(['name' => kebab_case(strtolower($request->name))]);
            
        $permission = Permission::create($request->all());
        
        return redirect()->route('permissions.index')->with('success', "The permission <strong>$permission->name</strong> has successfully been created.");
    }

    public function show(Permission $permission)
    {
      return $this->edit($permission);
    }

    
    // Editing Information Page
    public function edit(Permission $permission)
    {
        try {
           
            $params = [
                'permission' => $permission
            ];
            return $this->view('permissions.show')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return $this->view('errors.' . '404');
            }
        }
    }

    // Update Information to DB
    public function update(PermissionValidate $request, Permission $permission)
    {
        try {

            $request->merge(['name' => kebab_case(strtolower($request->name))]);
            $permission->update($request->all());
            
            

            return redirect()->route('permissions.show',[$permission->id])->with('success', "The permission <strong>$permission->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return $this->view('errors.' . '404');
            }
        }
    }

    // Remove permission from DB 
    public function destroy(Permission $permission)
    {
        try{
            $permission->delete();

            return redirect()->route('permissions.index')->with(['success'=>"The permission <strong>$permission->name</strong> has successfully been deleted"]); 
         }catch(Exception $e){
             return redirect()->route('permissions.index')->with(['error'=>'Error borrando permission']); 
        }
    }
}

