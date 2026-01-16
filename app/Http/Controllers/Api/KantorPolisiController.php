<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KantorPolisi;

class KantorPolisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KantorPolisi::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);

        $kantor = KantorPolisi::create($validated);
        return response()->json($kantor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return KantorPolisi::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kantor = KantorPolisi::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'string|max:255',
            'tipe' => 'string',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',

        ]);

        $kantor->update($validated);
        return response()->json($kantor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kantor = KantorPolisi::findOrFail($id);
        $kantor->delete();
        return response()->noContent();
    }
}
