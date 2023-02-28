<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Traits\CacheHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\FileHelper;

class VehicleController extends Controller
{
    use FileHelper, CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'vehicle_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.vehicle.index');
    }

    public function create()
    {
       $vehicleType = VehicleType::all('id','name as text');
        return view('admin.vehicle.create',compact('vehicleType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_name'      => 'required',
            'vehicle_type_id'      => 'required',
            'vehicle_cc'        => 'required',
            'vehicle_no'        => 'required|unique:vehicles,vehicle_no',
            'license_no'        => 'required|unique:vehicles,license_no',
            'make'              => 'required',
            'model'             => 'required',
            'year'              => 'required',
            'color'             => 'required',
            'icon'              => 'required|mimes:jpg,jpeg,png|max:5000',
        ]);
        $vehicleData = $request->all();
        $vehicleData['icon'] = $this->saveFileAndGetName($request->file('icon'));
        $vehicleData['status'] = 1;

        Vehicle::create($vehicleData);

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.vehicle.index');
    }

    public function edit(Vehicle $vehicle)
    {
        $vehicleType = VehicleType::all('id','name as text');
        return view('admin.vehicle.edit', compact('vehicle','vehicleType'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicleData = $request->all();

        if ($request->hasFile('icon')) {
            $vehicleData['icon'] = $this->updateFileAndGetName($request->file('icon'), $vehicle->icon);
        }

        $vehicle->update($vehicleData);

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('admin.vehicle.index');
    }
}
