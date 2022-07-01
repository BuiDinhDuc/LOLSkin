<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Universe;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';
        $list_categories = Category::with('universe')->orderBy('id', 'desc')->paginate($limit);

        if ($status) {
            $list_categories->where('status', $status);
        }

        if ($name) {
            $list_categories->where('name', 'like', $name);
        }

        return view('admin.categories.index')->with(['list_categories' => $list_categories]);
    }

    public function create()
    {
        $list_universes = Universe::whereStatus(1)->get();
        return view('admin.categories.create')->with(['list_universes' => $list_universes]);
    }

    public function store(Request $request)
    {
        $msg = true;
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->universe_id = $request->universe;
            $category->save();
        } catch (Exception $e) {
            $msg = false;
        }
        $list_universes = Universe::whereStatus(1)->get();
        return view('admin.categories.create')->with(['msg' => $msg,'list_universes' => $list_universes]);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $list_universes = Universe::whereStatus(1)->get();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit')->with(['list_universes' => $list_universes,'category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
