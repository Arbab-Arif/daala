<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'contact' => 'required|min:11|max:14',
            'message' => 'required',
        ]);
        ContactUs::create($request->all());
        return back()->with('success', 'Thanks for getting in touch! Expect an answer from us very soon.');
    }
}
