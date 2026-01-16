<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikLalulintas;

class StatistikLalulintasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StatistikLalulintas::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'pelanggaran' => 'required|integer|min:0',
            'kecelakaan' => 'required|integer|min:0',
        ]);

        // Check unique
        $exists = StatistikLalulintas::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Data untuk bulan dan tahun ini sudah ada.'], 422);
        }

        $data = StatistikLalulintas::create($validated);
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return StatistikLalulintas::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = StatistikLalulintas::findOrFail($id);

        $validated = $request->validate([
            'bulan' => 'integer|min:1|max:12',
            'tahun' => 'integer|min:2020',
            'pelanggaran' => 'integer|min:0',
            'kecelakaan' => 'integer|min:0',
        ]);

        if ($request->has(['bulan', 'tahun'])) {
             $exists = StatistikLalulintas::where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->where('id', '!=', $id)
                ->exists();
             if ($exists) {
                return response()->json(['message' => 'Data untuk bulan dan tahun ini sudah ada.'], 422);
            }
        }

        $data->update($validated);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = StatistikLalulintas::findOrFail($id);
        $data->delete();
        return response()->noContent();
    }
}
