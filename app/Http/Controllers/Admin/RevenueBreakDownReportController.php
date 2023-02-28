<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevenueBreakDownReportController extends Controller
{
    public function index()
    {
        $vehicleTypeId = null;
        if (request('vehicle_type') !== '') {
            $vehicleTypeId = \request('vehicle_type');
        }
        return view('admin.reports.revenue-break-down.index', compact('vehicleTypeId'));
    }
}
