<?php

namespace Ajtarragona\ACL\Models;

//use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Ajtarragona\ACL\Models\Role;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    //use HasApiTokens,Notifiable;
    use LaratrustUserTrait;
    use Notifiable;
    use Sortable;
    use HasApiTokens;
    
  public $sortable = ['name',
                    'username',
                    'email',
                    'id',
                    'created_at',
                    'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // public function roles(){
    //     return $this->hasMany(Role::class)->withPivot('team_id');
    // }

    public function roleIds(){
        $ret=[];
        $roles=$this->roles;
        //dd($roles->pluck('id'));
        foreach($roles as $role){
            $ret[] = $role->id;
        }
        return $ret;

    }

    public function roleNames(){
        $ret=collect();
        $roles=$this->roles;
        //dd($roles->pluck('id'));
        foreach($roles as $role){
            $ret->push($role->roleName());
        }
        return $ret;

    }

    public function detachAllRoles(){
        if(!$this->roles) return;
        foreach ($this->roles as $key => $value) {
            $this->detachRole($value);
        }
    }

    public function attachRoleIds($ids){
        $roles = Role::find($ids);
        //dd($roles);
        if($roles){
            foreach($roles as $role){
                $this->attachRole($role);
            }
        }

        
    }

    public static function getFiltered($filters=false){
        $ret= self::sortable()->filter($filters)->paginate(10,['*'],"users");
        //dd($ret);
        return $ret;
    }
    

    public function scopeFilter($query, $filter=false)
    {
       
        if(!$filter) return;

        //filtro por la request
        //dd($filters);

        
        if($filter->role_id){
            $query->whereIn('id', User::searchByRole($filter->role_id,true));
        }

        if($filter->textfilter){
            $textfilter=$filter->textfilter;
            $query->where(function ($query) use ($textfilter) {
                $query->where('email', 'like','%'.$textfilter.'%')
                 ->orWhere('name', 'like','%'.$textfilter.'%')
                 ->orWhere('username', 'like','%'.$textfilter.'%');
            });

            
        }

    }

    

    public static function searchByRole($role_id,$onlyids=false) { 
        $ret= User::leftJoin('role_user', 'users.id', '=', 'role_user.user_id');
        if(is_array($role_id))
           $ret=$ret->whereIn('role_user.role_id', $role_id);
       else
           $ret=$ret->where('role_user.role_id', '=',$role_id);

        if($onlyids){
            $ret=$ret->pluck('id');
        }else{
            $ret=$ret->get();
        }

        return $ret;
    }



    public function teams(){
        if(!config('laratrust.use_teams')) return false;
    
        $teams = $this->morphToMany(
            \Config::get('laratrust.models.team'),
            'user',
            \Config::get('laratrust.tables.role_user'),
            \Config::get('laratrust.foreign_keys.user'),
            \Config::get('laratrust.foreign_keys.team')
        );
        return $teams;
    
    }
    

    public function userteams($formenu=false){
        if(!config('laratrust.use_teams')) return false;
    
        $teams=$this->teams->unique();
        if($teams && $formenu){
            $ret=[];
            $currentteam=currentteam();
            if($currentteam){
                foreach($teams as $team){
                    //dump($currentteam->id==$team->id);
                    $ret[]=[
                        'title' => (($currentteam->id==$team->id)?icon('check').' ':'') . $team->display_name ,
                        'url' => route('teams.teamset',[$team->id]),
                        'active' => ($currentteam->id==$team->id)

                    ];
                    
                }
            }
            return $ret;
        }
        return $teams;

    }
    public function currentteam(){
        if(!config('laratrust.use_teams')) return false;
    
        $teams=$this->teams;
        $ret=Team::current();
        //dd($ret);
        if(!$ret && $teams->count()>0) $ret=$teams->first();
        
        return $ret;

    }

}
