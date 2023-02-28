<?php


namespace App\Http\Controllers\Admin;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\CacheHelper;
use App\Traits\FileHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{

    use FileHelper, CacheHelper;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            try {
                $this->authorizeForUser(auth()->user(), 'customer_management');
            } catch (AuthorizationException $e) {
                abort(401);
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.customer.index');
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users,email',
            'phone'      => "required|min:15s|unique:users,phone",
            'password'   => 'required|min:8|confirmed',
        ]);


        $customerData = $request->all();
        $customerData['customer_type'] = 0;
        $customerData['name'] = "{$customerData['first_name']} {$customerData['last_name']}";
        $customerData['password'] = bcrypt($customerData['password']);
        $customerData['picture'] = $this->saveFileAndGetName($request->file('picture'));

        $customerData['status'] = 1;
        User::create($customerData);
        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->route('admin.customer.index');
    }

    public function edit(User $customer)
    {
        $customer = $customer->toArray();
        $customer['firstName'] = explode(' ', $customer['name'])[0];
        $customer['lastName'] = explode(' ', $customer['name'])[1] ?? '';
        $customer = collect($customer);
        return view('admin.customer.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $customerData = $request->all();
        if ($request->has('password')) {
            unset($customerData['password']);
        }

        if ($request->hasFile('picture')) {
            $customerData['picture'] = $this->updateFileAndGetName($request->file('picture'), $customer->picture);
        }

        $customerData['name'] = "{$customerData['first_name']} {$customerData['last_name']}";

        $customer->update($customerData);

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('admin.customer.index');

    }

    public function export(Request $request)
    {
        return Excel::download(new CustomerExport($request), 'customer.xlsx');

    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("users")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"driver Deleted successfully."]);
    }

}
