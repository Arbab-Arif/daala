<?php

namespace Tests\Feature;

use App\Http\Livewire\RolePermission;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_guest_user_cannot_view_this_page()
    {
        $this->get('/admin/role')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function it_admin_can_stored_role_in_database()
    {
        $this->adminSignIn();
        $this->post('/admin/role', [
                'label' => 'Manager'
            ]);

        $this->assertDatabaseHas('roles', ['label' => 'Manager']);
    }

    /** @test */
    public function a_role_can_be_stored_with_its_permissions_in_database()
    {
        Role::factory()->has(Permission::factory()->count(3))->create();
        $this->adminSignIn()
            ->post('/admin/role', [
                'label' => 'Manager',
                'permissions' => [
                    1,
                    2,
                    3
                ]
            ]);

        $this->assertDatabaseHas('roles', ['label' => 'Manager']);
        $role = Role::first();
        $this->assertCount(3, $role->permissions);

    }

    /** @test */

    public function a_role_can_be_updated_in_database()
    {
        $this->adminSignIn();
        $roleId = Role::factory()->create(['label' => 'Manager'])->id;
        Role::factory()->has(Permission::factory()->count(3))->create();
        $this->assertDatabaseHas('roles', ['label' => 'Manager']);

        $this->put("admin/role/{$roleId}", [
            'label' => "Officer",
            'permissions' => [
                1,
                2
            ]
        ]);

        $role = Role::first();

        $this->assertCount(2, $role->permissions);

        $this->assertDatabaseMissing('roles', ['label' => 'Manager']);
        $this->assertDatabaseHas('roles', ['label' => 'Officer']);

    }


    /** @test */
    function test_a_user_can_delete_a_roles_with_it_permissions()
    {
        $this->adminSignIn();
        $roleId = Role::factory()->create(['label' => 'Officer'])->id;
        Role::factory()->has(Permission::factory()->count(2))->create();
        $role = Role::first();
        $role->permissions()->sync([1, 2]);
        $this->assertDatabaseHas('permission_role', ['role_id' => $roleId]);
        $this->assertDatabaseHas('roles', ['label' => 'Officer']);
        Livewire::test(RolePermission::class)
            ->call('deleteRole', $roleId);
        $this->assertDatabaseMissing('roles', ['label' => 'Officer']);
        $this->assertDatabaseMissing('permission_role', ['role_id' => $roleId]);
    }

    /** @test */
    function it_updates_cache_when_role_added()
    {
        $this->artisan('cache:clear');
        Role::factory()->has(Permission::factory()->count(3))->create();

        $this->adminSignIn()
            ->post('/admin/role', [
                'label' => 'Manager',
                'permissions' => [
                    1,
                    2,
                    3
                ]
            ]);

        $this->assertTrue(Cache::has('roles'));
        $this->assertCount(3, Cache::get('roles'));
    }
}
