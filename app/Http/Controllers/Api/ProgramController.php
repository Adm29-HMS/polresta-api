<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Program::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal_hari' => 'nullable|string',
            'waktu' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('programs', 'public');
            $validated['gambar'] = $path;
        }

        $program = Program::create($validated);
        return response()->json($program, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Program::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal_hari' => 'nullable|string',
            'waktu' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($program->gambar) {
                Storage::disk('public')->delete($program->gambar);
            }
            $path = $request->file('gambar')->store('programs', 'public');
            $validated['gambar'] = $path;
        }

        $program->update($validated);
        return response()->json($program);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        
        if ($program->gambar) {
            Storage::disk('public')->delete($program->gambar);
        }

        $program->delete();
        return response()->json(null, 204);
    }
}
