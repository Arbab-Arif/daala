<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    use FileHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'slider_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderRequest $request)
    {
        $slider = $request->all();
        $slider['image'] = $this->saveFileAndGetName($request->file('image'));
        Slider::create($slider);
        return redirect()->route('admin.slider.index');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $sliderData = $request->all();

        if ($request->hasFile('image')) {
            $sliderData['image'] = $this->updateFileAndGetName($request->file('image'), $slider->image);
        }

        $slider->update($sliderData);
        return redirect()->route('admin.slider.index');

    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("sliders")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }
}
