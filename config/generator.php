<?php

return [
    /**
     * Its used for route and sidebar menu name.
     */
    'name' => 'generators',

    /**
     * All avaibale column type for migration.
     */
    'column_types' => [
        'string',
        'integer',
        'text',
        'bigInteger',
        'boolean',
        'char',
        'date',
        'time',
        'year',
        'dateTime',
        'decimal',
        'double',
        'enum',
        'float',
        'foreignId',
        'tinyInteger',
        'tinyText',
        'longText'
    ],

    /**
     * If any input file(image) as default will used options below.
     */
    'image' => [
        /**
         * Path for image store into.
         *
         * avaiable options:
         * 1. public
         * 2. storage
         */
        'path' => 'storage',

        /**
         * Will used if image is nullable.
         */
        'default' => 'https://via.placeholder.com/350?text=No+Image+Avaiable',

        /**
         * Crop the uploaded image using intervention image.
         *
         * when set to false will ignore config below(aspect_ratio, width, and height).
         */
        'crop' => true,

        /**
         * When set to true the uploaded image aspect ratio will still original.
         */
        'aspect_ratio' => true,

        /**
         * Crop image size.
         */
        'width' => 500,
        'height' => 500,
    ],

    'format' => [
        /**
         * Will used to first year on select, if any column type year.
         */
        'first_year' => 1900,

        /**
         * If any date column type will cast and display used this format, but for input date still will used Y-m-d format.
         *
         * another most common format:
         * - M d Y
         * - d F Y
         * - Y m d
         */
        'date' => 'd/m/Y',

        /**
         * If any time column type will cast and display used this format.
         */
        'time' => 'H:i',

        /**
         * If any datetime column type or datetime-local on input format will cast and display used this format.
         */
        'datetime' => 'd/m/Y H:i',

        /**
         * Limit string on index view for any column type text or longtext.
         */
        'limit_text' => 200,
    ],

    /**
     * It will used for generator to manage and show menus on sidebar views.
     *
     * Example:
     * [
     *   'header' => 'Main',
     *
     *   // All permissions in menus[] and submenus[]
     *   'permissions' => ['view test'],
     *
     *   menus' => [
     *       [
     *          'title' => 'Main Data',
     *          'icon' => '<i class="bi bi-collection-fill"></i>',
     *          'route' => null,
     *
     *          // permission always null when isset submenus
     *          'permission' => null,
     *
     *          // All permissions on submenus[] and will empty[] when submenus equals to []
     *          'permissions' => ['view test'],
     *
     *          'submenus' => [
     *                 [
     *                     'title' => 'Tests',
     *                     'route' => '/tests',
     *                     'permission' => 'view test'
     *                  ]
     *               ],
     *           ],
     *       ],
     *  ],
     *
     * This code below always change when you using a generator and maybe you must to lint or format the code.
     */
    'sidebars' => [
    [
        'header' => 'Menu Cabang',
        'permissions' => [
            'view company',
            'view category',
            'view unit',
            'view inventory',
            'view supplier',
            'view comingproduct',
            'view building',
            'view room',
            'view devision',
            'view asset',
            'view assetitem',
            'view placement',
            'view placementitem',
            'view mutation',
            'view mutationfrom',
            'view mutationto',
            'view assetmaintenance',
            'view procurement'
        ],
        'menus' => [
            [
                'title' => 'Master Data',
                'icon' => '<i class="bi bi-collection-fill"></i>',
                'route' => null,
                'permission' => null,
                'permissions' => [
                    'view test',
                    'view company',
                    'view building',
                    'view room',
                    'view devision'
                ],
                'submenus' => [
                    [
                        'title' => 'Entitas',
                        'route' => '/companies',
                        'permission' => 'view company'
                    ],
                    [
                        'title' => 'Gedung / Camp',
                        'route' => '/buildings',
                        'permission' => 'view building'
                    ],
                    [
                        'title' => 'Ruang / Kamar',
                        'route' => '/rooms',
                        'permission' => 'view room'
                    ],
                    [
                        'title' => 'Devisi',
                        'route' => '/devisions',
                        'permission' => 'view devision'
                    ]
                ]
            ],
            [
                'title' => 'Master Barang',
                'icon' => '<i class="bi bi-people"></i>',
                'route' => null,
                'permission' => null,
                'permissions' => [
                    'view category',
                    'view unit',
                    'view supplier'
                ],
                'submenus' => [
                    [
                        'title' => 'Kategori',
                        'route' => '/categories',
                        'permission' => 'view category'
                    ],
                    [
                        'title' => 'Satuan',
                        'route' => '/units',
                        'permission' => 'view unit'
                    ],
                    [
                        'title' => 'Supplier',
                        'route' => '/suppliers',
                        'permission' => 'view supplier'
                    ]
                ]
            ],
            [
                'title' => 'Persediaan',
                'icon' => '<i class="bi bi-people"></i>',
                'route' => null,
                'permission' => null,
                'permissions' => [
                    'view product',
                    'view comingproduct',
                    'view outproduct'
                ],
                'submenus' => [
                    [
                        'title' => 'Barang Persediaan',
                        'route' => '/products',
                        'permission' => 'view product'
                    ],
                    [
                        'title' => 'Persediaan Masuk',
                        'route' => '/coming-products',
                        'permission' => 'view comingproduct'
                    ],
                    [
                        'title' => 'Persediaan Keluar',
                        'route' => '/transactions',
                        'permission' => 'view outproduct'
                    ]
                ]
            ],
            [
                'title' => 'Inventaris',
                'icon' => '<i class="bi bi-people"></i>',
                'route' => null,
                'permission' => null,
                'permissions' => [
                    'view asset',
                    'view placement',
                    'view mutation',
                    'view assetmaintenance',
                    'view procurement'
                ],
                'submenus' => [
                    [
                        'title' => 'Barang Inventaris',
                        'route' => '/assets',
                        'permission' => 'view asset'
                    ],
                    [
                        'title' => 'Penempatan',
                        'route' => '/placements',
                        'permission' => 'view placement'
                    ],
                    [
                        'title' => 'Mutasi',
                        'route' => '/mutations',
                        'permission' => 'view mutation'
                    ],
                    [
                        'title' => 'Perbaikan',
                        'route' => '/asset-maintenances',
                        'permission' => 'view assetmaintenance'
                    ],
                    [
                        'title' => 'Procurements',
                        'route' => '/procurements',
                        'permission' => 'view procurement'
                    ]
                ]
            ]
        ]
    ],
    [
        'header' => 'Check In',
        'permissions' => [
            'view program',
            'view member'
        ],
        'menus' => [
            [
                'title' => 'Program',
                'icon' => '<i class="bi bi-people-fill"></i>',
                'route' => '/programs',
                'permission' => 'view program',
                'permissions' => [],
                'submenus' => []
            ],
            [
                'title' => 'Check In',
                'icon' => '<i class="bi bi-people"></i>',
                'route' => '/members',
                'permission' => 'view member',
                'permissions' => [],
                'submenus' => []
            ]
        ]
    ],
    [
        'header' => 'Menu Pusat',
        'permissions' => [
            'view all-product',
            'view role & permission'
        ],
        'menus' => [
            [
                'title' => 'Laporan Persediaan',
                'icon' => '<i class="bi bi-people-fill"></i>',
                'route' => '/all-products',
                'permission' => 'view all-product',
                'permissions' => [],
                'submenus' => []
            ],
            [
                'title' => 'Laporan Inventaris',
                'icon' => '<i class="bi bi-person-check-fill"></i>',
                'route' => '/errors',
                'permission' => 'view role & permission',
                'permissions' => [],
                'submenus' => []
            ]
        ]
    ],
    [
        'header' => 'Users',
        'permissions' => [
            'view user',
            'view role & permission',
            'view permission'
        ],
        'menus' => [
            [
                'title' => 'Users',
                'icon' => '<i class="bi bi-people-fill"></i>',
                'route' => '/users',
                'permission' => 'view user',
                'permissions' => [],
                'submenus' => []
            ],
            [
                'title' => 'Roles & permissions',
                'icon' => '<i class="bi bi-person-check-fill"></i>',
                'route' => '/roles',
                'permission' => 'view role & permission',
                'permissions' => [],
                'submenus' => []
            ],
            [
                'title' => 'Permissions',
                'icon' => '<i class="bi bi-people"></i>',
                'route' => '/permissions',
                'permission' => 'view permission',
                'permissions' => [],
                'submenus' => []
            ]
        ]
    ]
]
];