<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Universe;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UniverseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'UniverseController',
            'index',
            $page,
        ]));

        $list_universes = Cache::remember($key, 1, function () use ($limit, $status, $name) {

            $query = Universe::orderBy('id', 'desc')->paginate($limit);

            if ($status) {
                $query->where('status', $status);
            }

            if ($name) {
                $query->where('name', 'like', $name);
            }

            return $query;
        });

        return view('admin.universes.index', ['list_universes' => $list_universes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.universes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = true;
        try {
            $universe = new Universe();
            $universe->name = $request->name;
            $universe->description = $request->description;
            $universe->save();
        } catch (Exception $e) {
            $msg = false;
        }
        return redirect()->route('universes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Universe  $universe
     * @return \Illuminate\Http\Response
     */
    public function show(Universe $universe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Universe  $universe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $universe =  Universe::findOrFail($id);

        return view('admin.universes.edit')->with(['universe' => $universe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Universe  $universe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $msg = true;
        try {
            $universe =  Universe::findOrFail($id);
            $universe->name = $request->name;
            $universe->description = $request->description;
            $universe->save();
        } catch (Exception $e) {
            $msg = false;
        }

        return redirect()->route('universes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Universe  $universe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $universe = Universe::findOrFail($id);
            $universe->delete();
        } catch (Exception $e) {
        }
        return redirect()->route('universes.index');
    }

    public function changeStatus($id)
    {
        try {
            $universe = Universe::findOrFail($id);
            $universe->status = !$universe->status;
            $universe->save();
        } catch (Exception $e) {
        }
        return redirect()->route('universes.index');
    }

    public function getListUniverses(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'UniverseController',
            'getListUniverses',
            $page,
        ]));

        $list_universes = Cache::remember($key, 1, function () use ($limit) {

            $query = Universe::orderBy('name', 'asc')->paginate($limit);
            $query->where('status', 1);
            // if ($name) {
            //     $query->where('name', 'like', $name);
            // }
            return $query;
        });

        return view('user.universes.index', ['list_universes' => $list_universes]);
    }

    public function getListCategoriesOfUniverse(Request $request,$id)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'UniverseController',
            'getListCategoriesOfUniverse',
            $page,
        ]));

        $list_categories = Cache::remember($key, 1, function () use ($limit,$id) {

            $query = Category::where('universe_id', $id)->orderBy('name', 'desc')->paginate($limit);

            $query->where('status', 1);
            // if ($name) {
            //     $query->where('name', 'like', $name);
            // }
            return $query;
        });

        return view('user.universes.detail', ['list_categories' => $list_categories]);
    }
}
