<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TypeController extends Controller
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
            'TypeController',
            'index',
            $page,
        ]));

        $list_types = Cache::remember($key, 1, function () use ($limit, $status, $name) {
        $query = Type::orderBy('id', 'desc')->paginate($limit);

        if ($status) {
            $query->where('status', $status);
        }

        if ($name) {
            $query->where('name', 'like', $name);
        }

        return $query;
    });

        return view('admin.types.index')->with(['list_types' => $list_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');

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
            $type = new Type();
            $type->name = $request->name;
            $type->description = $request->description;
            $type->save();
        } catch (Exception $e) {
            $msg = false;
        }
        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type =  Type::findOrFail($id);

        return view('admin.types.edit')->with(['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = true;
        try {
            $type =  Type::findOrFail($id);
            $type->name = $request->name;
            $type->description = $request->description;
            $type->save();
        } catch (Exception $e) {
            $msg = false;
        }

        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $type = Type::findOrFail($id);
            $type->delete();
        } catch (Exception $e) {
        }
        return redirect()->route('types.index');
    }
    public function changeStatus($id)
    {
        try {
            $type = Type::findOrFail($id);
            $type->status = !$type->status;
            $type->save();
        } catch (Exception $e) {
        }
        return redirect()->route('types.index');
    }
}
