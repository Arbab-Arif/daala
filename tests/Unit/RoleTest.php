<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_admin_can_create_role()
    {
        Role::factory()->create([
            'label' => 'Manager'
        ]);
        $this->assertDatabaseHas('roles', ['label' => 'Manager']);
    }

    /** @test */
    public function it_admin_can_create_role_with_many_permissions()
    {
        Role::factory()->has(Permission::factory()->count(2))->create();

        $role = Role::factory()->create([
            'label' => 'Manager'
        ]);

        $role->permissions()->sync([1,2]);

        $this->assertCount(2, $role->permissions);

    }

}
