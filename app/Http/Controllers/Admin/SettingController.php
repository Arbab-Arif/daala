<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\CacheHelper;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    use FileHelper, CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'setting_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function create()
    {
        return view('admin.setting.create')
            ->with([
                'setting' => collect([
                    'logo' => settings()->get('logo'),
                    'contact_no' => settings()->get('contact_no'),
                    'facebook' => settings()->get('facebook'),
                    'google_add' => settings()->get('google_add'),
                    'company_name' => settings()->get('company_name'),
                    'address' => settings()->get('address'),
                    'email' => settings()->get('email'),
                    'labour_charges' => settings()->get('labour_charges'),
                ])

            ]);
    }

    public function store(Request $request)
    {
        $logo = '';
        if ($request->hasFile('logo'))
            $logo = $this->saveFileAndGetName($request->file('logo'));

        settings()
            ->set('contact_no', $request->get('contact_no'))
            ->set('facebook', $request->get('facebook'))
            ->set('google_add', $request->get('google_add'))
            ->set('company_name', $request->get('company_name'))
            ->set('address', $request->get('address'))
            ->set('email', $request->get('email'))
            ->set('labour_charges', $request->get('labour_charges'))
            ->save();

        if ($logo !== '') {
            settings()
                ->set('logo', $logo)->save();
        }

        if ($request->wantsJson()) {
            return new Response('', 201);
        }

        return back();
    }
}
