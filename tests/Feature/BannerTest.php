<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BannerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/banner/create')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function a_user_can_create_setting()
    {
        $this->adminSignIn();

        $prevFile = UploadedFile::fake()->image('some.jpg')->store('banners');
        $banners = Banner::factory()->create(['image' => $prevFile]);
        $this->assertDatabaseHas('banners', [ 'image' => $banners->image ]);
        Storage::disk('public')->assertExists([$prevFile]);

        $this->post('/admin/banner', [
                'image' => $file = UploadedFile::fake()->image('testing.jpg'),
            ]);

        Storage::disk('public')->assertExists(["banners/{$file->hashName()}"]);
        Storage::disk('public')->assertMissing([$prevFile]);
        $this->assertDatabaseMissing('banners', [ 'image' => $banners->image ]);
        $this->assertDatabaseHas('banners', ["image" => "banners/{$file->hashName()}"]);
    }
}
