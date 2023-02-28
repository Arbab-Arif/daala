<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PermissionSyncCommandTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_sync_all_permission_in_database()
    {
        $this->assertEquals(0, Permission::count());
        $this->artisan('daala:permissions');
        $this->assertGreaterThan(1, Permission::count());
    }

    /** @test */
    function it_cannot_delete_existing_permission()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(
            [
                'label' => 'Category Management',
                'slug' => 'category_management'
            ]
        );

        $role->permissions()->sync($permission);
        $this->assertCount(1, $role->fresh()->permissions);

        $this->artisan('daala:permissions');
        $this->assertCount(1, $role->fresh()->permissions);
    }
}
