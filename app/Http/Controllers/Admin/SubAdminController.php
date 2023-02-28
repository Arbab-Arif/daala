<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\CacheHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SubAdminController extends Controller
{
    use CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'admin_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }
    public function index()
    {
        return view('admin.sub_admin.index');
    }

    public function create()
    {
        $roles = Role::all('id', 'label as text');
        return view('admin.sub_admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $subAdminData = $request->except('role_id');
        $subAdminData['password'] = bcrypt($subAdminData['password']);

        $admin = Admin::create($subAdminData);
        $admin->roles()->sync($request->get('role_id'));
        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.sub_admin.index');
    }

    public function edit(Admin $sub_admin)
    {
        $roles = Role::all('id', 'label as text');
        $subAdminData = Admin::with('roles')->findOrFail($sub_admin->id);
        return view('admin.sub_admin.edit', compact('subAdminData', 'roles'));
    }

    public function update(Request $request, Admin $sub_admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|unique:admins,email,{$sub_admin->id}",
            'password' => 'confirmed',
        ]);

        $subAdminData = $request->all();
        if ($request->has('password')) {
            $subAdminData['password'] = bcrypt($request->get('password'));
        }

        $admin = tap(Admin::find($sub_admin->id))->update($subAdminData);

        $admin->roles()->sync($request->get('role_id'));

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('admin.sub_admin.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("admins")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }

}
