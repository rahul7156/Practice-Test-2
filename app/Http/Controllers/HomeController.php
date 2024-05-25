<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $categories = Category::all();
        //$categories = Category::with('parent.parent.parent.parent')->get()->toArray();
        $categories = Category::with('childrenRecursive')->get();
        // echo "<pre>";
        // print_r($categories);
        // exit;
        return view('home', ["categories" => $categories]);
    }
}
