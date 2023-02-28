<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaVehicleType;
use App\Models\VehicleCategory;
use App\Models\VehicleType;
use App\Traits\CacheHelper;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class VehicleTypeController extends Controller
{
    use CacheHelper, FileHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'vehicle_type_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.vehicle_type.index');
    }

    public function create()
    {
        $areas = Area::all('id', 'name as text');
        $vehicleCategory = VehicleCategory::all('id', 'name as text');
        return view('admin.vehicle_type.create', compact('areas','vehicleCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = $request->except('areas');

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveFileAndGetName($request->file('image'));
        }

        $vehicleTypeData = VehicleType::create($data);

        $vehicleTypeData->areas()->createMany($request->get('areas') ?? []);

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.vehicle_type.index');
    }

    public function edit(VehicleType $vehicleType)
    {
        $areaItems = Area::all('id', 'name as text');
        $vehicleCategory = VehicleCategory::all('id', 'name as text');
        $vehicleType = VehicleType::with('areas')->findOrFail($vehicleType->id);
        return view('admin.vehicle_type.edit', compact('vehicleType', 'areaItems', 'vehicleCategory'));
    }

    public function update(Request $request, VehicleType $vehicle_type)
    {
        $vehicle_type->update($request->except('areas'));

        AreaVehicleType::where('vehicle_type_id', '=', $vehicle_type->id)->delete();

        $vehicle_type->areas()->createMany($request->get('areas') ?? []);

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('admin.vehicle_type.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("vehicle_types")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Vehicle Type Deleted successfully."]);
    }
}
