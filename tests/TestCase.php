<?php

namespace Tests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function setUp(): void
    {
        parent::setUp();

        DB::statement('PRAGMA foreign_keys=on;');

        $this->withoutExceptionHandling();
        Storage::fake('public');

    }

    protected function adminSignIn($user = null)
    {
        $user = $user ?: Admin::first();

        $this->actingAs($user, 'admin');

        return $this;
    }

    protected function signIn($user = null)
    {
        $user = $user ?: User::first();

        $this->actingAs($user);

        return $this;
    }
}
