<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Traits\CacheHelper;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    use FileHelper, CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'driver_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.driver.index');
    }

    public function create()
    {
        $vehicleTypes = VehicleType::all('id', 'name as text');
        return view('admin.driver.create', compact('vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required|unique:drivers,email',
            'phone'         =>  "required|min:15|unique:drivers,phone",
            'password'      =>  'required|min:8|confirmed',
            'cnic'          =>  'required|min:15|unique:drivers,cnic',
            'country_id'    =>  'required',
            'city_id'       =>  'required',
        ]);

        $vehicleData = $request->all();
        $vehicleData['vehicle_name'] = '0';
        $vehicleData['vehicle_image'] = $this->saveFileAndGetName($request->file('vehicle_image'));
        $vehicleData['cnic_front_image'] = $this->saveFileAndGetName($request->file('cnic_front_image'));
        $vehicleData['cnic_back_image'] = $this->saveFileAndGetName($request->file('cnic_back_image'));
        $vehicleData['license_front_image'] = $this->saveFileAndGetName($request->file('license_front_image'));
        $vehicleData['license_back_image'] = $this->saveFileAndGetName($request->file('license_back_image'));
        $vehicleData['vehicle_reg_image'] = $this->saveFileAndGetName($request->file('vehicle_reg_image'));
        $vehicleData['status'] = 1;

        $vehicle = Vehicle::create($vehicleData);

        $driverData = $request->all();
        $driverData['name'] = "{$driverData['first_name']} {$driverData['last_name']}";
        $driverData['password'] = bcrypt($driverData['password']);
        $driverData['picture'] = $this->saveFileAndGetName($request->file('picture'));
        $driverData['status'] = 1;
        $driverData['vehicle_id'] = $vehicle->id;

        Driver::create($driverData);

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.driver.index');
    }

    public function edit(Driver $driver)
    {
        $vehicleTypes = VehicleType::all('id','name as text');
        $vehicle = Vehicle::findOrFail($driver->vehicle_id);
        $driver = $driver->toArray();
        $driver['firstName'] = explode(' ', $driver['name'])[0] ?? '';
        $driver['lastName'] = explode(' ', $driver['name'])[1] ?? '';
        $driver = collect($driver);
        return view('admin.driver.edit', compact('driver', 'vehicle', 'vehicleTypes'));
    }

    public function update(Request $request, Driver $driver)
    {
        $vehicleData = [
            'vehicle_name' => $request->get('vehicle_name'),
            'vehicle_cc' => $request->get('vehicle_cc'),
            'vehicle_no' => $request->get('vehicle_no'),
            'license_no' => $request->get('license_no'),
            'vehicle_type_id' => $request->get('vehicle_type_id'),
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'year' => $request->get('year'),
            'color' => $request->get('color'),
            'vehicle_image' => $request->hasFile('vehicle_image')
                ? $this->updateFileAndGetName($request->file('vehicle_image'), $driver->vehicle->vehicle_image)
                : $driver->vehicle->vehicle_image,
            'cnic_front_image' => $request->hasFile('cnic_front_image')
                ? $this->updateFileAndGetName($request->file('cnic_front_image'), $driver->vehicle->cnic_front_image)
                : $driver->vehicle->cnic_front_image,
            'cnic_back_image' => $request->hasFile('cnic_back_image')
                ? $this->updateFileAndGetName($request->file('cnic_back_image'), $driver->vehicle->cnic_back_image)
                : $driver->vehicle->cnic_back_image,
            'license_front_image' => $request->hasFile('license_front_image')
                ? $this->updateFileAndGetName($request->file('license_front_image'), $driver->vehicle->license_front_image)
                : $driver->vehicle->license_front_image,
            'license_back_image' => $request->hasFile('license_back_image')
                ? $this->updateFileAndGetName($request->file('license_back_image'), $driver->vehicle->license_back_image)
                : $driver->vehicle->license_back_image,
            'vehicle_reg_image' => $request->hasFile('vehicle_reg_image')
                ? $this->updateFileAndGetName($request->file('vehicle_reg_image'), $driver->vehicle->vehicle_reg_image)
                : $driver->vehicle->vehicle_reg_image,
            'status'    => 1
        ];

       $driver->vehicle->update($vehicleData);

        $driverData = $request->all();
        if ($request->has('password')) {
            $driverData['password'] = bcrypt($request->get('password'));
        }

        if ($request->hasFile('picture')) {
            $driverData['picture'] = $this->updateFileAndGetName($request->file('picture'), $driver->picture);
        }

        $driverData['name'] = "{$driverData['first_name']} {$driverData['last_name']}";
        $driver->update($driverData);

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('admin.driver.index');

    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("drivers")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }
}
