<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Sizechart;
use App\Traits\CacheHelper;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    use FileHelper, CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'item_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.item.index');
    }

    public function create()
    {
        $category = Category::all('id', 'name as text');
        return view('admin.item.create', compact('category'));
    }

    public function store(Request $request)
    {
        $itemData = Item::create($request->except('sizeChart'));
        $itemData->sizeChart()->createMany($request->sizeChart);

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.item.index');
    }

    public function edit(Item $item)
    {
        $itemData = Item::with('sizeChart')->findOrFail($item->id);
        $category = Category::all('id', 'name as text');
        return view('admin.item.edit', compact('itemData', 'category'));
    }

    public function update(Request $request, Item $item)
    {
        $item->update($request->except('size_chart'));
        Sizechart::where('item_id', '=', $item->id)->delete();
        $item->sizeChart()->createMany($request->size_chart);

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.item.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("items")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Items Deleted successfully."]);
    }

}
