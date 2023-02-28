<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Providers\RoleProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SyncRolePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daala:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create All Define Permission In Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->getAllPermissions() as $permission) {
            Permission::firstOrCreate([
                'label' => $permission['label'],
                'slug'  => $permission['slug']
            ]);
        }
        Cache::forget('roles');
        RoleProvider::define();
    }

    protected function getAllPermissions()
    {
        return [
            [
                'label' => 'Item Management',
                'slug'  => 'item_management'
            ],
            [
                'label' => 'Commercial Type Management',
                'slug'  => 'vehicle_type_management'
            ],
            [
                'label' => 'Coupon Management',
                'slug'  => 'coupon_management'
            ],
            [
                'label' => 'Driver Management',
                'slug'  => 'driver_management'
            ],
            [
                'label' => 'Customer Management',
                'slug'  => 'customer_management'
            ],
            [
                'label' => 'Customer Review Management',
                'slug'  => 'customer_review_management'
            ],
            [
                'label' => 'Customer Feedback Management',
                'slug'  => 'customer_feedback_management'
            ],
            [
                'label' => 'User Request Management',
                'slug'  => 'user_request_management'
            ],
            [
                'label' => 'Setting Management',
                'slug'  => 'setting_management'
            ],
            [
                'label' => 'Role Management',
                'slug'  => 'role_management'
            ],
            [
                'label' => 'Admin Management',
                'slug'  => 'admin_management'
            ],
            [
                'label' => 'Page Management',
                'slug'  => 'page_management'
            ],
            [
                'label' => 'Slider Management',
                'slug'  => 'slider_management'
            ],
            [
                'label' => 'Area Management',
                'slug'  => 'area_management'
            ],
            [
                'label' => 'Reports Management',
                'slug'  => 'reports_management'
            ],
            [
                'label' => 'Category Management',
                'slug'  => 'category_management'
            ],
            [
                'label' => 'Vehicle Management',
                'slug'  => 'vehicle_management'
            ],
            [
                'label' => 'Banner Management',
                'slug'  => 'banner_management'
            ],
        ];
    }
}
