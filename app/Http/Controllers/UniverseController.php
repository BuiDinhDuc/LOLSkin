<?php

namespace App\Http\Controllers;

use App\Models\Universe;
use Exception;
use Illuminate\Http\Request;

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
        $list_universes = Universe::orderBy('id', 'desc')->paginate($limit);

        if ($status) {
            $list_universes->where('status', $status);
        }

        if ($name) {
            $list_universes->where('name', 'like', $name);
        }

        return view('admin.universes.index')->with(['list_universes' => $list_universes]);
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


        return view('admin.universes.create')->with(['msg' => $msg]);
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

        return $this->edit($id);
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
        return $this->index($request);
    }
}
