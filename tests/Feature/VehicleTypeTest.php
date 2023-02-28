<?php

namespace Tests\Feature;

use App\Http\Livewire\VehicleTypeList;
use App\Models\Area;
use App\Models\AreaVehicleType;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class VehicleTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/vehicle_type')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    function a_user_can_be_create_vehicle_type()
    {
        $area = Area::factory()->create();

        $this->adminSignIn()
            ->post('/admin/vehicle_type', [
                'name' => 'bike',
                'width' => '125',
                'height' => '124',
                'breath' => '11',
                'per_km' => '23',
                'per_min' => '12',
                'base_distance' => '20',
                'commission' => '201',
                'description' => 'description',
                'status' => 1,
                'areas' => [
                    [
                        'area_id' => $area->id,
                        'area_per_km' => 3,
                        'area_per_min' => 33,
                        'price' => 90
                    ],
                ],

            ])->assertRedirect('/admin/vehicle_type');

        $item = VehicleType::first();
        $this->assertCount(1, $item->areas);
        $this->assertDatabaseHas('vehicle_types', ['name' => 'bike']);
    }

    /** @test */
    function a_user_can_update_vehicle_type()
    {
        $area = Area::factory()->create();

        $vehicleTypes = VehicleType::factory()->create();

        $this->assertCount(0, $vehicleTypes->areas);

        $this->assertDatabaseHas('vehicle_types', ['name' => $vehicleTypes->name]);

        $this->adminSignIn()
            ->put("admin/vehicle_type/{$vehicleTypes->id}", [
                'name' => 'Car',
                'width' => '125',
                'height' => '124',
                'breath' => '11',
                'per_km' => '23',
                'per_min' => '12',
                'base_distance' => '20',
                'commission' => '201',
                'description' => 'asdkjaskdjaksdjl',
                'status' => 1,
                'areas' => [
                    [
                        'area_id' => $area->id,
                        'area_per_km' => 3,
                        'area_per_min' => 33,
                        'price' => 90
                    ],
                ],
            ])
            ->assertRedirect('/admin/vehicle_type');

        $this->assertDatabaseMissing('vehicle_types', ['name' => $vehicleTypes->name]);

        $vehicleTypes = $vehicleTypes->fresh();

        $this->assertCount(1, $vehicleTypes->areas);
        $this->assertDatabaseHas('vehicle_types', ['name' => 'Car']);
    }

    /** @test */
    function it_user_can_delete_vehicle_type()
    {
        $this->a_user_can_be_create_vehicle_type();
        $vehicleType = VehicleType::first();

        $this->assertEquals(1, AreaVehicleType::count());

        Livewire::test(VehicleTypeList::class)
            ->call('deleteVehicleType', $vehicleType->id);

        $this->assertDatabaseMissing('vehicle_types', ['name' => $vehicleType->name]);
        $this->assertEquals(0, AreaVehicleType::count());
    }

    /** @test */
    function it_throw_validation_exception_when_validation_fails()
    {
        $this->expectException(ValidationException::class);
        $this->adminSignIn()->post('/admin/vehicle_type');
    }

    /** @test */
    public function it_user_update_vehicle_type_status()
    {
        $vehicleType = VehicleType::factory()->create();

        Livewire::test(VehicleTypeList::class)
            ->call('updateStatusVehicleType', $vehicleType);

        $this->assertDatabaseHas('vehicle_types', ['status' => 0]);
    }
}
