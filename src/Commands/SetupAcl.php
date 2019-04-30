<?php

namespace Ajtarragona\ACL\Commands;

use Illuminate\Console\Command;


use Ajtarragona\ACL\Models\User;
use Ajtarragona\ACL\Models\Role;
use Ajtarragona\ACL\Models\Permission;
use \Exception;


class SetupAcl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ajtarragona:acl-setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize ACL roles and permissions';

    protected $roleName = 'auth-manager';

    protected $users;
    protected $roles;
    protected $permissions;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        
        

        $this->call('laratrust:setup');
       
        // $this->line("Generating DB ...");
        $this->line('');
        
        $this->line("Running migration ...");
        $this->call('migrate');
       
       

        $this->permissions=$this->createPermissions();

        $this->roles=$this->createRoles();

        $this->users=$this->createUsers();
        
       // Artisan::call('vendor:publish',['--tag'=>'ajtarragona-web-components-assets','--force'=>true]);
        

        
        
        
    }

    protected function createUsers(){
    	$users=[];
    	$this->line('');
        $this->line("Generating users ...");
       	
       	$usersseed=config('acl_seed.users');

        //create users
        foreach($usersseed as $u){
            if(User::where('username',$u['username'])->count()>0){
        		$this->warn("User '".$u['username']."' already exists.");
        	}else{
	        	$rolenames= $u["roles"];
				unset($u["roles"]);
				$u["password"]=bcrypt($u["password"]);
				$user=User::create($u);

				foreach($rolenames as $role_name){
					//if(strpos($role_name, ":")===false){
					    if(isset($this->roles[$role_name]) ) {
					        $user->attachRole($this->roles[$role_name]);
					    }
					/*}else{
					    $tmp=explode(":", $role_name);
					    if(isset($this->roles[$tmp[0]]) && isset($this->teams[$tmp[1]])) {
					        $user->attachRole($this->roles[$tmp[0]], $teams[$tmp[1]]);
					    }
					}*/
				}
				$this->info("User '".$u['username']."' created.");
	            
				$users[$user->username]=$user;
			}
        }
        return $users;
    }

    protected function createRoles(){
    	$roles=[];
        	
		$this->line('');
        $this->line("Generating roles ...");
        	
        $rolesseed=config('acl_seed.roles');
       	
       	//create roles
        foreach($rolesseed as $role){
           
            if(Role::where('name',$role['name'])->count()>0){
        		$this->warn("Role '".$role['name']."' already exists.");
        	}else{
            	$permissionnames= $role["permissions"];
            	unset($role["permissions"]);
            	$objrole = Role::create($role);
            	$this->info("Role '".$role['name']."' created.");
	            foreach($permissionnames as $permission_name){
	                if(isset($this->permissions[$permission_name]) ) {
	                    $objrole->attachPermission($this->permissions[$permission_name]);
	                }
	            }
	            $roles[$role['name']]=$objrole;
            }
        } 

        return $roles;
       
    }

    protected function createPermissions(){
    	$permissions=[];
       
        $this->line('');
        $this->line("Generating permissions ...");
        
        $permissionsseed=config('acl_seed.permissions');
       
        //create permissions
        foreach($permissionsseed as $permission){
        	if(Permission::where('name',$permission['name'])->count()>0){
        		$this->warn("Permission '".$permission['name']."' already exists.");
        	}else{
            	$permissions[$permission['name']] = Permission::create($permission);
            	$this->info("Permission '".$permission['name']."' created.");
            }
        }
        return $permissions;
    }



}
