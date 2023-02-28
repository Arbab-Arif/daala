<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use FileHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'banner_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function create()
    {
        $banners = Banner::all();
        return view('admin.banner.create', compact('banners'));
    }

    public function update(Request $request)
    {
        $banner = Banner::all()->count();

        if($banner == 0){
            $bannerData = $request->all();
            if ($request->hasFile('image')) {
                $bannerData['image'] = $this->saveFileAndGetName($request->file('image'));
            }
            Banner::create($bannerData);
            return redirect()->route('admin.banner.create');
        }

        $bannerExists = Banner::find($banner);

        if(!empty($bannerExists)){
            $bannerData = $request->all();
            if ($request->hasFile('image')) {
                $bannerData['image'] = $this->updateFileAndGetName($request->file('image'), $bannerExists->image);
            }
            $bannerExists->update($bannerData);
            return redirect()->route('admin.banner.create');
        }
    }
}
