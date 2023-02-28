<?php

namespace Tests\Feature;

use App\Http\Livewire\items;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/item')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function it_can_admin_create_item()
    {
        $this->adminSignIn()
            ->post('/admin/item', [
                'category_id' => 1,
                'name' => 'item',
                'unit' => 10,
                'description' => 'demo',
                'sizeChart' => [
                    [
                        'weight' => 1,
                        'width' => 3,
                        'height' => 33,
                        'breath'   => 90
                    ],
                    [
                        'weight' => 1,
                        'width' => 3,
                        'height' => 33,
                        'breath'   => 90
                    ],
                ]
            ])
            ->assertRedirect('/admin/item');

        $item = Item::first();
        $this->assertCount(2, $item->sizeChart);
        $this->assertDatabaseHas('items', ['name' => 'item']);

    }

    /** @test */
    function it_can_admin_update_item()
    {
        $this->adminSignIn();

        $item = Item::factory()->create(['name' => 'item']);
        $this->assertDatabaseHas('items', ['name' => $item->name]);

        $this->put("admin/item/{$item->id}", [
            'category_id' => 1,
            'name' => 'name',
            'unit' => 10,
            'description' => 'demo',
            'size_chart' => [
                [
                    'weight' => 1,
                    'width' => 3,
                    'height' => 33,
                    'breath'   => 90
                ],
            ]
        ])->assertRedirect('/admin/item');

        $item = Item::first();

        $this->assertCount(1, $item->sizeChart);
        $this->assertDatabaseMissing('items', ['name' => 'item']);
        $this->assertDatabaseHas('items', ['name' => 'name']);

    }

    /** @test */
    function it_can_admin_delete_item()
    {
        $item = Item::factory()->create();

        $this->assertDatabaseHas('items', ['name' => $item->name]);

        Livewire::test(Items::class)
            ->call('deleteItem', $item->id);
        $this->assertDatabaseMissing('items', ['name' => $item->name]);

    }
}
