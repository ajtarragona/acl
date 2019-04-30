# Tarragona ACL for Laravel




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


Executar comanda:
php artisan ajtarragona:acl-setup
Això prepara les taules de laratrust
executa la migració
i crea els rols, permisos i usuaris per defecte



Configurar LDAP
