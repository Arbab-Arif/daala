<?php

namespace App\Http\Controllers;

use App\Models\Slider;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        return view('index')
            ->with([
                'sliders' => Slider::all()
            ]);
    }
}
