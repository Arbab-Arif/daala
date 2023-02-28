<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Providers\RoleProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function it_shows_401_on_unauthenticated_user()
    {
        $admin = Admin::factory()->create();
        $this->withExceptionHandling()
            ->adminSignIn($admin)
            ->get('/admin/role')
            ->assertStatus(401);
    }

    /** @test */
    function authorized_user_can_view_the_page()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(['slug' => 'role_management']);
        $role->permissions()->sync($permission);
        $admin = Admin::factory()->create();
        $admin->roles()->sync($role);
        RoleProvider::define();
        $this->adminSignIn($admin)
            ->get('/admin/role')
            ->assertStatus(200);
    }
}
