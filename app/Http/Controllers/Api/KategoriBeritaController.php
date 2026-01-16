<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KategoriBerita;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KategoriBerita::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|unique:kategori_berita,slug',
        ]);

        $kategori = KategoriBerita::create($validated);
        return response()->json($kategori, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return KategoriBerita::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'string|max:255',
            'slug' => 'string|unique:kategori_berita,slug,' . $id,
        ]);

        $kategori->update($validated);
        return response()->json($kategori);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->delete();
        return response()->noContent();
    }
}
