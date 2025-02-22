<?php
namespace App\Services;

use TorMorten\Eventy\Facades\Eventy as Hook;

class MenuService
{
    protected $menus;

    public function buildMenus()
    {
        $this->menus    =   [
            'dashboard' =>  [
                'label'         =>  __( 'Dashboard' ),                
                'permissions'   =>  [ 'update.core', 'read.dashboard' ],
                'icon'          =>  'la-home',
                'childrens'     =>  [
                    'index'             =>  [
                        'label'         =>  __( 'Home' ),
                        'permissions'   =>  [ 'read.dashboard' ],
                        'href'          =>  ns()->url( '/dashboard' ),
                    ],
                ]
            ], 
            'pos'   =>  [
                'label' =>  __( 'POS' ),
                'icon'  =>  'la-cash-register',
                'permissions'   =>  [ 'nexopos.create.orders' ],
                'href'  =>  ns()->url( '/dashboard/pos' )
            ], 
            'orders'    =>  [
                'label' =>  __( 'Orders' ),
                'permissions'   =>  [ 'nexopos.update.orders', 'nexopos.read.orders' ],
                'icon'  =>  'la-list-ol',
                'href'  =>  ns()->url( '/dashboard/orders' )
            ], 
            'medias'    =>  [
                'label'         =>  __( 'Medias' ),
                'permissions'   =>  [ 'nexopos.upload.medias', 'nexopos.see.medias' ],
                'icon'          =>  'la-photo-video',
                'href'          =>  ns()->url( '/dashboard/medias' )
            ], 
            'customers' =>  [
                'label' =>  __( 'Customers' ),
                'permissions'   =>  [
                    'nexopos.read.customers',
                    'nexopos.create.customers',
                    'nexopos.read.customers-groups',
                    'nexopos.create.customers-groups',
                    'nexopos.import.customers',
                    'nexopos.read.rewards',
                    'nexopos.create.rewards',
                    'nexopos.read.coupons',
                    'nexopos.create.coupons',
                ],
                'icon'  =>  'la-user-friends',
                'childrens'     =>  [
                    'customers' =>  [
                        'label' =>  __( 'List'),
                        'permissions'   =>  [ 'nexopos.read.customers' ],
                        'href'  =>  ns()->url( '/dashboard/customers' )
                    ], 
                    'create-customer'  =>   [
                        'label' =>  __( 'Create Customer'),
                        'permissions'   =>  [ 'nexopos.create.customers' ],
                        'href'  =>  ns()->url( '/dashboard/customers/create' )
                    ], 
                    'customers-groups'  =>  [
                        'label' =>  __( 'Customers Groups'),
                        'permissions'   =>  [ 'nexopos.read.customers-groups' ],
                        'href'  =>  ns()->url( '/dashboard/customers/groups' )
                    ], 
                    'create-customers-group'    =>  [
                        'label' =>  __( 'Create Group'),
                        'permissions'   =>  [ 'nexopos.create.customers-groups' ],
                        'href'  =>  ns()->url( '/dashboard/customers/groups/create' )
                    ], 
                    'list-reward-system'    =>  [
                        'label' =>  __( 'Reward Systems'),
                        'permissions'   =>  [ 'nexopos.read.rewards' ],
                        'href'  =>  ns()->url( '/dashboard/customers/rewards-system' )
                    ],
                    'create-reward-system'    =>  [
                        'label' =>  __( 'Create Reward'),
                        'permissions'   =>  [ 'nexopos.create.rewards' ],
                        'href'  =>  ns()->url( '/dashboard/customers/rewards-system/create' )
                    ],
                    'list-coupons'    =>  [
                        'label' =>  __( 'List Coupons'),
                        'permissions'   =>  [ 'nexopos.read.coupons' ],
                        'href'  =>  ns()->url( '/dashboard/customers/coupons' )
                    ],
                    'create-coupons'    =>  [
                        'label' =>  __( 'Create Coupon'),
                        'permissions'   =>  [ 'nexopos.create.coupons' ],
                        'href'  =>  ns()->url( '/dashboard/customers/coupons/create' )
                    ],
                ]
            ], 
            'providers' =>  [
                'label' =>  __( 'Providers' ),
                'icon'  =>  'la-user-tie',
                'permissions'   =>  [
                    'nexopos.read.providers',
                    'nexopos.create.providers',
                ],
                'childrens'     =>  [
                    'providers' =>  [
                        'label' =>  __( 'List'),
                        'permissions'   =>  [ 'nexopos.read.providers' ],
                        'href'  =>  ns()->url( '/dashboard/providers' )
                    ], 
                    'create-provider'   =>  [
                        'label' =>  __( 'Create A Provider'),
                        'permissions'   =>  [ 'nexopos.create.providers' ],
                        'href'  =>  ns()->url( '/dashboard/providers/create' )
                    ]
                ]
            ], 
            'expenses' =>  [
                'label' =>  __( 'Expenses' ),
                'icon'  =>  'la-money-bill-wave',
                'permissions'   =>  [
                    "nexopos.read.expenses",
                    "nexopos.create.expenses",
                    "nexopos.read.expenses-categories",
                    "nexopos.create.expenses-categories",
                ],
                'childrens'     =>  [
                    'expenses' =>  [
                        'label' =>  __( 'Expenses'),
                        'permissions'   =>  [ 'nexopos.read.expenses' ],
                        'href'  =>  ns()->url( '/dashboard/expenses' )
                    ], 
                    'create-expense'   =>  [
                        'label' =>  __( 'Create Expense'),
                        'permissions'   =>  [ 'nexopos.create.expenses' ],
                        'href'  =>  ns()->url( '/dashboard/expenses/create' )
                    ],
                    'expenses-history'  =>  [
                        'label'         =>  __( 'Expenses History' ),
                        'permissions'   =>  [ 'nexopos.read.expenses' ],
                        'href'          =>  ns()->url( '/dashboard/expenses/history' )
                    ],
                    'expenses-categories'   =>  [
                        'label' =>  __( 'Expense Categories'),
                        'permissions'   =>  [ 'nexopos.read.expenses-categories' ],
                        'href'  =>  ns()->url( '/dashboard/expenses/categories' )
                    ],
                    'create-expenses-categories'   =>  [
                        'label' =>  __( 'Create Expense Category'),
                        'permissions'   =>  [ 'nexopos.create.expenses-categories' ],
                        'href'  =>  ns()->url( '/dashboard/expenses/categories/create' )
                    ]
                ]
            ], 
            'inventory' =>  [
                'label' =>  __( 'Inventory' ),
                'icon'  =>  'la-boxes',
                'permissions'   =>  [
                    'nexopos.read.products',
                    'nexopos.create.products',
                    'nexopos.read.categories',
                    'nexopos.create.categories',
                    'nexopos.read.products-units',
                    'nexopos.create.products-units',
                    'nexopos.read.products-units',
                    'nexopos.create.products-units',
                    'nexopos.make.products-adjustments',
                ],
                'childrens'     =>  [
                    'products'  =>  [
                        'label' =>  __( 'Products' ),
                        'permissions'   =>  [ 'nexopos.read.products' ],
                        'href'  =>  ns()->url( '/dashboard/products' )
                    ], 
                    'create-products'   =>  [
                        'label' =>  __( 'Create Product'),
                        'permissions'   =>  [ 'nexopos.create.products' ],
                        'href'  =>  ns()->url( '/dashboard/products/create' )
                    ], 
                    'labels-printing'   =>  [
                        'label'         =>  __( 'Print Labels' ),
                        'href'          =>  ns()->url( '/dashboard/products/print-labels' ),
                        'permissions'   =>  [ 'nexopos.create.products-labels' ]
                    ],
                    'categories'   =>  [
                        'label' =>  __( 'Categories'),
                        'permissions'   =>  [ 'nexopos.read.categories' ],
                        'href'  =>  ns()->url( '/dashboard/products/categories' )
                    ], 
                    'create-categories'   =>  [
                        'label' =>  __( 'Create Category'),
                        'permissions'   =>  [ 'nexopos.create.categories' ],
                        'href'  =>  ns()->url( '/dashboard/products/categories/create' )
                    ],
                    'units'   =>  [
                        'label' =>  __( 'Units'),
                        'permissions'   =>  [ 'nexopos.read.products-units' ],
                        'href'  =>  ns()->url( '/dashboard/units' )
                    ],
                    'create-units'   =>  [
                        'label' =>  __( 'Create Unit'),
                        'permissions'   =>  [ 'nexopos.create.products-units' ],
                        'href'  =>  ns()->url( '/dashboard/units/create' )
                    ],
                    'unit-groups'   =>  [
                        'label' =>  __( 'Unit Groups'),
                        'permissions'   =>  [ 'nexopos.read.products-units' ],
                        'href'  =>  ns()->url( '/dashboard/units/groups' )
                    ],
                    'create-unit-groups'   =>  [
                        'label' =>  __( 'Create Unit Groups'),
                        'permissions'   =>  [ 'nexopos.create.products-units' ],
                        'href'  =>  ns()->url( '/dashboard/units/groups/create' )
                    ],
                    'stock-adjustment'      =>  [
                        'label'             =>  __( 'Stock Adjustment'),
                        'permissions'       =>  [ 'nexopos.make.products-adjustments' ],
                        'href'              =>  ns()->url( '/dashboard/products/stock-adjustment' )
                    ],
                ]
            ], 
            'taxes'     =>  [
                'label' =>  __( 'Taxes' ),
                'icon'  =>  'la-balance-scale-left',
                'permissions'           =>  [
                    'nexopos.create.taxes',
                    'nexopos.read.taxes',
                    'nexopos.update.taxes',
                    'nexopos.delete.taxes',
                ],
                'childrens' =>  [
                    'taxes-groups'   =>  [
                        'label'         =>  __( 'Taxes Groups'),
                        'permissions'   =>  [ 'nexopos.read.taxes' ],
                        'href'          =>  ns()->url( '/dashboard/taxes/groups' )
                    ],
                    'create-taxes-group'   =>  [
                        'label'         =>  __( 'Create Tax Groups'),
                        'permissions'   =>  [ 'nexopos.create.taxes' ],
                        'href'          =>  ns()->url( '/dashboard/taxes/groups/create' )
                    ],
                    'taxes'             =>  [
                        'label'         =>  __( 'Taxes'),
                        'permissions'   =>  [ 'nexopos.read.taxes' ],
                        'href'          =>  ns()->url( '/dashboard/taxes' )
                    ],
                    'create-tax'        =>  [
                        'label'         =>  __( 'Create Tax'),
                        'permissions'   =>  [ 'nexopos.create.taxes' ],
                        'href'          =>  ns()->url( '/dashboard/taxes/create' )
                    ]
                ]
            ],
            'modules' =>  [
                'label' =>  __( 'Modules' ),
                'icon'  =>  'la-plug',
                'permissions'   =>  [ 'manage.modules' ],
                'childrens'     =>  [
                    'modules'  =>  [
                        'label' =>  __( 'List' ),
                        'href'  =>  ns()->url( '/dashboard/modules' )
                    ], 
                    'upload-module'   =>  [
                        'label' =>  __( 'Upload Module'),
                        'href'  =>  ns()->url( '/dashboard/modules/upload' )
                    ], 
                ]
            ], 
            'users'      =>  [
                'label'         =>  __( 'Users' ),
                'icon'          =>  'la-users',
                'childrens'     =>  [
                    'profile'  =>  [
                        'label' =>  __( 'List' ),
                        'permissions'   =>  [ 'manage.profile' ],
                        'href'  =>  ns()->url( '/dashboard/users/profile' )
                    ], 
                    'users'  =>  [
                        'label' =>  __( 'List' ),
                        'permissions'   =>  [ 'read.users' ],
                        'href'  =>  ns()->url( '/dashboard/users' )
                    ], 
                    'create-user'  =>  [
                        'label' =>  __( 'Create User' ),
                        'permissions'   =>  [ 'create.users' ],
                        'href'  =>  ns()->url( '/dashboard/users/create' )
                    ], 
                    'roles'  =>  [
                        'label' =>  __( 'Roles' ),
                        'permissions'   =>  [ 'read.roles' ],
                        'href'  =>  ns()->url( '/dashboard/users/roles' )
                    ], 
                    'create-role'  =>  [
                        'label' =>  __( 'Create Roles' ),
                        'permissions'   =>  [ 'create.roles' ],
                        'href'  =>  ns()->url( '/dashboard/users/roles/create' )
                    ], 
                    'permissions'  =>  [
                        'label' =>  __( 'Permissions Manager' ),
                        'permissions'   =>  [ 'update.roles' ],
                        'href'  =>  ns()->url( '/dashboard/users/roles/permissions-manager' )
                    ], 
                    'profile'  =>  [
                        'label' =>  __( 'Profile' ),
                        'href'  =>  ns()->url( '/dashboard/users/profile' )
                    ], 
                ]
            ],
            'procurements'      =>  [
                'label'         =>  __( 'Procurements' ),
                'icon'          =>  'la-truck-loading',
                'permissions'   =>  [ 'nexopos.read.procurements', 'nexopos.create.procurements' ],
                'childrens'     =>  [
                    'procurements'  =>  [
                        'label'         =>  __( 'Procurements List' ),
                        'permissions'   =>  [ 'nexopos.read.procurements' ],
                        'href'          =>  ns()->url( '/dashboard/procurements' )
                    ], 
                    'procurements-create'  =>  [
                        'label' =>  __( 'New Procurement' ),
                        'permissions'   =>  [ 'nexopos.create.procurements' ],
                        'href'  =>  ns()->url( '/dashboard/procurements/create' )
                    ], 
                ]
            ],
            'reports'      =>  [
                'label'         =>  __( 'Reports' ),
                'icon'          =>  'la-chart-pie',
                'permissions'   =>  [
                    'nexopos.reports.sales',
                    'nexopos.reports.best_sales',
                    'nexopos.reports.cash_flow',
                    'nexopos.reports.yearly',
                    'nexopos.reports.customers',
                    'nexopos.reports.inventory',
                ],
                'childrens'     =>  [
                    'sales'  =>  [
                        'label' =>  __( 'Sale Report' ),
                        'permissions'   =>  [ 'nexopos.reports.sales' ],
                        'href'  =>  ns()->url( '/dashboard/reports/sales' )
                    ], 
                    'sold-stock'  =>  [
                        'label' =>  __( 'Sold Stock' ),
                        'href'  =>  ns()->url( '/dashboard/reports/sold-stock' )
                    ], 
                    'profit'  =>  [
                        'label' =>  __( 'Incomes & Loosses' ),
                        'href'  =>  ns()->url( '/dashboard/reports/profit' )
                    ], 
                    'cash-flow'  =>  [
                        'label' =>  __( 'Cash Flow' ),
                        'permissions'   =>  [ 'nexopos.reports.cash_flow' ],
                        'href'  =>  ns()->url( '/dashboard/reports/cash-flow' )
                    ], 
                    'annulal-sales'  =>  [
                        'label' =>  __( 'Annual Report' ),
                        'permissions'   =>  [ 'nexopos.reports.yearly' ],
                        'href'  =>  ns()->url( '/dashboard/reports/annual-report' )
                    ], 
                ]
            ],
            'settings'      =>  [
                'label'         =>  __( 'Settings' ),
                'icon'          =>  'la-cogs',
                'permissions'   =>  [ 'manage.options' ],
                'childrens'     =>  [
                    'general'   =>  [
                        'label' =>  __( 'General' ),
                        'href'  =>  ns()->url( '/dashboard/settings/general' )
                    ], 
                    'pos'       =>  [
                        'label' =>  __( 'POS'),
                        'href'  =>  ns()->url( '/dashboard/settings/pos' )
                    ],  
                    'customers' =>  [
                        'label' =>  __( 'Customers'),
                        'href'  =>  ns()->url( '/dashboard/settings/customers' )
                    ], 
                    'supplies-delivery'     =>  [
                        'label'             =>  __( 'Supplies & Deliveries'),
                        'href'              =>  ns()->url( '/dashboard/settings/supplies-deliveries' )
                    ],
                    'orders'        =>  [
                        'label'     =>  __( 'Orders'),
                        'href'      =>  ns()->url( '/dashboard/settings/orders' )
                    ],
                    'reports'       =>  [
                        'label'     =>  __( 'Reports'),
                        'href'      =>  ns()->url( '/dashboard/settings/reports' )
                    ],
                    'invoice-settings'  =>  [
                        'label'         =>  __( 'Invoice Settings'),
                        'href'          =>  ns()->url( '/dashboard/settings/invoice-settings' )
                    ],
                    'service-providers'     =>  [
                        'label'             =>  __( 'Service Providers'),
                        'href'              =>  ns()->url( '/dashboard/settings/service-providers' )
                    ],
                    'notifications'     =>  [
                        'label'         =>  __( 'Notifications'),
                        'href'          =>  ns()->url( '/dashboard/settings/notifications' )
                    ],
                    'workers'           =>  [
                        'label'         =>  __( 'Workers' ),
                        'href'          =>  ns()->url( '/dashboard/settings/workers' ),
                    ],
                    'reset'         =>  [
                        'label'     =>  __( 'Reset'),
                        'href'      =>  ns()->url( '/dashboard/settings/reset' )
                    ]
                ]
            ],
        ];
    }

    /**
     * returns the list of available menus
     * @return Array of menus
     */
    public function getMenus()
    {
        $this->buildMenus();
        $this->menus    =   Hook::filter( 'ns-dashboard-menus', $this->menus );
        $this->toggleActive();
        return $this->menus;
    }

    /**
     * Will make sure active menu
     * is toggled
     * @return void
     */
    public function toggleActive()
    {
        foreach( $this->menus as $identifier => &$menu ) {
            if ( isset( $menu[ 'href' ] ) && $menu[ 'href' ] === url()->current() ) {
                $menu[ 'toggled' ]  =   true;
            }

            if ( isset( $menu[ 'childrens' ] ) ) {
                foreach( $menu[ 'childrens' ] as $subidentifier => &$submenu ) {
                    if ( $submenu[ 'href' ] === url()->current() ) {
                        $menu[ 'toggled' ]      =   true;
                        $submenu[ 'active' ]    =   true;
                    }
                }
            }
        }
    }
}