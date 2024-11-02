<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Owners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownersData = Owners::query()->get();
        return view("owners/index", [
            "owners" => $ownersData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("owners/form");
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
            Session::flash('message', 'Data owner tidak berhasil ditambahkan !');
            Session::flash('alert-class', 'danger');
            return redirect()->route('owners.index');
        }

        Owners::create([
            'name' => $request->name,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Session::flash('message','Data owner berhasil ditambahkan !');
        Session::flash('alert-class','success');
        return redirect()->route('owners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ownerData = Owners::query()->where('id', $id)->firstOrFail();
        return view("owners/show", [
            "ownerData" => $ownerData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ownerData = Owners::query()->where('id', $id)->firstOrFail();
        return view("owners/form", [
            "id" => $id,
            "ownerData" => $ownerData
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
            Session::flash('message', 'Data owner tidak berhasil diupdate !');
            Session::flash('alert-class', 'danger');
            return redirect()->route('owners.index');
        }

        Owners::query()->where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Session::flash('message','Data owner berhasil diupdate !');
        Session::flash('alert-class','success');
        return redirect()->route('owners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Owners::query()->where("id", $id)->delete();

        Session::flash('message','Data owner berhasil dihapus !');
        Session::flash('alert-class','success');
        return redirect()->route("owners.index");
    }
}
