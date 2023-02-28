<?php


namespace App\Http\Controllers\Admin;


use App\Exports\JobExport;
use App\Http\Controllers\Controller;
use App\Traits\CacheHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserRequestController extends Controller
{
    use CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'user_request_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.user_request.index');
    }

    public function export(Request $request)
    {
        return Excel::download(new JobExport($request), 'jobs.xlsx');

    }
}
