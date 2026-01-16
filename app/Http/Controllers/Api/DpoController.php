<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dpo;
use Illuminate\Support\Facades\Storage;

class DpoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dpo::orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:dpo,nomor_surat',
            'nama' => 'required|string|max:255',
            'alias' => 'nullable|string',
            'kasus' => 'required|string',
            'ciri_fisik' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,tertangkap,menyerahkan_diri,meninggal',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dpo', 'public');
        }

        $dpo = Dpo::create($validated);
        return response()->json($dpo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Dpo::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dpo = Dpo::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'string|unique:dpo,nomor_surat,' . $id,
            'nama' => 'string|max:255',
            'alias' => 'nullable|string',
            'kasus' => 'string',
            'ciri_fisik' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'in:aktif,tertangkap,menyerahkan_diri,meninggal',
        ]);

        if ($request->hasFile('foto')) {
            if ($dpo->foto) {
                Storage::disk('public')->delete($dpo->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dpo', 'public');
        }

        $dpo->update($validated);
        return response()->json($dpo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dpo = Dpo::findOrFail($id);
        if ($dpo->foto) {
            Storage::disk('public')->delete($dpo->foto);
        }
        $dpo->delete();
        return response()->noContent();
    }
}
