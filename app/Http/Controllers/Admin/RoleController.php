<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\CacheHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    use CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'role_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('label'));
        $role->permissions()->sync($request->get('permissions'));
        $this->rebuildCache('forever', Permission::with('roles')->get());
        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.role.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = tap(Role::find($id))->update($request->only('label'));
        $role->permissions()->sync($request->get('permissions'));
        $this->rebuildCache('forever', Permission::with('roles')->get());
        return redirect()->route('admin.role.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("roles")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }

}
