# Tarragona ACL for Laravel

Aquest paquet incorpora una capa de Control d'Accés (Acces Control List) que permet definir, usuaris, rols, permisos i grups. 
Utilitza internament el paquet [Laratrust](https://laratrust.santigarcor.me/).

També s'inropora un backend d'administració d'aquesta capa ACL. Aquest backend depèn del paquet [ajtarragona/web-components](https://github.com/ajtarragona/web-components) per funcionar correctament.

## Instal·lació
```bash
composer require ajtarragona/acl
```

Si volem fer servir el backend a més hem de requerir el paquet web-components.
```bash
composer require ajtarragona/web-components
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

Si fem servir LDAP, també canviar el model a l'arxiu `config/ldap_auth.php`
```php
'model' => Ajtarragona\ACL\Models\User::class,
```

Publiquem la configuració de Laratrust.
```bash
php artisan vendor:publish --tag="laratrust"
```

A l'arxiu `config/laratrust.php` (si volem fer servir grups):
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

Se'ns crearà un usuari `acl` amb password `acl` amb els rols i permissos necessaris.


## Backend
Podem accedir al backend d'administració a través de la ruta `ajtarragona/acl`.
Caldrà que introduim un usuari vàlid que tingui el permís de gestió d'autoritzacions.

Es pot deshabilitar el backend configurant la variable `ACL_BACKEND` a l'arxiu `.env`.


## Ús
Mirar la documentació de [Laratrust](https://laratrust.santigarcor.me/) per a més informació.

A grans trets per comprovar si un usuari té un determinat rol o permís, ho podem fer a través d'un middleware a les rutes:
```php
Route::group(['middleware' => ['role:admin']], function() { 
    ... 
});
```

```php
Route::group(['middleware' => ['permission:edit-post']], function() { 
    ... 
});
```


O bé amb directives blade a les vistes:
```php
@role('admin')
    <p>This is visible to users with the admin role. Gets translated to
    \Laratrust::hasRole('admin')</p>
@endrole
```

```php
@permission('manage-admins')
    <p>This is visible to users with the given permissions. Gets translated to
    \Laratrust::can('manage-admins'). The @can directive is already taken by core
    laravel authorization package, hence the @permission directive instead.</p>
@endpermission
```
