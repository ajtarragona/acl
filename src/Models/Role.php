<?php

namespace Ajtarragona\ACL\Models;

use Laratrust\Models\LaratrustRole;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Auth\Team;

class Role extends LaratrustRole
{
    use Sortable;
    
    public $sortable = [
       'name', 'display_name', 'description', 'id', 'created_at','updated_at'
    ];

    protected $fillable = [
        'name', 'display_name', 'description',
    ];


   public function team(){
        if($this->pivot && $this->pivot->team_id)
            return Team::find($this->pivot->team_id);
        return false;
   }

   public function roleName(){
    $ret=$this->display_name;
    if($this->team()) $ret.=" > ". $this->team()->display_name;
    return $ret;
   }

    public static function getAllCombo(){
    	$ret=[];
    	$all=self::all();
    	foreach($all as $item){
    		$ret[$item->id] = $item->display_name;
    	}
    	return $ret;

    }


     public function permissionIds(){
        $ret=[];
        foreach($this->permissions as $permission){
            $ret[] = $permission->id;
        }
        return $ret;

    }


    public function detachAllPermissions(){
        if(!$this->permissions) return;
        foreach ($this->permissions as $key => $value) {
            $this->detachPermission($value);
        }
    }

    public function attachPermissionIds($ids){
        $permissions = Permission::find($ids);
        //dd($roles);
        if($permissions){
            foreach($permissions as $permission){
                $this->attachPermission($permission);
            }
        }
    }
}
