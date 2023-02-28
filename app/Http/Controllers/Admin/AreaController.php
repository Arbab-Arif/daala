<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function index()
    {
        return view('admin.area.index');
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request['bounds'] = json_encode($request->get('bounds'));
        Area::create($request->all());
    }

    public function edit(Area $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $area->update($request->all());
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("areas")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }
}
