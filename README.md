# Tarragona ACL for Laravel

Aquest paquet incorpora una capa de Control d'Accés (Acces Control List) que permet definir, usuaris, rols, permisos i grups. 
Utilitza internament el paquet [laratrust](https://laratrust.santigarcor.me/).


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
Pots modificar els rols, permisos i usuaris a l'arxiu config/acl_seed.php
php artisan vendor:publish --tag=ajtarragona-acl


Configurar LDAP

Add guard to config/auth.php
'guards' => [
    'ldaptgn' => [
        'driver' => 'session',
        'provider' => 'ldap',
    ],
]

Set configurable default guard:
'guard' => env('AUTH_GUARD','web'),


Add to providers:
'ldap' => [
        'driver' => 'adldap', 
        'model' => Ajtarragona\ACL\Models\User::class,
    ],      


publish adldap config
modificar 'discover' => 'userprincipalname' a 'discover' => 'samaccountname',
modificar 'eloquent' => 'email', por 'eloquent' => 'username',

modificar 'sync_attributes' => [

        'email' => 'mail',
        'username' => 'samaccountname',

        'name' => 'cn',

    ],
.env
AUTH_GUARD=ldaptgn
ADLDAP_CONTROLLERS=vmad.ajtarragona.es
ADLDAP_PORT=3268
ADLDAP_BASEDN=dc=ajtarragona,dc=es
ADLDAP_ADMIN_USERNAME=cn=ldap_php,cn=Users,dc=ajtarragona,dc=es
ADLDAP_ADMIN_PASSWORD=6060Bce
ADLDAP_USE_SSL=false
ADLDAP_USE_TLS=false
ADLDAP_LOGIN_FALLBACK = true