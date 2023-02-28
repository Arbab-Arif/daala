<?php

namespace Tests\Feature;

use App\Http\Livewire\DriverList;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/driver')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    function a_user_can_be_created_driver()
    {
        $this->adminSignIn()
            ->post('/admin/driver', [
                'vehicle_id'        => 1,
                'country_id'        => 1,
                'city_id'           => 1,
                'name'              => 'user',
                'email'             => 'testing@test.com',
                'phone'             => '03000000000',
                'password'          => 'password',
                'picture'           => $file1 = UploadedFile::fake()->image('avatar.jpg'),
                'postal_code'       => '78665',
                'cnic'              => '420210102380',
                'address'           => 'address',
                'status'            => 1,
                'vehicle_name'      => 'cg-125',
                'vehicle_type_id'   => 1,
                'vehicle_cc'        => '125-cc',
                'vehicle_no'        => 'khi-000',
                'license_no'        => 'sd-0000',
                'make'              => 'make',
                'model'             => 'model',
                'color'             => 'red',
                'year'              => '2020',
                'vehicle_image'     => $file2 = UploadedFile::fake()->image('avatar.jpg'),
                'cnic_front_image'  => $file3 = UploadedFile::fake()->image('avatar.jpg'),
                'cnic_back_image'   => $file4 = UploadedFile::fake()->image('avatar.jpg'),
                'license_front_image' => $file5 = UploadedFile::fake()->image('avatar.jpg'),
                'license_back_image'=> $file6 = UploadedFile::fake()->image('avatar.jpg'),
                'vehicle_reg_image' => $file7 = UploadedFile::fake()->image('avatar.jpg')
            ])
            ->assertRedirect('/admin/driver');

        Storage::disk('public')->assertExists([
            "drivers/{$file1->hashName()}",
            "drivers/{$file2->hashName()}",
            "drivers/{$file3->hashName()}",
            "drivers/{$file4->hashName()}",
            "drivers/{$file5->hashName()}",
            "drivers/{$file6->hashName()}",
            "drivers/{$file7->hashName()}"
        ]);

        $this->assertDatabaseHas('drivers', ['name' => 'user']);
        $this->assertDatabaseHas('vehicles', ['vehicle_name' => 'cg-125']);
    }

    /** @test */
//    function a_user_can_update_driver_record()
//    {
//        $this->adminSignIn();
//
//        $prevFile = UploadedFile::fake()->image('some.jpg')->store('drivers');
//
//        $driver = Driver::factory()->create(['picture' => $prevFile]);
//        $vehicle_image = Vehicle::factory()->create(['vehicle_image' => $prevFile]);
//        $driver = Vehicle::factory()->create(['cnic_front_image' => $prevFile]);
//        $driver = Vehicle::factory()->create(['cnic_back_image' => $prevFile]);
//        $driver = Vehicle::factory()->create(['license_front_image' => $prevFile]);
//        $driver = Vehicle::factory()->create(['license_back_image' => $prevFile]);
//        $driver = Vehicle::factory()->create(['vehicle_reg_image' => $prevFile]);
//
//        $this->assertDatabaseHas('drivers', [ 'name' => $driver->name ]);
//
//        Storage::disk('public')->assertExists([$prevFile]);
//
//        $this->put("admin/driver/{$driver->id}", [
//            'vehicle_id' => 1,
//            'country_id' => 1,
//            'city_id' => 1,
//            'name' => 'driver',
//            'email' => 'testing@test.com',
//            'phone' => '03000000000',
//            'password' => 'password',
//            'picture' => $file = UploadedFile::fake()->image('avatar.jpg'),
//            'postal_code' => '78665',
//            'cnic' => '420210102380',
//            'address'   => 'address',
//            'status'    => 1,
//            'vehicle_name'      => 'cg-125',
//            'vehicle_type_id'   => 1,
//            'vehicle_cc'        => '125-cc',
//            'vehicle_no'        => 'khi-000',
//            'license_no'        => 'sd-0000',
//            'make'              => 'make',
//            'model'             => 'model',
//            'color'             => 'red',
//            'year'              => '2020',
//            'vehicle_image'     => $file2 = UploadedFile::fake()->image('avatar.jpg'),
//            'cnic_front_image'  => $file3 = UploadedFile::fake()->image('avatar.jpg'),
//            'cnic_back_image'   => $file4 = UploadedFile::fake()->image('avatar.jpg'),
//            'license_front_image' => $file5 = UploadedFile::fake()->image('avatar.jpg'),
//            'license_back_image'=> $file6 = UploadedFile::fake()->image('avatar.jpg'),
//            'vehicle_reg_image' => $file7 = UploadedFile::fake()->image('avatar.jpg')
//        ])
//            ->assertRedirect('/admin/driver');
//
//        Storage::disk('public')->assertExists(["drivers/{$file->hashName()}"]);
//        Storage::disk('public')->assertExists(["drivers/{$file2->hashName()}"]);
//        Storage::disk('public')->assertExists(["drivers/{$file3->hashName()}"]);
//        Storage::disk('public')->assertExists(["drivers/{$file4->hashName()}"]);
//        Storage::disk('public')->assertExists(["drivers/{$file5->hashName()}"]);
//        Storage::disk('public')->assertExists(["drivers/{$file6->hashName()}"]);
//        Storage::disk('public')->assertExists(["drivers/{$file7->hashName()}"]);
//
//        Storage::disk('public')->assertMissing([$prevFile]);
//
//        $this->assertDatabaseMissing('drivers', [ 'name' => $driver->name ]);
//        $this->assertDatabaseHas('drivers', [ 'name' => 'driver' ]);
//
//        $this->assertDatabaseMissing('vehicles', [ 'vehicle_name' => $driver->vehicle_name ]);
//        $this->assertDatabaseHas('vehicles', [ 'vehicle_name' => 'cg-125' ]);
//    }

    /** @test */
    function it_user_can_delete_driver()
    {
        $driver = Driver::factory()->create();
        $vehicle = Vehicle::factory()->create();

        $this->assertDatabaseHas('drivers', [ 'name' => $driver->name ]);
        $this->assertDatabaseHas('vehicles', [ 'vehicle_name' => $vehicle->vehicle_name ]);


        Livewire::test(DriverList::class)
            ->call('deleteDriver', $driver->id, $vehicle->id);

        $this->assertDatabaseMissing('drivers', [ 'name' => $driver->name]);
        $this->assertDatabaseMissing('vehicles', [ 'vehicle_name' => $vehicle->vehicle_name]);
    }

    /** @test */

    function it_throw_validation_exception_when_validation_fails()
    {
        $this->expectException(ValidationException::class);
        $this->adminSignIn()->post('/admin/driver');
    }

    /** @test */
    public function it_user_update_driver_status()
    {
        $driver = Driver::factory()->create();

        Livewire::test(DriverList::class)
            ->call('updateStatusDriver', $driver);

        $this->assertDatabaseHas('drivers', ['status' => 0]);
    }

}
