<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pejabat;
use Illuminate\Support\Facades\Storage;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pejabat::orderBy('urutan', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'required|string',
            'urutan' => 'integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pejabat', 'public');
        }

        $pejabat = Pejabat::create($validated);
        return response()->json($pejabat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Pejabat::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pejabat = Pejabat::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'string|max:255',
            'nrp' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'string',
            'urutan' => 'integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($pejabat->foto) {
                Storage::disk('public')->delete($pejabat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pejabat', 'public');
        }

        $pejabat->update($validated);
        return response()->json($pejabat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pejabat = Pejabat::findOrFail($id);
        if ($pejabat->foto) {
            Storage::disk('public')->delete($pejabat->foto);
        }
        $pejabat->delete();
        return response()->noContent();
    }
}
