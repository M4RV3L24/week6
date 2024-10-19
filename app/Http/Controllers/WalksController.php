<?php

namespace App\Http\Controllers;

use App\Models\Owners;
use App\Models\Walks;
use Illuminate\Http\Request;

class WalksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
