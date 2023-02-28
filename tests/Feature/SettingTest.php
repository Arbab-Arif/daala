<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_setting()
    {
        Storage::fake('public')->append('settings.json', '{}');

        config()->set(
            'settings.drivers.json.options.path',
            storage_path('framework/testing/disks/public/settings.json')
        );
        $this->adminSignIn()
            ->post('/admin/setting', [
                'logo' => $file = UploadedFile::fake()->image('testing.jpg'),
                'contact_no' => '0987654',
                'facebook' => 'facebook',
                'google_add' => 'google',
                'company_name' => 'Company Name',
                'address' => 'Address',
                'email' => 'arbabarif621@gmail.com',

            ]);

        $this->assertEquals("settings/{$file->hashName()}", settings()->get('logo'));
        $this->assertEquals('0987654', settings()->get('contact_no'));
        $this->assertEquals('facebook', settings()->get('facebook'));
        $this->assertEquals('google', settings()->get('google_add'));
        $this->assertEquals('Company Name', settings()->get('company_name'));
        $this->assertEquals('Address', settings()->get('address'));
        $this->assertEquals('arbabarif621@gmail.com', settings()->get('email'));

        File::cleanDirectory(storage_path('framework/testing/disks'));
    }
}
