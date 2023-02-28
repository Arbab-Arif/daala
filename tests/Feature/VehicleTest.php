<?php
//
//namespace Tests\Feature;
//
//use App\Http\Livewire\VehicleList;
//use App\Models\Vehicle;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Http\UploadedFile;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Validation\ValidationException;
//use Livewire\Livewire;
//use Tests\TestCase;
//
//class VehicleTest extends TestCase
//{
//    use RefreshDatabase;
//
//    /** @test */
//    function it_redirect_unauthorized_user()
//    {
//        $this->withExceptionHandling()
//            ->get('/admin/vehicle')
//            ->assertRedirect('/admin/login');
//    }
//
//    /** @test */
//    function a_user_can_be_create_vehicle()
//    {
//        $this->adminSignIn()
//            ->post('/admin/vehicle', [
//                'vehicle_name' => 'bike',
//                'vehicle_type_id' => 1,
//                'vehicle_cc' => '125',
//                'vehicle_no' => '03000000000',
//                'license_no' => '123456',
//                'make' => 'honda',
//                'model' => '2019',
//                'year' => '2019',
//                'color' => 'red',
//                'icon' => $file = UploadedFile::fake()->image('avatar.jpg'),
//                'status'    => 1
//            ])
//            ->assertRedirect('/admin/vehicle');
//
//        Storage::disk('public')->assertExists([
//            "vehicles/{$file->hashName()}"
//        ]);
//
//        $this->assertDatabaseHas('vehicles', ['vehicle_name' => 'bike']);
//    }
//
//    /** @test */
//    function a_user_can_update_vehicle()
//    {
//        $this->adminSignIn();
//
//        $prevFile = UploadedFile::fake()->image('some.jpg')->store('vehicles');
//
//        $vehicles = Vehicle::factory()->create(['icon' => $prevFile]);
//
//        $this->assertDatabaseHas('vehicles', [ 'vehicle_name' => $vehicles->vehicle_name ]);
//
//        Storage::disk('public')->assertExists([$prevFile]);
//
//        $this->put("admin/vehicle/{$vehicles->id}", [
//            'vehicle_name' => 'car',
//            'vehicle_type_id' => 1,
//            'vehicle_cc' => 'civic',
//            'vehicle_no' => '78sa8',
//            'license_no' => '123456',
//            'make' => 'honda',
//            'model' => '2019',
//            'year' => '2019',
//            'color' => 'red',
//            'icon' => $file = UploadedFile::fake()->image('avatar.jpg'),
//            'status'    => 1
//        ])
//            ->assertRedirect('/admin/vehicle');
//
//        Storage::disk('public')->assertExists(["vehicles/{$file->hashName()}"]);
//
//        Storage::disk('public')->assertMissing([$prevFile]);
//
//        $this->assertDatabaseMissing('vehicles', [ 'vehicle_name' => $vehicles->vehicle_name ]);
//
//        $this->assertDatabaseHas('vehicles', [ 'vehicle_name' => 'car' ]);
//    }
//
//    /** @test */
//    function it_user_can_delete_vehicle()
//    {
//        $vehicle = Vehicle::factory()->create();
//
//        $this->assertDatabaseHas('vehicles', [ 'vehicle_name' => $vehicle->vehicle_name ]);
//
//        Livewire::test(VehicleList::class)
//            ->call('deleteVehicle', $vehicle->id);
//
//        $this->assertDatabaseMissing('vehicles', [ 'vehicle_name' => $vehicle->vehicle_name]);
//    }
//
//    /** @test */
//    function it_throw_validation_exception_when_validation_fails()
//    {
//        $this->expectException(ValidationException::class);
//        $this->adminSignIn()->post('/admin/vehicle');
//    }
//
//    /** @test */
//    public function it_user_update_vehicle_status()
//    {
//        $vehicle = Vehicle::factory()->create();
//
//        Livewire::test(VehicleList::class)
//            ->call('updateStatusVehicle', $vehicle);
//
//        $this->assertDatabaseHas('vehicles', ['status' => 0]);
//    }
//}
