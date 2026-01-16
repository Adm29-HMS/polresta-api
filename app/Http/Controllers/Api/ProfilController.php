<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profil;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Profil::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:profil,key',
            'value' => 'required|string',
        ]);

        $profil = Profil::create($validated);
        return response()->json($profil, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Check if $id is numeric (ID) or string (Key)
        if (is_numeric($id)) {
            return Profil::findOrFail($id);
        } else {
            return Profil::where('key', $id)->firstOrFail();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profil = is_numeric($id) ? Profil::findOrFail($id) : Profil::where('key', $id)->firstOrFail();

        $validated = $request->validate([
            'key' => 'string|unique:profil,key,' . $profil->id,
            'value' => 'string',
        ]);

        $profil->update($validated);
        return response()->json($profil);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profil = is_numeric($id) ? Profil::findOrFail($id) : Profil::where('key', $id)->firstOrFail();
        $profil->delete();
        return response()->noContent();
    }
}
