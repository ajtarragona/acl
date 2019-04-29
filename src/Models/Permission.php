<?php

namespace Ajtarragona\ACL\Models;

use Laratrust\Models\LaratrustPermission;
use Kyslik\ColumnSortable\Sortable;

class Permission extends LaratrustPermission
{
   	use Sortable;
    
    public $sortable = [
       'name', 'display_name', 'description', 'id', 'created_at','updated_at'
    ];


    protected $fillable = [
        'name', 'display_name', 'description',
    ];

     public static function getAllCombo(){
    	$ret=[];
    	$all=self::all();
    	foreach($all as $item){
    		$ret[$item->id] = $item->display_name;
    	}
    	return $ret;

    }
}
