<?php 

if (! function_exists('permission')) {
	function permission($permission,$team=null,$all=false,$user=false){
		if(!$user) $user= \Auth::user();
	 	if($user) return $user->can($permission,$team,$all);
	 	else return false;
	}
}
if (! function_exists('can')) {
	function can($permission,$team=null,$all=false,$user=false){
		if(!$user) $user= \Auth::user();
		if($user) return $user->can($permission,$team,$all);
		else return false;
	}
}
if (! function_exists('role')) {
	function role($role,$team=null,$all=false,$user=false){
		if(!$user) $user= \Auth::user();
	 	if($user) return $user->hasRole($role,$team,$all);
	 	else return false;
	}
}

