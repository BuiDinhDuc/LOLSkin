<?php

namespace App\Http\Controllers;

use App\Models\Champion;
use App\Models\Skin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChampionController extends Controller
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
            'ChampionController',
            'index',
            $page,
        ]));

        $list_champions = Cache::remember($key, 1, function () use ($limit, $status, $name) {
            $query = Champion::orderBy('id', 'desc')->paginate($limit);

            if ($status) {
                $query->where('status', $status);
            }

            if ($name) {
                $query->where('name', 'like', $name);
            }
            return $query;
        });

        return view('admin.champions.index')->with(['list_champions' => $list_champions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.champions.create');
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
            $champion = new Champion();
            $champion->name = $request->name;
            $champion->price = $request->price;

            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = strtolower(str_replace(' ', '', $request->name)) . '.' . $extension;
                $image = $request->file('image')->move('champions/', $filename);
                $path = env('APP_URL') . ':' . env('APP_PORT') . '/champions/' . $filename;
                $champion->image = $path;
            }

            $champion->save();
        } catch (Exception $e) {
            $msg = false;
        }
        return redirect()->route('champions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Champion  $champion
     * @return \Illuminate\Http\Response
     */
    public function show(Champion $champion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Champion  $champion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $champion =  Champion::findOrFail($id);
        return view('admin.champions.edit')->with(['champion' => $champion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Champion  $champion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = true;
        try {
            $champion =  Champion::findOrFail($id);
            $champion->name = $request->name;
            $champion->price = $request->price;

            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = strtolower(str_replace(' ', '', $request->name)) . '.' . $extension;
                $image = $request->file('image')->move('champions/', $filename);
                $path = env('APP_URL') . ':' . env('APP_PORT') . '/champions/' . $filename;
                $champion->image = $path;
            }

            $champion->save();
        } catch (Exception $e) {
            $msg = false;
        }
        return redirect()->route('champions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Champion  $champion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $champion = Champion::findOrFail($id);
            $champion->delete();
        } catch (Exception $e) {
        }
        return redirect()->route('champions.index');
    }

    public function changeStatus($id)
    {
        try {
            $champion = Champion::findOrFail($id);
            $champion->status = !$champion->status;
            $champion->save();
        } catch (Exception $e) {
        }
        return redirect()->route('champions.index');
    }

    public function getListChampions(Request $request)
    {
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'ChampionController',
            'getListChampions',
            $page,
        ]));

        $list_champions = Cache::remember($key, 1, function () {

            $query = Champion::where('status', 1)->orderBy('name', 'asc')->get();

            return $query;
        });

        return view('user.champions.index', ['list_champions' => $list_champions]);
    }

    public function getListSkinsOfChampion(Request $request,$id)
    {
        $limit = $request->limit ?? 12;
        $page = $request->page ?? 1;
        $name = $request->name ?? '';
        $status = $request->status ?? '';

        $key = md5(vsprintf('%s.%s.%s', [
            'ChampionController',
            'getChampion',
            $page,
        ]));

        $key1 = md5(vsprintf('%s.%s.%s', [
            'ChampionController',
            'getListSkinsOfChampion',
            $page,
        ]));

        $champion = Cache::remember($key1, 1, function () use ($id) {

            $query = Champion::findOrFail($id);

            return $query;
        });

        $list_skins = Cache::remember($key, 1, function () use ($limit,$id) {

            $query = Skin::where('champion_id', $id)->orderBy('name', 'desc')->paginate($limit);

            $query->where('status', 1);
            // if ($name) {
            //     $query->where('name', 'like', $name);
            // }
            return $query;
        });
        return view('user.champions.detail') ->with(['list_skins' => $list_skins,'champion' => $champion]);
    }
}
