<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PeringatanDarurat;

class PeringatanDaruratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PeringatanDarurat::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'level' => 'required|in:info,waspada,bahaya',
            'lokasi' => 'nullable|string',
            'deskripsi' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $peringatan = PeringatanDarurat::create($validated);
        return response()->json($peringatan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return PeringatanDarurat::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peringatan = PeringatanDarurat::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'string|max:255',
            'level' => 'in:info,waspada,bahaya',
            'lokasi' => 'nullable|string',
            'deskripsi' => 'string',
            'is_active' => 'boolean',
        ]);

        $peringatan->update($validated);
        return response()->json($peringatan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peringatan = PeringatanDarurat::findOrFail($id);
        $peringatan->delete();
        return response()->noContent();
    }
}
