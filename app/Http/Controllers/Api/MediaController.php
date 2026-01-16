<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Media::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:photo,video,document',
            'file_path' => 'nullable|file|max:10240', // 10MB max
            'url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->type === 'video' && !$request->url) {
             return response()->json(['message' => 'URL wajib diisi untuk tipe video.'], 422);
        }

        if (($request->type === 'photo' || $request->type === 'document') && !$request->hasFile('file_path')) {
            return response()->json(['message' => 'File wajib diunggah untuk tipe foto atau dokumen.'], 422);
        }

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('media', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('media/thumbnails', 'public');
        }

        $media = Media::create($validated);
        return response()->json($media, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Media::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $media = Media::findOrFail($id);

        $validated = $request->validate([
            'title' => 'string|max:255',
            'type' => 'in:photo,video,document',
            'file_path' => 'nullable|file|max:10240',
            'url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            if ($media->file_path) {
                Storage::disk('public')->delete($media->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('media', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($media->thumbnail) {
                Storage::disk('public')->delete($media->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('media/thumbnails', 'public');
        }

        $media->update($validated);
        return response()->json($media);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        if ($media->file_path) {
            Storage::disk('public')->delete($media->file_path);
        }
        if ($media->thumbnail) {
            Storage::disk('public')->delete($media->thumbnail);
        }
        $media->delete();
        return response()->noContent();
    }
}
