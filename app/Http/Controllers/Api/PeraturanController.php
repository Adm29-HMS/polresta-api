<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Peraturan;
use Illuminate\Support\Facades\Storage;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Peraturan::orderBy('tahun', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'tentang' => 'required|string',
            'file_path' => 'required|file|mimes:pdf|max:10240', // PDF max 10MB
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('peraturan', 'public');
        }

        $peraturan = Peraturan::create($validated);
        return response()->json($peraturan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Peraturan::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peraturan = Peraturan::findOrFail($id);

        $validated = $request->validate([
            'nomor' => 'string|max:255',
            'tahun' => 'digits:4|integer',
            'tentang' => 'string',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            if ($peraturan->file_path) {
                Storage::disk('public')->delete($peraturan->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('peraturan', 'public');
        }

        $peraturan->update($validated);
        return response()->json($peraturan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peraturan = Peraturan::findOrFail($id);
        if ($peraturan->file_path) {
            Storage::disk('public')->delete($peraturan->file_path);
        }
        $peraturan->delete();
        return response()->noContent();
    }
}
