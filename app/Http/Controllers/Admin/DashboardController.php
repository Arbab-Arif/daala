<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use App\Models\UserRequest;
use App\Models\VehicleType;

class DashboardController extends Controller
{
    public function index()
    {
////        $ve = VehicleType::with('vehicles')->get();
//        dd($ve);
        return view('admin.dashboard')->with([
            'totalJobs'     => UserRequest::all(),
            'canceledJobs'  => UserRequest::whereStatus('CANCELED')->get(),
            'scheduledJobs' => UserRequest::whereStatus('SCHEDULED')->get(),
            'ongoingJobs'   => UserRequest::whereStatus('ONGOING')->get(),
            'completeJobs'  => UserRequest::whereStatus('COMPLETED')->get(),
            'vehicleTypes'  => VehicleType::with('vehicles')->get(),
            'customerCount' => User::count(),
            'driverCount'   => Driver::count(),
        ]);
    }
}
