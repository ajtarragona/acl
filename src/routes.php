<?php

Route::group(['prefix' => 'ajtarragona/acl','middleware' => ['web','auth','language']	], function () {

	//Authorizations Control Panel
	Route::get('/', 'Ajtarragona\ACL\Controllers\BaseController@dashboard')->name('acl.dashboard');
	
    Route::get('/users/modal/ldapform', 'Ajtarragona\ACL\Controllers\UsersController@ldapmodalform')->name('acl.users.ldapmodalform');
    Route::post('/users/modal/ldapsearch', 'Ajtarragona\ACL\Controllers\UsersController@ldapmodalsearch')->name('acl.users.ldapmodalsearch');
    Route::post('/users/modal/ldapaddusers', 'Ajtarragona\ACL\Controllers\UsersController@ldapaddusers')->name('acl.users.ldapaddusers');
    Route::get('/users/modal/{user_id?}', 'Ajtarragona\ACL\Controllers\UsersController@usermodal')->name('acl.users.usermodal');
    Route::post('/users/filter', 'Ajtarragona\ACL\Controllers\UsersController@filter')->name('acl.users.filter');
    Route::resource('acl.users', 'Ajtarragona\ACL\Controllers\UsersController');


    Route::get('/users/{user_id}/addrole', 'Ajtarragona\ACL\Controllers\UsersController@addrolemodal')->name('acl.users.addrolemodal');
    Route::post('/users/{user_id}/addrole', 'Ajtarragona\ACL\Controllers\UsersController@addrole')->name('acl.users.addrole');
    Route::delete('/users/{user_id}/removerole', 'Ajtarragona\ACL\Controllers\UsersController@removerole')->name('acl.users.removerole');
    

    
    Route::get('/permissions/modal/{permission_id?}', 'Ajtarragona\ACL\Controllers\PermissionsController@permissionmodal')->name('acl.permissions.permissionmodal');
    Route::resource('acl.permissions', 'Ajtarragona\ACL\Controllers\PermissionsController');
    

    Route::get('/roles/modal/{role_id?}', 'Ajtarragona\ACL\Controllers\RolesController@rolemodal')->name('acl.roles.rolemodal');
    Route::resource('acl.roles', 'Ajtarragona\ACL\Controllers\RolesController');


    Route::get('/teams/modal/{team_id?}', 'Ajtarragona\ACL\Controllers\TeamsController@teammodal')->name('acl.teams.teammodal');
    
    Route::resource('acl.teams', 'Ajtarragona\ACL\Controllers\TeamsController');


    

});