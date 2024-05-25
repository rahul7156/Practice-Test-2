<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
        //$all_parent_categories = Category::all();
        $all_parent_categories = Category::with('parent')->get();
        // echo "<pre>";
        // print_r($all_categories);
        // exit;
        return view("add-category", ['all_parent_categories' => $all_parent_categories]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $category = new Category($data);
        $category->save();
        return redirect()->route('home');
    }
}
