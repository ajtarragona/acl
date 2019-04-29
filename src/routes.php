<?php

Route::group(['prefix' => 'ajtarragona/acl','middleware' => ['web','auth','language']	], function () {

	//Authorizations Control Panel
	Route::get('/', 'Ajtarragona\ACL\Controllers\BaseController@dashboard')->name('acl.dashboard');
	
    Route::get('/users/modal/ldapform', 'Ajtarragona\ACL\Controllers\UsersController@ldapmodalform')->name('users.ldapmodalform');
    Route::post('/users/modal/ldapsearch', 'Ajtarragona\ACL\Controllers\UsersController@ldapmodalsearch')->name('users.ldapmodalsearch');
    Route::post('/users/modal/ldapaddusers', 'Ajtarragona\ACL\Controllers\UsersController@ldapaddusers')->name('users.ldapaddusers');
    Route::get('/users/modal/{user_id?}', 'Ajtarragona\ACL\Controllers\UsersController@usermodal')->name('users.usermodal');
    Route::post('/users/filter', 'Ajtarragona\ACL\Controllers\UsersController@filter')->name('users.filter');
   
    Route::resource('users', 'Ajtarragona\ACL\Controllers\UsersController');


    Route::get('/users/{user_id}/addrole', 'Ajtarragona\ACL\Controllers\UsersController@addrolemodal')->name('users.addrolemodal');
    Route::post('/users/{user_id}/addrole', 'Ajtarragona\ACL\Controllers\UsersController@addrole')->name('users.addrole');
    Route::delete('/users/{user_id}/removerole', 'Ajtarragona\ACL\Controllers\UsersController@removerole')->name('users.removerole');
    

    
    Route::get('/permissions/modal/{permission_id?}', 'Ajtarragona\ACL\Controllers\PermissionsController@permissionmodal')->name('permissions.permissionmodal');
    Route::resource('permissions', 'Ajtarragona\ACL\Controllers\PermissionsController');
    

    Route::get('/roles/modal/{role_id?}', 'Ajtarragona\ACL\Controllers\RolesController@rolemodal')->name('roles.rolemodal');
    Route::resource('roles', 'Ajtarragona\ACL\Controllers\RolesController');


    Route::get('/teams/modal/{team_id?}', 'Ajtarragona\ACL\Controllers\TeamsController@teammodal')->name('teams.teammodal');
    
    Route::resource('teams', 'Ajtarragona\ACL\Controllers\TeamsController');


    

});