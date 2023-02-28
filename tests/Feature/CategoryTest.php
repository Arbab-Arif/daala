<?php

namespace Tests\Feature;

use App\Http\Livewire\Categories;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_admin_create_category()
    {
        $this->adminSignIn()
            ->post('/admin/category', [
                'name' => 'user',
            ])
            ->assertRedirect('/admin/category');

        $this->assertDatabaseHas('categories', ['name' => 'user']);
    }

    /** @test */
    function it_can_admin_update_category()
    {
        $this->adminSignIn();
        $category = Category::factory()->create();
        $this->assertDatabaseHas('categories', ['name' => $category->name]);
        $this->put("admin/category/{$category->id}", [
            'name' => 'category',
        ])
            ->assertRedirect('/admin/category');
        $this->assertDatabaseMissing('categories', ['name' => $category->name]);
        $this->assertDatabaseHas('categories', ['name' => 'category']);
    }

    /** @test */
    function it_admin_can_delete_category()
    {
        $category = Category::factory()->create();

        $this->assertDatabaseHas('categories', [ 'name' => $category->name ]);

        Livewire::test(Categories::class)
            ->call('deleteCategory', $category->id);

        $this->assertDatabaseMissing('categories', [ 'name' => $category->name]);
    }

    /** @test */
    function it_throw_validation_exception_when_validation_fails()
    {
        $this->expectException(ValidationException::class);
        $this->adminSignIn()->post('/admin/category');
    }
}
