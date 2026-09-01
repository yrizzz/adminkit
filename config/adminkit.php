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
    'version'     => '1.2.0',

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
                [
                    'label' => 'Documentation',
                    'icon'  => 'book-open',
                    'route' => 'page',
                    'params' => ['path' => 'docs'],
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
                        ['label' => 'Accordions & Collapse', 'route' => 'page', 'params' => ['path' => 'accordions-collapse']],
                        ['label' => 'Carousel',              'route' => 'page', 'params' => ['path' => 'carousel']],
                        ['label' => 'Draggable Cards',       'route' => 'page', 'params' => ['path' => 'draggable-cards']],
                        ['label' => 'Modals & Closes',       'route' => 'page', 'params' => ['path' => 'modals-closes']],
                        ['label' => 'Navbar',                'route' => 'page', 'params' => ['path' => 'navbar']],
                        ['label' => 'Offcanvas',             'route' => 'page', 'params' => ['path' => 'offcanvas']],
                        ['label' => 'Placeholders',          'route' => 'page', 'params' => ['path' => 'placeholders']],
                        ['label' => 'Ratings',               'route' => 'page', 'params' => ['path' => 'ratings']],
                        ['label' => 'Scrollspy',             'route' => 'page', 'params' => ['path' => 'scrollspy']],
                        ['label' => 'Swiper JS',             'route' => 'page', 'params' => ['path' => 'swiper-js']],
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
                        ['label' => 'Blog',     'route' => 'page', 'params' => ['path' => 'blog']],
                        ['label' => 'Chat',     'route' => 'page', 'params' => ['path' => 'chat']],
                        ['label' => 'Contacts', 'route' => 'page', 'params' => ['path' => 'contacts']],
                        ['label' => 'Ecommerce', 'children' => [
                            ['label' => 'Products',      'route' => 'page', 'params' => ['path' => 'products']],
                            ['label' => 'Product Detail','route' => 'page', 'params' => ['path' => 'product-detail']],
                            ['label' => 'Add Product',   'route' => 'page', 'params' => ['path' => 'add-product']],
                            ['label' => 'Cart',          'route' => 'page', 'params' => ['path' => 'cart']],
                            ['label' => 'Checkout',      'route' => 'page', 'params' => ['path' => 'checkout']],
                            ['label' => 'Orders',        'route' => 'page', 'params' => ['path' => 'orders']],
                        ]],
                        ['label' => 'Email', 'children' => [
                            ['label' => 'Inbox',   'route' => 'page', 'params' => ['path' => 'inbox']],
                            ['label' => 'Read',    'route' => 'page', 'params' => ['path' => 'read']],
                            ['label' => 'Compose', 'route' => 'page', 'params' => ['path' => 'compose']],
                        ]],
                        ['label' => 'Empty',  'route' => 'page', 'params' => ['path' => 'empty']],
                        ['label' => "FAQ's",  'route' => 'page', 'params' => ['path' => 'faqs']],
                        ['label' => 'File Manager', 'children' => [
                            ['label' => 'Files',   'route' => 'page', 'params' => ['path' => 'files']],
                            ['label' => 'Folders', 'route' => 'page', 'params' => ['path' => 'folders']],
                        ]],
                        ['label' => 'Invoice', 'children' => [
                            ['label' => 'List',   'route' => 'page', 'params' => ['path' => 'list']],
                            ['label' => 'Detail', 'route' => 'page', 'params' => ['path' => 'detail']],
                            ['label' => 'Create', 'route' => 'page', 'params' => ['path' => 'create']],
                        ]],
                        ['label' => 'Timeline', 'children' => [
                            ['label' => 'Default',   'route' => 'page', 'params' => ['path' => 'default']],
                            ['label' => 'Vertical',  'route' => 'page', 'params' => ['path' => 'vertical']],
                        ]],
                        ['label' => 'Landing',             'route' => 'page', 'params' => ['path' => 'landing']],
                        ['label' => 'Notifications',       'route' => 'page', 'params' => ['path' => 'notifications']],
                        ['label' => 'Pricing',             'route' => 'page', 'params' => ['path' => 'pricing']],
                        ['label' => 'Profile',             'route' => 'settings'],
                        ['label' => 'Reviews',             'route' => 'page', 'params' => ['path' => 'reviews']],
                        ['label' => 'Team',                'route' => 'page', 'params' => ['path' => 'team']],
                        ['label' => 'Terms & Conditions',  'route' => 'page', 'params' => ['path' => 'terms-conditions']],
                        ['label' => 'To Do List',          'route' => 'page', 'params' => ['path' => 'to-do-list']],
                    ],
                ],
                [
                    'label' => 'Utilities',
                    'icon'  => 'wallet',
                    'children' => [
                        ['label' => 'Avatars',            'route' => 'page', 'params' => ['path' => 'avatars']],
                        ['label' => 'Borders',            'route' => 'page', 'params' => ['path' => 'borders']],
                        ['label' => 'Breakpoints',        'route' => 'page', 'params' => ['path' => 'breakpoints']],
                        ['label' => 'Colors',             'route' => 'page', 'params' => ['path' => 'colors']],
                        ['label' => 'Columns',            'route' => 'page', 'params' => ['path' => 'columns']],
                        ['label' => 'Flex',               'route' => 'page', 'params' => ['path' => 'flex']],
                        ['label' => 'Gutters',            'route' => 'page', 'params' => ['path' => 'gutters']],
                        ['label' => 'Helpers',            'route' => 'page', 'params' => ['path' => 'helpers']],
                        ['label' => 'Position',           'route' => 'page', 'params' => ['path' => 'position']],
                        ['label' => 'Additional Content', 'route' => 'page', 'params' => ['path' => 'additional-content']],
                    ],
                ],
                [
                    'label' => 'Authentication',
                    'icon'  => 'lock',
                    'children' => [
                        ['label' => 'Sign In (Split)',          'route' => 'login'],
                        ['label' => 'Sign In 2 (Centered)',     'route' => 'page', 'params' => ['path' => 'sign-in-2']],
                        ['label' => 'Sign Up (Split)',          'route' => 'register'],
                        ['label' => 'Sign Up 2 (Centered)',     'route' => 'page', 'params' => ['path' => 'sign-up-2']],
                        ['label' => 'Lock Screen',              'route' => 'page', 'params' => ['path' => 'lock-screen']],
                        ['label' => 'Lock Screen 2 (Centered)', 'route' => 'page', 'params' => ['path' => 'lock-screen-2']],
                        ['label' => 'Reset Password',           'route' => 'forgot-password'],
                        ['label' => 'Reset Password 2 (Centered)', 'route' => 'page', 'params' => ['path' => 'reset-password-2']],
                        ['label' => 'Create Password',          'route' => 'page', 'params' => ['path' => 'create-password']],
                        ['label' => 'Two Step Verification',    'route' => 'page', 'params' => ['path' => 'two-step-verification']],
                        ['label' => 'Coming Soon',              'route' => 'page', 'params' => ['path' => 'coming-soon']],
                        ['label' => 'Under Maintenance',        'route' => 'page', 'params' => ['path' => 'under-maintenance']],
                        ['label' => 'No Internet',              'route' => 'page', 'params' => ['path' => 'no-internet']],
                    ],
                ],

                [
                    'label' => 'Error',
                    'icon'  => 'circle-alert',
                    'children' => [
                        ['label' => 'Error 400', 'route' => 'page', 'params' => ['path' => 'error-400']],
                        ['label' => 'Error 401', 'route' => 'page', 'params' => ['path' => 'error-401']],
                        ['label' => 'Error 403', 'route' => 'page', 'params' => ['path' => 'error-403']],
                        ['label' => 'Error 404', 'route' => 'page', 'params' => ['path' => 'error-404']],
                        ['label' => 'Error 500', 'route' => 'page', 'params' => ['path' => 'error-500']],
                        ['label' => 'Error 503', 'route' => 'page', 'params' => ['path' => 'error-503']],
                    ],
                ],

                [
                    'label' => 'Apps',
                    'icon'  => 'layout-grid',
                    'children' => [
                        ['label' => 'Calendar',  'route' => 'page', 'params' => ['path' => 'to-do-list']],
                        ['label' => 'Kanban',    'route' => 'apps.kanban'],
                        ['label' => 'Chat',      'route' => 'page', 'params' => ['path' => 'chat']],
                        ['label' => 'Contacts',  'route' => 'page', 'params' => ['path' => 'contacts']],
                        ['label' => 'File Manager', 'route' => 'page', 'params' => ['path' => 'files']],
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
                        ['label' => 'Alerts',          'route' => 'page', 'params' => ['path' => 'alerts']],
                        ['label' => 'Badge',           'route' => 'page', 'params' => ['path' => 'badge']],
                        ['label' => 'Breadcrumb',      'route' => 'page', 'params' => ['path' => 'breadcrumb']],
                        ['label' => 'Buttons',         'route' => 'page', 'params' => ['path' => 'buttons']],
                        ['label' => 'Button Group',    'route' => 'page', 'params' => ['path' => 'button-group']],
                        ['label' => 'Cards',           'route' => 'page', 'params' => ['path' => 'cards']],
                        ['label' => 'Dropdowns',       'route' => 'page', 'params' => ['path' => 'dropdowns']],
                        ['label' => 'Images & Figures','route' => 'page', 'params' => ['path' => 'images-figures']],
                        ['label' => 'List Group',      'route' => 'page', 'params' => ['path' => 'list-group']],
                        ['label' => 'Navs & Tabs',     'route' => 'page', 'params' => ['path' => 'navs-tabs']],
                        ['label' => 'Object Fit',      'route' => 'page', 'params' => ['path' => 'object-fit']],
                        ['label' => 'Pagination',      'route' => 'page', 'params' => ['path' => 'pagination']],
                        ['label' => 'Popovers',        'route' => 'page', 'params' => ['path' => 'popovers']],
                        ['label' => 'Progress',        'route' => 'page', 'params' => ['path' => 'progress']],
                        ['label' => 'Spinners',        'route' => 'page', 'params' => ['path' => 'spinners']],
                        ['label' => 'Toasts',          'route' => 'page', 'params' => ['path' => 'toasts']],
                        ['label' => 'Tooltips',        'route' => 'page', 'params' => ['path' => 'tooltips']],
                        ['label' => 'Typography',      'route' => 'page', 'params' => ['path' => 'typography']],
                    ],
                ],
                [
                    'label' => 'Nested Menu',
                    'icon'  => 'menu',
                    'children' => [
                        ['label' => 'Level 1.1', 'route' => 'page', 'params' => ['path' => 'level-1-1']],
                        ['label' => 'Level 1.2', 'children' => [
                            ['label' => 'Level 2.1', 'route' => 'page', 'params' => ['path' => 'level-2-1']],
                            ['label' => 'Level 2.2', 'children' => [
                                ['label' => 'Level 3.1', 'route' => 'page', 'params' => ['path' => 'level-3-1']],
                                ['label' => 'Level 3.2', 'route' => 'page', 'params' => ['path' => 'level-3-2']],
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
                        ['label' => 'Google Maps', 'route' => 'page', 'params' => ['path' => 'google-maps']],
                        ['label' => 'Vector Maps', 'route' => 'page', 'params' => ['path' => 'vector-maps']],
                    ],
                ],
                [
                    'label' => 'Charts',
                    'icon'  => 'bar-chart-3',
                    'route' => 'charts',
                    'children' => [
                        ['label' => 'Line',    'route' => 'page', 'params' => ['path' => 'line']],
                        ['label' => 'Area',    'route' => 'page', 'params' => ['path' => 'area']],
                        ['label' => 'Bar',     'route' => 'page', 'params' => ['path' => 'bar']],
                        ['label' => 'Pie',     'route' => 'page', 'params' => ['path' => 'pie']],
                        ['label' => 'Radar',   'route' => 'page', 'params' => ['path' => 'radar']],
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
                        ['label' => 'Form Elements',   'route' => 'page', 'params' => ['path' => 'form-elements']],
                        ['label' => 'Form Layouts',    'route' => 'page', 'params' => ['path' => 'form-layouts']],
                        ['label' => 'Form Validation', 'route' => 'page', 'params' => ['path' => 'form-validation']],
                        ['label' => 'Form Wizard',     'route' => 'page', 'params' => ['path' => 'form-wizard']],
                    ],
                ],
                [
                    'label' => 'Tables',
                    'icon'  => 'table',
                    'badge' => ['text' => '3', 'variant' => 'success'],
                    'route' => 'tables',
                    'children' => [
                        ['label' => 'Basic Tables', 'route' => 'page', 'params' => ['path' => 'basic-tables']],
                        ['label' => 'Data Table',   'route' => 'page', 'params' => ['path' => 'data-table']],
                        ['label' => 'Editable',     'route' => 'page', 'params' => ['path' => 'editable']],
                    ],
                ],
            ],
        ],
    ],
];
