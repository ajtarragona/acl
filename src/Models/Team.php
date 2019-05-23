<?php

namespace Ajtarragona\ACL\Models;

use Laratrust\Models\LaratrustTeam;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Team extends LaratrustTeam
{
    use Sortable;
    use Cachable;
    
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


  


   public function roles()
   {  
        //dump($this);
        //dump(config('laratrust'));
        $roles = $this->belongsToMany(
            config('laratrust.models.role'),
            config('laratrust.tables.role_user'),
            config('laratrust.foreign_keys.team'),
            config('laratrust.foreign_keys.role')
        )->withPivot(config('laratrust.foreign_keys.user'));
        
       // dump($roles);
        return $roles;
    }

   
   public static function current(){
      return session('currentteam');
   }

   public static function setCurrent($team)
   {
      //dd($team);
      session(['currentteam'=> $team]);
   } 
}
