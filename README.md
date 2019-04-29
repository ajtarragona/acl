# Tarragona ACL Laravel 5.5




## acl

TODO
php artisan vendor:publish --tag="laratrust"

configure config/auth.php
'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Ajtarragona\ACL\Models\User::class,
        ],


configure config/laratrust.php
 'use_teams' => true,
 'user_models' => [
 	'users' => 'Ajtarragona\ACL\Models\User',
 ]

 'models' => [
        /**
         * Role model
         */
        'role' => 'Ajtarragona\ACL\Models\Role',

        /**
         * Permission model
         */
        'permission' => 'Ajtarragona\ACL\Models\Permission',

        /**
         * Team model
         */
        'team' => 'Ajtarragona\ACL\Models\Team',

    ],
php artisan laratrust:setup
php artisan migrate

