<?php

namespace Tests\Feature;

use App\Http\Livewire\PageList;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StaticPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function it_redirect_unauthorized_user()
    {
        $this->withExceptionHandling()
            ->get('/admin/page')
            ->assertRedirect('/admin/login');
    }

    /** @test */

    function it_authenticated_user_can_create_page()
    {
        $this->adminSignIn()
            ->post('/admin/page', [
                'title' =>  'about',
                'slug'  =>  'about',
                'type'  =>  'footer',
                'content'   =>  'content'
            ])
            ->assertRedirect('/admin/page');

        $this->assertDatabaseHas('pages', ['title' => 'about']);
    }

    /** @test */
    function it_authenticated_user_can_update_page()
    {
        $this->adminSignIn();
        $page = Page::factory()->create();
        $this->assertDatabaseHas('pages', ['title' => $page->title]);
        $this->put("admin/page/{$page->id}", [
            'title' =>  'about us',
            'slug'  =>  'about-us',
            'type'  =>  'footer',
            'content'   =>  'content-2'
        ])
            ->assertRedirect('/admin/page');
        $this->assertDatabaseMissing('pages', ['title' => $page->title]);
        $this->assertDatabaseHas('pages', ['title' => 'about us']);
    }

    /** @test */
    function it_authenticated_user_can_delete_page()
    {
        $page = Page::factory()->create();

        $this->assertDatabaseHas('pages', [ 'title' => $page->title ]);

        Livewire::test(PageList::class)
            ->call('deletePage', $page->id);

        $this->assertDatabaseMissing('pages', [ 'title' => $page->title]);
    }

}
