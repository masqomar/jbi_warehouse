<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],

    'list_permissions' => [
        [
            'group' => 'users',
            'lists' => [
                'view user',
                'create user',
                'edit user',
                'delete user',
            ]
        ],
        [
            'group' => 'roles & permissions',
            'lists' => [
                'view role & permission',
                'create role & permission',
                'edit role & permission',
                'delete role & permission',
            ]
        ],
        [
            'group' => 'test',
            'lists' => [
                'view test',
            ]
        ],
        ['group' => 'companies', 'lists' => ['view company', 'create company', 'edit company', 'delete company']],
        ['group' => 'categories', 'lists' => ['view category', 'create category', 'edit category', 'delete category']],
        ['group' => 'units', 'lists' => ['view unit', 'create unit', 'edit unit', 'delete unit']],
        ['group' => 'suppliers', 'lists' => ['view supplier', 'create supplier', 'edit supplier', 'delete supplier']],
        ['group' => 'products', 'lists' => ['view product', 'create product', 'edit product', 'delete product']],
        ['group' => 'comingproducts', 'lists' => ['view comingproduct', 'create comingproduct', 'edit comingproduct', 'delete comingproduct']],
        ['group' => 'outproducts', 'lists' => ['view outproduct', 'create outproduct', 'edit outproduct', 'delete outproduct']],
        ['group' => 'buildings', 'lists' => ['view building', 'create building', 'edit building', 'delete building']],
        ['group' => 'rooms', 'lists' => ['view room', 'create room', 'edit room', 'delete room']],
        ['group' => 'devisions', 'lists' => ['view devision', 'create devision', 'edit devision', 'delete devision']],
        ['group' => 'programs', 'lists' => ['view program', 'create program', 'edit program', 'delete program']],
        ['group' => 'members', 'lists' => ['view member', 'create member', 'edit member', 'delete member']],
        ['group' => 'assets', 'lists' => ['view asset', 'create asset', 'edit asset', 'delete asset']],
        ['group' => 'assetitems', 'lists' => ['view assetitem', 'create assetitem', 'edit assetitem', 'delete assetitem']],
        ['group' => 'placements', 'lists' => ['view placement', 'create placement', 'edit placement', 'delete placement']],
        ['group' => 'permissions', 'lists' => ['view permission', 'create permission', 'edit permission', 'delete permission']],
        ['group' => 'transactions', 'lists' => ['view transaction', 'create transaction', 'edit transaction', 'delete transaction']],
        ['group' => 'placementitems', 'lists' => ['view placementitem', 'create placementitem', 'edit placementitem', 'delete placementitem']], 
		['group' => 'mutations', 'lists' => ['view mutation', 'create mutation', 'edit mutation', 'delete mutation']], 
		['group' => 'mutationfroms', 'lists' => ['view mutationfrom', 'create mutationfrom', 'edit mutationfrom', 'delete mutationfrom']], 
		['group' => 'mutationtos', 'lists' => ['view mutationto', 'create mutationto', 'edit mutationto', 'delete mutationto']], 
		['group' => 'assetmaintenances', 'lists' => ['view assetmaintenance', 'create assetmaintenance', 'edit assetmaintenance', 'delete assetmaintenance']], 
		// Don't remove this comment, it will used as 'search param' to generate a new permission
    ],
];
