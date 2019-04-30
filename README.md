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

A l'arxiu `config/auth.php`:
1. Afegir el guard `ldaptgn`
```php
'guards' => [
    ...
    'ldaptgn' => [
        'driver' => 'session',
        'provider' => 'ldap',
    ],
]
```

2. Fem que el default guard pugui configurar-se des de l'arxiu `.env`:
```php
'defaults' => [
    'guard' => env('AUTH_GUARD','web'), //aquesta línea
    ...
],
```
3. Afegim el provider `ldap`:
```php
'providers' => [
    ...
    'ldap' => [
        'driver' => 'adldap', 
        'model' => Ajtarragona\ACL\Models\User::class,
    ],      
]
```

Publiquem la configuració del paquet adldap:
```bash
php artisan vendor:publish --provider=Adldap\Laravel\AdldapAuthServiceProvider
```

A l'arxiu `config/adldap_auth.php`:
Modificar els següents atributs:
```php
'usernames' => [
    'ldap' => [
        'discover' => 'samaccountname',
    ],
    'eloquent' => 'username',
    ...
    'sync_attributes' => [
        'email' => 'mail',
        'username' => 'samaccountname',
        'name' => 'cn',
    ]
    ...
]
```

Congiurar les següents variables a l'arxiu `.env`
```php
AUTH_GUARD=ldaptgn
ADLDAP_LOGIN_FALLBACK = true
ADLDAP_CONTROLLERS = ?
ADLDAP_PORT = ?
ADLDAP_BASEDN = ?
ADLDAP_ADMIN_USERNAME = ?
ADLDAP_ADMIN_PASSWORD = ?
ADLDAP_USE_SSL = ?
ADLDAP_USE_TLS = ?
```