<?php

namespace App\Http\Controllers;

use App\Models\DogOwners;
use App\Models\Owners;
use App\Models\Walks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WalksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        print_r(session()->all());
        $walksData = Walks::query()->get();
        return view("walks/index", [
            "walks" => $walksData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listOwners = Owners::query()->where('active', 1)->get();
        return view("walks/form", [
            "listOwners" => $listOwners
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // finished_at tidak required, bisa jadi ketika create walk, hanya diinput started_at saja
        $data = $request->validate([
            'owner' => 'required',
            'dog' => 'required',
            'started_at' => 'required',
        ]);

        // Jika data tidak sesuai kriteria validasi
        if (!$data) {
            Session::flash('message', 'Data walk tidak berhasil ditambahkan !');
            Session::flash('alert-class', 'danger');
            return redirect()->route('walks.index');
        }

        // Insert dulu ke table dog_owner, ambil idnya
        $dogOwnerData = DogOwners::create([
            'dog_id' => $request->dog,
            'owner_id' => $request->owner,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $finished_at = NULL;
        // Jika finished at date diisi, baru parse menggunakan Carbon
        if (isset($request->finished_at)){
            $finished_at = Carbon::parse($request->finished_at)->format('Y-m-d H:i:s');
        }
        Walks::create([
            'dog_owner_id' => $dogOwnerData->id,
            'started_at' =>  Carbon::parse($request->started_at)->format('Y-m-d H:i:s'),
            'finished_at' => $finished_at,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Session::flash('message','Data walk berhasil ditambahkan !');
        Session::flash('alert-class','success');
        return redirect()->route('walks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $walkData = Walks::query()->where('id', $id)->firstOrFail();
        return view("walks/show", [
            "walkData" => $walkData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listOwners = Owners::query()->where('active', 1)->get();
        $walkData = Walks::query()->where('id', $id)->firstOrFail();
        $walkData->started_at = Carbon::parse($walkData->started_at)->format('m/d/Y H:i A');
        if (isset($walkData->finished_at)) {
            $walkData->finished_at = Carbon::parse($walkData->finished_at)->format('m/d/Y H:i A');
        } 
        return view("walks/form", [
            "id" => $id,
            "listOwners" => $listOwners,
            "walkData" => $walkData
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // finished_at tidak required, bisa jadi ketika create walk, hanya diinput started_at saja
        $data = $request->validate([
            'started_at' => 'required',
        ]);

        // Jika data tidak sesuai kriteria validasi
        if (!$data) {
            Session::flash('message', 'Data walk tidak berhasil diupdate !');
            Session::flash('alert-class', 'danger');
            return redirect()->route('walks.index');
        }

        $finished_at = NULL;
        // Jika finished at date diisi, baru parse menggunakan Carbon
        if (isset($request->finished_at)){
            $finished_at = Carbon::parse($request->finished_at)->format('Y-m-d H:i:s');
        }
        Walks::query()->where('id', $id)->update([
            'started_at' =>  Carbon::parse($request->started_at)->format('Y-m-d H:i:s'),
            'finished_at' => $finished_at,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Session::flash('message','Data walk berhasil diupdate !');
        Session::flash('alert-class','success');
        return redirect()->route('walks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $walkData = Walks::query()->where("id", $id)->first();
        DogOwners::query()
                   ->where('id', $walkData->dog_owner_id)
                   ->delete();
        Walks::query()->where("id", $id)->delete();

        Session::flash('message','Data walk berhasil dihapus !');
        Session::flash('alert-class','success');
        return redirect()->route("walks.index");
    }
}
