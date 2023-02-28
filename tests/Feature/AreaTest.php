<?php

namespace Tests\Feature;

use App\Http\Livewire\AreaList;
use App\Models\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AreaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/area')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function it_admin_can_create_area_in_database()
    {
        $this->adminSignIn()
            ->post('/admin/area', [
                'name' => 'area',
                'bounds' => '{ "name": "Ford", "models": "Honda" }',
                'status' => 0,
            ]);

        $this->assertDatabaseHas('areas', ['name' => 'area']);
    }

    /** @test */
    public function it_admin_can_update_in_database()
    {

        $area = Area::factory()->create();

        $this->adminSignIn()
            ->put("/admin/area/{$area->id}", [
                'name' => 'area-2',
                'bounds' => '{ "name":"BMW", "models":"civic" }',
                'status' => 1
            ]);

        $this->assertDatabaseMissing('areas', ['name' => $area->name]);
        $this->assertDatabaseHas('areas', ['name' => 'area-2']);
    }

    /** @test */
    function it_can_admin_delete_item()
    {
        $area = Area::factory()->create();

        $this->assertDatabaseHas('areas', ['name' => $area->name]);

        Livewire::test(AreaList::class)
            ->call('areaDeleted', $area->id);
        $this->assertDatabaseMissing('areas', ['name' => $area->name]);

    }

    /** @test */
    public function it_user_update_vehicle_type_status()
    {
        $area = Area::factory()->create();

        Livewire::test(AreaList::class)
            ->call('statusUpdate', $area);

        $this->assertDatabaseHas('areas', ['status' => 1]);
    }
}
