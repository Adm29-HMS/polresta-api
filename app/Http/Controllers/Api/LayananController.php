<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Layanan::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|unique:layanan,slug',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'prosedur' => 'nullable|string',
        ]);

        $layanan = Layanan::create($validated);
        return response()->json($layanan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Layanan::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'string|max:255',
            'slug' => 'string|unique:layanan,slug,' . $id,
            'deskripsi' => 'string',
            'icon' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'prosedur' => 'nullable|string',
        ]);

        $layanan->update($validated);
        return response()->json($layanan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return response()->noContent();
    }
}
