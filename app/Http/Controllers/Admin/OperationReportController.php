<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationReportController extends Controller
{
    public function index()
    {
        $status = null;
        if (request('status') !== '') {
            $status = \request('status');
        }
        return view('admin.reports.operation.index', compact('status'));
    }
}
