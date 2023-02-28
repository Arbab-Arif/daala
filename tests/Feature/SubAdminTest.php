<?php

namespace Tests\Feature;

use App\Http\Livewire\SubAdmin;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class SubAdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/sub_admin')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function a_sub_admin_can_be_created()
    {
        $this->adminSignIn()
            ->post('/admin/sub_admin', [
                'name' => 'user',
                'email' => 'demo@test.com',
                'contact' => '03172134445',
                'password' => 'demo1234',
            ])
            ->assertRedirect('/admin/sub_admin');

        $this->assertDatabaseHas('admins', ['name' => 'user']);
    }

    /** @test * */
    public function a_sub_admin_can_be_updated()
    {
        $this->adminSignIn();

        $subAdmin = Admin::factory()->create();

        $this->assertDatabaseHas('admins', ['name' => $subAdmin->name]);

        $this->put("admin/sub_admin/{$subAdmin->id}", [
            'name' => 'sub-admin',
            'email' => 'demo@test.com',
            'contact' => '03000000000',
            'password' => 'demo123',
        ])
            ->assertRedirect('/admin/sub_admin');

        $this->assertDatabaseMissing('admins', ['name' => $subAdmin->name]);

        $this->assertDatabaseHas('admins', ['name' => 'sub-admin']);
    }

    /** @test */
    function it_user_can_delete_sub_admin()
    {
        $subAdmin = Admin::factory()->create();

        $this->assertDatabaseHas('admins', [ 'name' => $subAdmin->name ]);

        Livewire::test(SubAdmin::class)
            ->call('deleteSubAdmin', $subAdmin->id);

        $this->assertDatabaseMissing('admins', [ 'name' => $subAdmin->name]);
    }

    /** @test */
    function it_throw_validation_exception_when_validation_fails()
    {
        $this->expectException(ValidationException::class);
        $this->adminSignIn()->post('/admin/sub_admin');
    }

}
