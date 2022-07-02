<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Champion;
use App\Models\Skin;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SkinController extends Controller
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
            'SkinController',
            'index',
            $page,
        ]));

        $list_skins = Cache::remember($key, 1, function () use ($limit, $status, $name) {
            $query = Skin::with('champion', 'type', 'category')->orderBy('id', 'desc')->paginate($limit);

            if ($status) {
                $query->where('status', $status);
            }

            if ($name) {
                $query->where('name', 'like', $name);
            }

            return $query;
        });

        return view('admin.skins.index')->with(['list_skins' => $list_skins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_champions = Champion::whereStatus(1)->get();
        $list_categories = Category::whereStatus(1)->get();
        $list_types = Type::whereStatus(1)->get();

        return view('admin.skins.create')->with(['list_champions' => $list_champions, 'list_categories' => $list_categories, 'list_types' => $list_types]);
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
            $skin = new Skin();
            $skin->name = $request->name;
            $skin->price = $request->price;
            $skin->description = $request->description;
            $skin->category_id = $request->category;
            $skin->type_id = $request->type;
            $skin->champion_id = $request->champion;


            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = strtolower(str_replace(' ', '', $request->name)) . '.' . $extension;
                $image = $request->file('image')->move('skins/', $filename);
                $path = env('APP_URL') . ':' . env('APP_PORT') . '/skins/' . $filename;
                $skin->image = $path;
            }
            if ($request->hasFile('big_image')) {
                $extension = $request->file('big_image')->getClientOriginalExtension();
                $filename = strtolower(str_replace(' ', '', $request->name)) . '_big.' . $extension;
                $image = $request->file('big_image')->move('skins/', $filename);
                $path = env('APP_URL') . ':' . env('APP_PORT') . '/skins/' . $filename;
                $skin->big_image = $path;
            }

            $skin->save();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return redirect()->route('skins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skin = Skin::findOrFail($id);
        $list_champions = Champion::whereStatus(1)->get();
        $list_categories = Category::whereStatus(1)->get();
        $list_types = Type::whereStatus(1)->get();

        return view('admin.skins.edit')->with(['skin' => $skin, 'list_champions' => $list_champions, 'list_categories' => $list_categories, 'list_types' => $list_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = true;
        try {
            $skin =  Skin::findOrFail($id);
            $skin->name = $request->name;
            $skin->price = $request->price;
            $skin->description = $request->description;
            $skin->category_id = $request->category;
            $skin->type_id = $request->type;
            $skin->champion_id = $request->champion;


            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = strtolower(str_replace(' ', '', $request->name)) . '.' . $extension;
                $image = $request->file('image')->move('skins/', $filename);
                $path = env('APP_URL') . ':' . env('APP_PORT') . '/skins/' . $filename;
                $skin->image = $path;
            }
            if ($request->hasFile('big_image')) {
                $extension = $request->file('big_image')->getClientOriginalExtension();
                $filename = strtolower(str_replace(' ', '', $request->name)) . '_big.' . $extension;
                $image = $request->file('image')->move('skins/', $filename);
                $path = env('APP_URL') . ':' . env('APP_PORT') . '/skins/' . $filename;
                $skin->big_image = $path;
            }

            $skin->save();
        } catch (Exception $e) {
            $msg = false;
        }
        return redirect()->route('skins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $skin = Skin::findOrFail($id);
            $skin->delete();
        } catch (Exception $e) {
        }
        return redirect()->route('skins.index');
    }

    public function changeStatus($id)
    {
        try {
            $skin = Skin::findOrFail($id);
            $skin->status = !$skin->status;
            $skin->save();
        } catch (Exception $e) {
        }

        return redirect()->route('skins.index');
    }
}
