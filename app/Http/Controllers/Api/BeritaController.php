<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::with('kategori')->orderBy('created_at', 'desc');

        // Filter by category name
        if ($request->has('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama', $request->kategori);
            });
        }

        // Search by title, summary, or content
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('ringkasan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('konten', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Limit results
        if ($request->has('limit')) {
            $query->limit((int) $request->limit);
        }

        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|unique:berita,slug',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'penulis' => 'required|string',
            'cover' => 'nullable|image|max:2048',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('berita', 'public');
        }

        $berita = Berita::create($validated);
        return response()->json($berita, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slugOrId)
    {
        // Try to find by slug first, then by ID
        $berita = Berita::with('kategori')->where('slug', $slugOrId)->first();
        
        if (!$berita) {
            $berita = Berita::with('kategori')->find($slugOrId);
        }
        
        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }
        
        return $berita;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'string|max:255',
            'slug' => 'string|unique:berita,slug,' . $id,
            'kategori_id' => 'exists:kategori_berita,id',
            'penulis' => 'string',
            'cover' => 'nullable|image|max:2048',
            'ringkasan' => 'nullable|string',
            'konten' => 'string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover')) {
            if ($berita->cover) {
                Storage::disk('public')->delete($berita->cover);
            }
            $validated['cover'] = $request->file('cover')->store('berita', 'public');
        }

        $berita->update($validated);
        return response()->json($berita);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->cover) {
            Storage::disk('public')->delete($berita->cover);
        }
        $berita->delete();
        return response()->noContent();
    }
}
