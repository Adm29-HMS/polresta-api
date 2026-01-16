<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikKriminal;

class StatistikKriminalController extends Controller
{
    public function index()
    {
        return StatistikKriminal::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'jumlah_kasus' => 'required|integer|min:0',
        ]);

        // Check unique composite
        $exists = StatistikKriminal::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Data untuk bulan dan tahun ini sudah ada.'], 422);
        }

        $data = StatistikKriminal::create($validated);
        return response()->json($data, 201);
    }

    public function show(string $id)
    {
        return StatistikKriminal::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $data = StatistikKriminal::findOrFail($id);

        $validated = $request->validate([
            'bulan' => 'integer|min:1|max:12',
            'tahun' => 'integer|min:2020',
            'jumlah_kasus' => 'integer|min:0',
        ]);

        if ($request->has(['bulan', 'tahun'])) {
             $exists = StatistikKriminal::where('bulan', $request->bulan)
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

    public function destroy(string $id)
    {
        $data = StatistikKriminal::findOrFail($id);
        $data->delete();
        return response()->noContent();
    }
}
