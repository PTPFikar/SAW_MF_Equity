<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Criteria;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use App\Exports\ResultExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardCalculationController extends Controller
{
    public function index()
    {
        return view('dashboard.calculation.index', [
            'title' => 'Calculation',
        ]);
    }

    public function calculateSAW(Request $request)
    {
        // Mengambil data produk (alternatif) dari model Product
        $input = $request->all();
        $date = $input['date'];
        $alternatives = Products::where('date', $date)->get();

        // Mengambil data kriteria dari model Criteria
        $criterias = Criteria::all();

        // Maksimum nilai untuk tiap kriteria
        $maxValues = [];

        foreach ($criterias as $criteria) {
            // Jika atribut adalah COST, gunakan min() untuk mencari nilai terendah
            if ($criteria->attribute === 'COST') {
                $maxValues[$criteria->name] = $alternatives->min($criteria->name);
            } else {
                // Jika atribut adalah BENEFIT, gunakan max() untuk mencari nilai tertinggi
                $maxValues[$criteria->name] = $alternatives->max($criteria->name);
            }
        }

        // Hitung nilai preferensi
        $preferences = [];

        foreach ($alternatives as $alternative) {
            $preferenceValue = 0;

            foreach ($criterias as $criteria) {
                if ($maxValues[$criteria->name] != 0) {
                    // Jika atribut adalah COST, gunakan min() untuk mencari nilai terendah
                    if ($criteria->attribute === 'COST') {
                        $preferenceValue += $criteria->weight * ($maxValues[$criteria->name] / $alternative->{$criteria->name});
                    } else {
                        // Jika atribut adalah BENEFIT, gunakan max() untuk mencari nilai tertinggi
                        $preferenceValue += $criteria->weight * ($alternative->{$criteria->name} / $maxValues[$criteria->name]);
                    }
                } else {
                    $preferenceValue = 0;
                    break;
                }
            }

            $preferences[$alternative->id] = [
                'C1' => ($alternative->sharpRatio / $maxValues['sharpRatio']) * $criterias->where('name', 'sharpRatio')->first()->weight,
                'C2' => ($alternative->AUM / $maxValues['AUM']) * $criterias->where('name', 'AUM')->first()->weight,
                'C3' => ($alternative->deviden / $maxValues['deviden']) * $criterias->where('name', 'deviden')->first()->weight,
                'ResultTotal' => $preferenceValue,
            ];
        }

        // Urutkan alternatif berdasarkan nilai preferensi (peringkat)
        $alternatives = $alternatives->map(function ($alternative) use ($preferences) {
            $alternative->c1 = $preferences[$alternative->id]['C1'];
            $alternative->c2 = $preferences[$alternative->id]['C2'];
            $alternative->c3 = $preferences[$alternative->id]['C3'];
            $alternative->preferenceValue = $preferences[$alternative->id]['ResultTotal'];
            return $alternative;
        })->sortByDesc('preferenceValue');

        // Hitung rank dan simpan hasil perhitungan ke dalam array
        $results = [];
        $rank = 1;

        foreach ($alternatives as $alternative) {
            $results[] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'C1' => $alternative->c1,
                'C2' => $alternative->c2,
                'C3' => $alternative->c3,
                'Result' => $alternative->preferenceValue,
                'Rank' => $rank,
            ];

            $rank++;
        }
        return view('dashboard.calculation.index', [
            'title' => 'Calculation',
            'results' => $results,
            'date' => $date
        ]);
    }
    
      public function export_excel()
      {
          return Excel::download(new ResultExport, 'result.xlsx');
      }
}
