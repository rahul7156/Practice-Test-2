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
        $categories = Category::with('childrenRecursive')->get()->toArray();
        foreach ($categories as $key => $category) {
            $children_recursive_name = $this->nestedList($category);
            $children_recursive_name_arr = explode(" > ", $children_recursive_name);
            sort($children_recursive_name_arr);
            $children_recursive_name_str = implode(" > ", array_filter($children_recursive_name_arr));
            $categories[$key]['children_recursive_name'] = $children_recursive_name_str;
        }
        return view('home', ["categories" => $categories]);
    }

    public function nestedList(array $category)
    {
        $r = '';
        foreach ($category as $key => $value) {
            if (is_array($value)) {
                $r .= $this->nestedList($value);
                continue;
            } else {
                if ($key == "name") {
                    $r .= $value . " > ";
                }
            }
        }
        return $r;
    }
}
