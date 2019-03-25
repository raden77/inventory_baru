<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Front Sistem',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Inventory&nbsp</b><b>System</b>',

    'logo_mini' => '<b>IV</b><b>S</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'purple-light',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',

        // [
        //     'text' => 'Permintaan',
        //     'url'  => 'admin/permintaan',
        //     'icon' => 'pencil-square-o',
        //     // 'can'  => 'manage-blog',
        // ],

        // [
        //     'text' => 'Memo',
        //     'url'  => 'admin/memo',
        //     'icon' => 'check-square-o',
        //     // 'can'  => 'manage-blog',
        // ],

        [
            'text' => 'Pemakaian',
            'url'  => 'admin/pemakaian',
            'icon' => 'arrow-circle-up',
            'permission'  => 'create-users',
        ],

        [
            'text' => 'Pembelian',
            'url'  => 'admin/pembelian',
            'icon' => 'cart-arrow-down',
            // 'can'  => 'manage-blog',
        ],

        [
            'text' => 'Penerimaan',
            'url'  => 'admin/penerimaan',
            'icon' => 'arrow-circle-down',
            // 'can'  => 'manage-blog',
        ],

        [
            'text' => 'Adjusment/Penyesuaian',
            'url'  => 'admin/adjustment',
            'icon' => 'arrow-circle-down',
            // 'can'  => 'manage-blog',
        ],

        [
            'text' => 'Master Data',
            'icon' => 'server',
            'submenu' => [

                [
                    'text' => 'Produk',
                    'url'  => 'admin/produk',
                    'icon' => 'briefcase',
                    'permission'  => 'read-produk',
                ],
              
                [
                    'text' => 'Vendor',
                    'url'  => 'admin/vendor',
                    'icon' => 'truck',
                    // 'can'  => 'manage-blog',
                ],

                [
                    'text' => 'Company',
                    'url'  => 'admin/company',
                    'icon' => 'group',
                    // 'can'  => 'manage-blog',
                ],

                [
                    'text' => 'Kategori Produk',
                    'url'  => 'admin/kategoriproduk',
                    'icon' => 'tasks',
                    // 'can'  => 'manage-blog',
                ],

                [
                    'text'        => 'Merek',
                    'url'         => 'admin/merek',
                    'icon'        => 'building',
                    // 'label'       => 4,
                    // 'label_color' => 'success',
                ],

                [
                    'text' => 'Ukuran',
                    'url'  => 'admin/ukuran',
                    'icon' => 'cogs',
                    // 'can'  => 'manage-blog',
                ],

                [
                    'text' => 'Satuan',
                    'url'  => 'admin/satuan',
                    'icon' => 'wrench',
                    // 'can'  => 'manage-blog',
                ],

                [
                    'text' => 'Lokasi',
                    'url'  => 'admin/masterlokasi',
                    'icon' => 'map-marker',
                    // 'can'  => 'manage-blog',
                ],
            ]
        ],
        [
            'text' => 'Laporan',
            'icon' => 'folder-open',
            'submenu' => [

                [
                    'text'        => 'Laporan',
                    'url'         => 'admin/stock/index',
                    'icon'        => 'bar-chart',
                    // 'label'       => 4,
                    // 'label_color' => 'success',
                ]
            ]
        ],

        // [
        //     'text'        => 'Vendor',
        //     'url'         => 'admin/hasil-tambak',
        //     'icon'        => 'user-circle',
        //     // 'label'       => 4,
        //     // 'label_color' => 'success',
        // ],
        

        'ACCOUNT SETTINGS',
        [
            'text' => 'Users',
            'url'  => 'admin/users',
            'icon' => 'user',
            'permission' => 'read-users'

        ],
        [
            'text' => 'Roles & Permissions',
            'icon' => 'gear',
            'submenu' => [
                [
                    'text'  => 'Roles',
                    'route'   => 'roles.index'
                ],
                [
                    'text'  => 'Permissions',
                    'route'   => 'permissions.index'
                ]
            ]

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        // JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        App\Menu\MenuFilter::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => false,
        'chartjs'    => false,
    ],
];
