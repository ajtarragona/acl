<?php


return [
 	'permissions' => [
 		[
            'name' => 'manage-authorizations',
            'display_name' => 'Manage authorizations',
        ]
    ],
    'roles' => [
        [
            'name' => 'authorizations-manager',
            'display_name' => 'Authorizations manager',
            'permissions'=>['manage-authorizations']
        ]
    ],
    'users' => [
        [   
            "name" => "Authorization manager",
            "username" => "acl",
            "email" => "acl@tarragona.cat",
            "password" => "acl", //bcrypt("acl"),
            "roles" =>["authorizations-manager"]
        ]
    ]	
];

