<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kriminal;

class KriminalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kriminal::orderBy('tanggal', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_laporan' => 'required|string|unique:kriminal,no_laporan',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pencurian,narkoba,kekerasan,penipuan,lainnya',
            'status' => 'required|in:penyelidikan,penyidikan,selesai',
            'lokasi' => 'required|string',
            'kronologi' => 'nullable|string',
        ]);

        $kriminal = Kriminal::create($validated);
        return response()->json($kriminal, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Kriminal::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kriminal = Kriminal::findOrFail($id);

        $validated = $request->validate([
            'no_laporan' => 'string|unique:kriminal,no_laporan,' . $id,
            'tanggal' => 'date',
            'jenis' => 'in:pencurian,narkoba,kekerasan,penipuan,lainnya',
            'status' => 'in:penyelidikan,penyidikan,selesai',
            'lokasi' => 'string',
            'kronologi' => 'nullable|string',
        ]);

        $kriminal->update($validated);
        return response()->json($kriminal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriminal = Kriminal::findOrFail($id);
        $kriminal->delete();
        return response()->noContent();
    }
}
