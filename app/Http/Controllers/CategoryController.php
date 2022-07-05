<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Skin;
use App\Models\Universe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'CategoryController',
            'index',
            $page,
        ]));

        $list_categories = Cache::remember($key, 1, function () use ($limit, $status, $name) {
        $query = Category::with('universe')->orderBy('id', 'desc')->paginate($limit);

        if ($status) {
            $query->where('status', $status);
        }

        if ($name) {
            $query->where('name', 'like', $name);
        }
        return $query;
    });

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
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $list_universes = Universe::whereStatus(1)->get();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit')->with(['list_universes' => $list_universes,'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $msg = true;
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->universe_id = $request->universe;
            $category->save();
        } catch (Exception $e) {
            $msg = false;
        }
        return redirect()->route('categories.index');
    }

    public function destroy(Request $request,$id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
        } catch (Exception $e) {
        }
        return redirect()->route('categories.index');
    }
    public function changeStatus($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->status = !$category->status;
            $category->save();
        } catch (Exception $e) {
        }
        return redirect()->route('categories.index');
    }

    public function getListCategories(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'CategoryController',
            'getListCategories',
            $page,
        ]));

        $list_categories = Cache::remember($key, 1, function () use ($limit) {

            $query = Category::orderBy('name', 'asc')->paginate($limit);
            $query->where('status', 1);
            // if ($name) {
            //     $query->where('name', 'like', $name);
            // }
            return $query;
        });

        return view('user.categories.index', ['list_categories' => $list_categories]);
    }

    public function getListSkinsOfCategory(Request $request,$id)
    {
        $limit = $request->limit ?? 12;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'CategoryController',
            'getCategory',
            $page,
        ]));

        $key1 = md5(vsprintf('%s.%s.%s', [
            'CategoryController',
            'getListSkinsOfCategory',
            $page,
        ]));

        $category = Cache::remember($key1, 1, function () use ($id) {

            $query = Category::findOrFail($id);

            return $query;
        });

        $list_skins = Cache::remember($key, 1, function () use ($limit,$id) {

            $query = Skin::where('category_id', $id)->orderBy('name', 'desc')->paginate($limit);

            $query->where('status', 1);
            // if ($name) {
            //     $query->where('name', 'like', $name);
            // }
            return $query;
        });
        return view('user.categories.detail') ->with(['list_skins' => $list_skins,'category' => $category]);
    }
}
