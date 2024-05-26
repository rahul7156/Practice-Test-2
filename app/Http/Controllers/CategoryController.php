<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
        $all_parent_categories = Category::with('childrenRecursive')->get()->toArray();

        foreach ($all_parent_categories as $key => $category) {
            $children_recursive_name = $this->nestedList($category);
            $children_recursive_name_arr = explode(" > ", $children_recursive_name);
            krsort($children_recursive_name_arr);
            $children_recursive_name_str = implode(" > ", array_filter($children_recursive_name_arr));
            $all_parent_categories[$key]['children_recursive_name'] = $children_recursive_name_str;
        }
        return view("add-category", ['all_parent_categories' => $all_parent_categories]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $category = new Category($data);
        $category->save();
        return redirect()->route('home');
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

    public function edit($id)
    {
        $edit_category = Category::findOrFail($id)->toArray();
        $all_parent_categories = Category::with('childrenRecursive')->where('category_id', '!=', $id)->get()->toArray();
        foreach ($all_parent_categories as $key => $category) {
            $children_recursive_name = $this->nestedList($category);
            $children_recursive_name_arr = explode(" > ", $children_recursive_name);
            krsort($children_recursive_name_arr);
            $children_recursive_name_str = implode(" > ", array_filter($children_recursive_name_arr));
            $all_parent_categories[$key]['children_recursive_name'] = $children_recursive_name_str;
        }
        return view("edit-category", ['edit_category' => $edit_category, 'all_parent_categories' => $all_parent_categories]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $id = $request['category_id'];
        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();
        return redirect()->route('home');
    }
}
