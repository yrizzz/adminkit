<?php

/*
|--------------------------------------------------------------------------
| Laravel Admin Kit — App config & navigation tree
|--------------------------------------------------------------------------
| The sidebar / horizontal menu is rendered recursively from `menu`.
|
| Item keys:
|   label     string   visible text
|   icon      string   lucide icon name (top-level items only)
|   route     string   named route -> resolved with route()
|   href      string   explicit url (wins over route)
|   badge     array    ['text' => '12', 'variant' => 'neutral|primary|success|warning|hot']
|   children  array    nested items (unlimited depth)
| A group is: ['group' => 'MAIN', 'items' => [ ... ]]
*/

return [
    'name'        => 'AdminKit',
    'tagline'     => 'Laravel Admin Kit',
    'version'     => '1.0.0',

    'menu' => [
        // ── MAIN ────────────────────────────────────────────────
        [
            'group' => 'Main',
            'items' => [
                [
                    'label' => 'Dashboards',
                    'icon'  => 'monitor',
                    'badge' => ['text' => '13', 'variant' => 'neutral'],
                    'route' => 'dashboard',
                    'children' => [
                        ['label' => 'Sales',     'route' => 'dashboard.show', 'params' => 'sales'],
                        ['label' => 'Crypto',    'route' => 'dashboard.show', 'params' => 'crypto'],
                        ['label' => 'Jobs',      'route' => 'dashboard.show', 'params' => 'jobs'],
                        ['label' => 'CRM',       'route' => 'dashboard.show', 'params' => 'crm'],
                        ['label' => 'Ecommerce', 'route' => 'dashboard.show', 'params' => 'ecommerce'],
                        ['label' => 'Analytics', 'route' => 'dashboard.show', 'params' => 'analytics'],
                        ['label' => 'Projects',  'route' => 'dashboard.show', 'params' => 'projects'],
                        ['label' => 'NFT',       'route' => 'dashboard.show', 'params' => 'nft'],
                        ['label' => 'HRM',       'route' => 'dashboard.show', 'params' => 'hrm'],
                        ['label' => 'Personal',  'route' => 'dashboard.show', 'params' => 'personal'],
                        ['label' => 'Stocks',    'route' => 'dashboard.show', 'params' => 'stocks'],
                        ['label' => 'Course',    'route' => 'dashboard.show', 'params' => 'course'],
                        ['label' => 'Timeline',  'route' => 'dashboard.show', 'params' => 'timeline'],
                    ],
                ],
            ],
        ],

        // ── GENERAL ─────────────────────────────────────────────
        [
            'group' => 'General',
            'items' => [
                [
                    'label' => 'Advanced Ui',
                    'icon'  => 'box',
                    'children' => [
                        ['label' => 'Accordions & Collapse', 'href' => '#'],
                        ['label' => 'Carousel',              'href' => '#'],
                        ['label' => 'Draggable Cards',       'href' => '#'],
                        ['label' => 'Modals & Closes',       'href' => '#'],
                        ['label' => 'Navbar',                'href' => '#'],
                        ['label' => 'Offcanvas',             'href' => '#'],
                        ['label' => 'Placeholders',          'href' => '#'],
                        ['label' => 'Ratings',               'href' => '#'],
                        ['label' => 'Scrollspy',             'href' => '#'],
                        ['label' => 'Swiper JS',             'href' => '#'],
                    ],
                ],
            ],
        ],

        // ── PAGES ───────────────────────────────────────────────
        [
            'group' => 'Pages',
            'items' => [
                [
                    'label' => 'Pages',
                    'icon'  => 'file-text',
                    'children' => [
                        ['label' => 'Blog',     'href' => '#'],
                        ['label' => 'Chat',     'href' => '#'],
                        ['label' => 'Contacts', 'href' => '#'],
                        ['label' => 'Ecommerce', 'children' => [
                            ['label' => 'Products',      'href' => '#'],
                            ['label' => 'Product Detail','href' => '#'],
                            ['label' => 'Add Product',   'href' => '#'],
                            ['label' => 'Cart',          'href' => '#'],
                            ['label' => 'Checkout',      'href' => '#'],
                            ['label' => 'Orders',        'href' => '#'],
                        ]],
                        ['label' => 'Email', 'children' => [
                            ['label' => 'Inbox',   'href' => '#'],
                            ['label' => 'Read',    'href' => '#'],
                            ['label' => 'Compose', 'href' => '#'],
                        ]],
                        ['label' => 'Empty',  'href' => '#'],
                        ['label' => "FAQ's",  'href' => '#'],
                        ['label' => 'File Manager', 'children' => [
                            ['label' => 'Files',   'href' => '#'],
                            ['label' => 'Folders', 'href' => '#'],
                        ]],
                        ['label' => 'Invoice', 'children' => [
                            ['label' => 'List',   'href' => '#'],
                            ['label' => 'Detail', 'href' => '#'],
                            ['label' => 'Create', 'href' => '#'],
                        ]],
                        ['label' => 'Timeline', 'children' => [
                            ['label' => 'Default',   'href' => '#'],
                            ['label' => 'Vertical',  'href' => '#'],
                        ]],
                        ['label' => 'Landing',             'href' => '#'],
                        ['label' => 'Notifications',       'href' => '#'],
                        ['label' => 'Pricing',             'href' => '#'],
                        ['label' => 'Profile',             'route' => 'settings'],
                        ['label' => 'Reviews',             'href' => '#'],
                        ['label' => 'Team',                'href' => '#'],
                        ['label' => 'Terms & Conditions',  'href' => '#'],
                        ['label' => 'To Do List',          'href' => '#'],
                    ],
                ],
                [
                    'label' => 'Utilities',
                    'icon'  => 'wallet',
                    'children' => [
                        ['label' => 'Avatars',            'href' => '#'],
                        ['label' => 'Borders',            'href' => '#'],
                        ['label' => 'Breakpoints',        'href' => '#'],
                        ['label' => 'Colors',             'href' => '#'],
                        ['label' => 'Columns',            'href' => '#'],
                        ['label' => 'Flex',               'href' => '#'],
                        ['label' => 'Gutters',            'href' => '#'],
                        ['label' => 'Helpers',            'href' => '#'],
                        ['label' => 'Position',           'href' => '#'],
                        ['label' => 'Additional Content', 'href' => '#'],
                    ],
                ],
                [
                    'label' => 'Authentication',
                    'icon'  => 'lock',
                    'children' => [
                        ['label' => 'Coming Soon',           'href' => '#'],
                        ['label' => 'Create Password',       'href' => '#'],
                        ['label' => 'Lock Screen',           'href' => '#'],
                        ['label' => 'Reset Password',        'href' => '#'],
                        ['label' => 'Sign Up',               'href' => '#'],
                        ['label' => 'Sign In',               'href' => '#'],
                        ['label' => 'Two Step Verification', 'href' => '#'],
                        ['label' => 'Under Maintenance',     'href' => '#'],
                        ['label' => 'no-internet',           'href' => '#'],
                    ],
                ],
                [
                    'label' => 'Error',
                    'icon'  => 'circle-alert',
                    'children' => [
                        ['label' => 'Error 400', 'href' => '#'],
                        ['label' => 'Error 401', 'href' => '#'],
                        ['label' => 'Error 403', 'href' => '#'],
                        ['label' => 'Error 404', 'href' => '#'],
                        ['label' => 'Error 500', 'href' => '#'],
                        ['label' => 'Error 503', 'href' => '#'],
                    ],
                ],
                [
                    'label' => 'Apps',
                    'icon'  => 'layout-grid',
                    'children' => [
                        ['label' => 'Calendar',  'href' => '#'],
                        ['label' => 'Kanban',    'href' => '#'],
                        ['label' => 'Chat',      'href' => '#'],
                        ['label' => 'Contacts',  'href' => '#'],
                        ['label' => 'File Manager', 'href' => '#'],
                    ],
                ],
                [
                    'label' => 'Icons',
                    'icon'  => 'smile',
                    'route' => 'ui.icons',
                ],
                [
                    'label' => 'Widgets',
                    'icon'  => 'component',
                    'badge' => ['text' => 'Hot', 'variant' => 'hot'],
                    'route' => 'widgets',
                ],
            ],
        ],

        // ── WEB APPS ────────────────────────────────────────────
        [
            'group' => 'Web Apps',
            'items' => [
                [
                    'label' => 'Ui Elements',
                    'icon'  => 'underline',
                    'route' => 'ui.elements',
                    'children' => [
                        ['label' => 'Alerts',          'route' => 'ui.elements', 'hash' => 'alerts'],
                        ['label' => 'Badge',           'route' => 'ui.elements', 'hash' => 'badges'],
                        ['label' => 'Breadcrumb',      'route' => 'ui.elements', 'hash' => 'breadcrumb'],
                        ['label' => 'Buttons',         'route' => 'ui.elements', 'hash' => 'buttons'],
                        ['label' => 'Button Group',    'route' => 'ui.elements', 'hash' => 'button-group'],
                        ['label' => 'Cards',           'route' => 'ui.elements', 'hash' => 'cards'],
                        ['label' => 'Dropdowns',       'route' => 'ui.elements', 'hash' => 'dropdowns'],
                        ['label' => 'Images & Figures','route' => 'ui.elements', 'hash' => 'images'],
                        ['label' => 'List Group',      'route' => 'ui.elements', 'hash' => 'list-group'],
                        ['label' => 'Navs & Tabs',     'route' => 'ui.elements', 'hash' => 'navs-tabs'],
                        ['label' => 'Object Fit',      'route' => 'ui.elements', 'hash' => 'object-fit'],
                        ['label' => 'Pagination',      'route' => 'ui.elements', 'hash' => 'pagination'],
                        ['label' => 'Popovers',        'route' => 'ui.elements', 'hash' => 'popovers'],
                        ['label' => 'Progress',        'route' => 'ui.elements', 'hash' => 'progress'],
                        ['label' => 'Spinners',        'route' => 'ui.elements', 'hash' => 'spinners'],
                        ['label' => 'Toasts',          'route' => 'ui.elements', 'hash' => 'toasts'],
                        ['label' => 'Tooltips',        'route' => 'ui.elements', 'hash' => 'tooltips'],
                        ['label' => 'Typography',      'route' => 'ui.elements', 'hash' => 'typography'],
                    ],
                ],
                [
                    'label' => 'Nested Menu',
                    'icon'  => 'menu',
                    'children' => [
                        ['label' => 'Level 1.1', 'href' => '#'],
                        ['label' => 'Level 1.2', 'children' => [
                            ['label' => 'Level 2.1', 'href' => '#'],
                            ['label' => 'Level 2.2', 'children' => [
                                ['label' => 'Level 3.1', 'href' => '#'],
                                ['label' => 'Level 3.2', 'href' => '#'],
                            ]],
                        ]],
                    ],
                ],
            ],
        ],

        // ── MAPS & CHARTS ───────────────────────────────────────
        [
            'group' => 'Maps & Charts',
            'items' => [
                [
                    'label' => 'Maps',
                    'icon'  => 'map-pin',
                    'children' => [
                        ['label' => 'Google Maps', 'href' => '#'],
                        ['label' => 'Vector Maps', 'href' => '#'],
                    ],
                ],
                [
                    'label' => 'Charts',
                    'icon'  => 'bar-chart-3',
                    'route' => 'charts',
                    'children' => [
                        ['label' => 'Line',    'route' => 'charts', 'hash' => 'line'],
                        ['label' => 'Area',    'route' => 'charts', 'hash' => 'area'],
                        ['label' => 'Bar',     'route' => 'charts', 'hash' => 'bar'],
                        ['label' => 'Pie',     'route' => 'charts', 'hash' => 'pie'],
                        ['label' => 'Radar',   'route' => 'charts', 'hash' => 'radar'],
                    ],
                ],
            ],
        ],

        // ── FORMS & TABLES ──────────────────────────────────────
        [
            'group' => 'Forms & Tables',
            'items' => [
                [
                    'label' => 'Forms',
                    'icon'  => 'clipboard-list',
                    'route' => 'forms',
                    'children' => [
                        ['label' => 'Elements',   'route' => 'forms', 'hash' => 'elements'],
                        ['label' => 'Layouts',    'route' => 'forms', 'hash' => 'layouts'],
                        ['label' => 'Validation', 'route' => 'forms', 'hash' => 'validation'],
                        ['label' => 'Wizard',     'route' => 'forms', 'hash' => 'wizard'],
                    ],
                ],
                [
                    'label' => 'Tables',
                    'icon'  => 'table',
                    'badge' => ['text' => '3', 'variant' => 'success'],
                    'route' => 'tables',
                    'children' => [
                        ['label' => 'Basic Tables', 'route' => 'tables', 'hash' => 'basic'],
                        ['label' => 'Data Table',   'route' => 'tables', 'hash' => 'data-table'],
                        ['label' => 'Editable',     'route' => 'tables', 'hash' => 'editable'],
                    ],
                ],
            ],
        ],
    ],
];
