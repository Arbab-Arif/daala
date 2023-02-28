<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleCategoryRequest;
use App\Models\VehicleCategory;
use App\Traits\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleCategoryController extends Controller
{
    use FileHelper;

    public function store(VehicleCategoryRequest $request)
    {

        $categoryData = $request->all();
        if ($request->hasFile('image')) {
            $categoryData['image'] = $this->saveFileAndGetName($request->file('image'));
        }
        $category = VehicleCategory::create($categoryData);

        return $request->wantsJson()
            ? new Response($category->toJson(), 201)
            : redirect()->route('admin.category.index');
    }
}
