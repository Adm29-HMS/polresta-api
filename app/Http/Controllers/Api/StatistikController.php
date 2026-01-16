<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikKriminal;
use App\Models\StatistikLalulintas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function kriminal()
    {
        // Get last 6 months
        $currentDate = Carbon::now();
        $startYear = $currentDate->copy()->subMonths(5)->year;
        $startMonth = $currentDate->copy()->subMonths(5)->month;
        
        // Simple fetch and map since db is already monthly
        // We need to construct the last 6 months list and fill data
        
        $result = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $m = $date->month;
            $y = $date->year;
            
            $record = StatistikKriminal::where('bulan', $m)->where('tahun', $y)->first();
            // Wait, import should be StatistikKriminal
            
             $result[] = [
                'month' => $date->format('M'),
                'year' => $date->format('Y'),
                'label' => $date->format('M Y'),
                'count' => $record ? $record->jumlah_kasus : 0
            ];
        }

        return response()->json($result);
    }

    public function lalulintas()
    {
         $result = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $m = $date->month;
            $y = $date->year;
            
            $record = StatistikLalulintas::where('bulan', $m)->where('tahun', $y)->first();
            
             $result[] = [
                'month' => $date->format('M'),
                'year' => $date->format('Y'),
                'label' => $date->format('M Y'),
                'pelanggaran' => $record ? $record->pelanggaran : 0,
                'kecelakaan' => $record ? $record->kecelakaan : 0
            ];
        }

        return response()->json($result);
    }
}
