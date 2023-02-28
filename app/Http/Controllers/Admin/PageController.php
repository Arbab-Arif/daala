<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.page.index');
    }
    public function create()
    {
        $pages = Page::whereType(Page::FOOTER)->where('parent_id', 0)->get(['id', 'title as text']);
        return view('admin.page.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $page = $request->all();
        $page['slug'] = Str::slug($request->get('title'));
        Page::create($page);
        return redirect()->route('admin.page.index');
    }

    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $pages = $request->all();
        $pages['slug'] = Str::slug($request->get('title'));
        $page->update($pages);
        return redirect()->route('admin.page.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("pages")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }
}
