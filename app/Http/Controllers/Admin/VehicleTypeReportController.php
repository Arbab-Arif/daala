<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleTypeReportController extends Controller
{
    public function index()
    {
        return view('admin.vehicle_type.report.index');
    }
}
