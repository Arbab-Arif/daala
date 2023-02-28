<?php

namespace Tests\Feature;

use App\Http\Livewire\SliderList;
use App\Models\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class SliderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/slider')
            ->assertRedirect('/admin/login');
    }

    /** @test */

    function it_authenticated_user_can_create_slider()
    {
        $this->adminSignIn()
            ->post('/admin/slider', [
                'image' =>  $file = UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertRedirect('/admin/slider');

        Storage::disk('public')->assertExists([
            "sliders/{$file->hashName()}"
        ]);

        $this->assertDatabaseHas('sliders', ["image" => "sliders/{$file->hashName()}"]);
    }

    /** @test  */

    function it_authenticated_user_can_update_slider()
    {
        $this->adminSignIn();
        $prevFile = UploadedFile::fake()->image('some.jpg')->store('sliders');
        $sliders = Slider::factory()->create(['image' => $prevFile]);
        $this->assertDatabaseHas('sliders', [ 'image' => $sliders->image ]);
        Storage::disk('public')->assertExists([$prevFile]);
        $this->put("admin/slider/{$sliders->id}", [
            'image' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ])->assertRedirect('/admin/slider');

        Storage::disk('public')->assertExists(["sliders/{$file->hashName()}"]);
        Storage::disk('public')->assertMissing([$prevFile]);
        $this->assertDatabaseMissing('sliders', [ 'image' => $sliders->image ]);
        $this->assertDatabaseHas('sliders', [ 'image' => "sliders/{$file->hashName()}" ]);
    }

    /** @test */
    function it_authenticated_admin_delete_slider()
    {
        $slider = Slider::factory()->create();

        $this->assertDatabaseHas('sliders', ['image' => $slider->image]);

        Livewire::test(SliderList::class)
            ->call('deleteSlider', $slider->id);
        $this->assertDatabaseMissing('sliders', ['image' => $slider->image]);

    }


}
