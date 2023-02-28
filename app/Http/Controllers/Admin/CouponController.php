<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Coupon::create($data);
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Coupon $coupon, Request $request)
    {
        $data = $request->all();
        $coupon->update($data);
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("coupons")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Coupons Deleted successfully."]);
    }
}
