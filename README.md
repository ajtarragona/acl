# Tarragona ACL for Laravel

Aquest paquet incorpora una capa de Control d'Accés (Acces Control List) que permet definir, usuaris, rols, permisos i grups. 
Utilitza internament el paquet [laratrust](https://laratrust.santigarcor.me/).

També s'inropora un backend d'administració d'aquesta capa ACL. Aquest backend depèn del paquet [ajtarragona/web-components](https://github.com/ajtarragona/web-components) per funcionar correctament.

## Instal·lació
```bash
composer require ajtarragona/acl
```


## Configuració Inicial

A l'arxiu `config/auth.php` definim la classe del package al user provider:
```php
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Ajtarragona\ACL\Models\User::class,
        ],
    ]
```

Publiquem la configuració de Laratrust.
```bash
php artisan vendor:publish --tag="laratrust"
```

A l'arxiu `config/laratrust.php`:
1. posem l'atribut `use_teams` a `true`:
```php
 ...
 'use_teams' => true,
 ...
```

2. Definim els models:
 ```php
 'user_models' => [
 	'users' => 'Ajtarragona\ACL\Models\User',
 ],
 ...
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
```

3. Finalment, executem la següent comanda:
```bash
php artisan ajtarragona:acl-setup
```

Això prepararà les taules de la base de dades, si no existeixen, executarà la migració i crearà els permisos, rols i usuaris per defecte.

> Es poden modificar els rols, permisos i usuaris per defecte a l'arxiu `config/acl_seed.php`, publicant prèviament la configuració del paquet:
```bash
php artisan vendor:publish --tag=ajtarragona-acl
```

## Configurar LDAP

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