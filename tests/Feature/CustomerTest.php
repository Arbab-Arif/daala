<?php

namespace Tests\Feature;

use App\Http\Livewire\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/customer')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    function it_admin_can_be_create_customer_()
    {
        $this->adminSignIn()
            ->post('/admin/customer', [
            'name' => 'user',
            'email' => 'testing@test.com',
            'phone' => '03000000000',
            'password' => 'password',
            'customer_type' => 'distributor',
            'picture' => $file = UploadedFile::fake()->image('avatar.jpg'),
            'postal_code' => '78665',
            'country_id' => 1,
            'city_id' => 1,
            'address'   => 'address',
            'status'    => 1
        ])
            ->assertRedirect('/admin/customer');

        Storage::disk('public')->assertExists([
            "customers/{$file->hashName()}"
        ]);

        $this->assertDatabaseHas('users', ['name' => 'user']);
    }

    /** @test */
    function it_admin_can_update_customer()
    {
        $this->adminSignIn();

        $prevFile = UploadedFile::fake()->image('some.jpg')->store('customers');

        $customer = User::factory()->create(['picture' => $prevFile]);

        $this->assertDatabaseHas('users', [ 'name' => $customer->name ]);

        Storage::disk('public')->assertExists([$prevFile]);

        $this->put("admin/customer/{$customer->id}", [
            'name' => 'customer',
            'email' => 'testing@test.com',
            'phone' => '0300123456789',
            'password' => '123456',
            'customer_type' => 'distributor',
            'picture' => $file = UploadedFile::fake()->image('default.jpg'),
            'postal_code' => '78665',
            'country_id' => 1,
            'city_id' => 1,
            'address'   => 'address',
            'status'    => 1
        ])
            ->assertRedirect('/admin/customer');

        Storage::disk('public')->assertExists(["customers/{$file->hashName()}"]);

        Storage::disk('public')->assertMissing([$prevFile]);

        $this->assertDatabaseMissing('users', [ 'name' => $customer->name ]);

        $this->assertDatabaseHas('users', [ 'name' => 'customer' ]);
    }

    /** @test */
    function it_admin_can_delete_customer()
    {
        $customer = User::factory()->create();

        $this->assertDatabaseHas('users', [ 'name' => $customer->name ]);

        Livewire::test(Customer::class)
            ->call('deleteCustomer', $customer->id);

        $this->assertDatabaseMissing('users', [ 'name' => $customer->name]);
    }

    /** @test */
    function it_throw_validation_exception_when_validation_fails()
    {
        $this->expectException(ValidationException::class);
        $this->adminSignIn()->post('/admin/customer');
    }

}
