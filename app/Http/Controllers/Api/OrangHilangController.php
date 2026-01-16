<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrangHilang;
use Illuminate\Support\Facades\Storage;

class OrangHilangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrangHilang::orderBy('tanggal_hilang', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'usia' => 'nullable|integer',
            'tanggal_hilang' => 'required|date',
            'lokasi_terakhir' => 'required|string',
            'ciri' => 'nullable|string',
            'kontak' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:dicari,ditemukan',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('orang_hilang', 'public');
        }

        $result = OrangHilang::create($validated);
        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return OrangHilang::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orangHilang = OrangHilang::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'string|max:255',
            'jenis_kelamin' => 'in:laki-laki,perempuan',
            'usia' => 'nullable|integer',
            'tanggal_hilang' => 'date',
            'lokasi_terakhir' => 'string',
            'ciri' => 'nullable|string',
            'kontak' => 'string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'in:dicari,ditemukan',
        ]);

        if ($request->hasFile('foto')) {
            if ($orangHilang->foto) {
                Storage::disk('public')->delete($orangHilang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('orang_hilang', 'public');
        }

        $orangHilang->update($validated);
        return response()->json($orangHilang);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orangHilang = OrangHilang::findOrFail($id);
        if ($orangHilang->foto) {
            Storage::disk('public')->delete($orangHilang->foto);
        }
        $orangHilang->delete();
        return response()->noContent();
    }
}
