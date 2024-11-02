<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dogsData = Dogs::query()->get();
        return view("dogs/index", [
            "dogs" => $dogsData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dogs/form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        // Jika data tidak sesuai kriteria validasi
        if (!$data) {
            Session::flash('message', 'Data anjing tidak berhasil ditambahkan !');
            Session::flash('alert-class', 'danger');
            return redirect()->route('dogs.index');
        }

        Dogs::create([
            'name' => $request->name,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Session::flash('message','Data anjing berhasil ditambahkan !');
        Session::flash('alert-class','success');
        return redirect()->route('dogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dogData = Dogs::query()->where('id', $id)->firstOrFail();
        return view("dogs/show", [
            "dogData" => $dogData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dogData = Dogs::query()->where('id', $id)->firstOrFail();
        return view("dogs/form", [
            "id" => $id,
            "dogData" => $dogData
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        // Jika data tidak sesuai kriteria validasi
        if (!$data) {
            Session::flash('message', 'Data anjing tidak berhasil diupdate !');
            Session::flash('alert-class', 'danger');
            return redirect()->route('dogs.index');
        }

        Dogs::query()->where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Session::flash('message','Data anjing berhasil diupdate !');
        Session::flash('alert-class','success');
        return redirect()->route('dogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Dogs::query()->where("id", $id)->delete();

        Session::flash('message','Data anjing berhasil dihapus !');
        Session::flash('alert-class','success');
        return redirect()->route("dogs.index");
    }
}
