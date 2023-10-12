<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Criteria;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

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
         $alternatives = Products::all();

         // Mengambil data kriteria dari model Criteria
         $criterias = Criteria::all();
 
         // Maksimum nilai untuk tiap kriteria
         $maxValues = [];
 
         foreach ($criterias as $criteria) {
             $maxValues[$criteria->name] = $alternatives->max($criteria->name);
         }
 
         // Hitung nilai preferensi
         $preferences = [];
 
         foreach ($alternatives as $alternative) {
             $preferenceValue = 0;
 
             // Hitung 'C1', 'C2', dan 'C3' berdasarkan kriteria dan alternatif
             $c1 = $alternative->sharpRatio;
             $c2 = $alternative->AUM;
             $c3 = $alternative->deviden;
 
             foreach ($criterias as $criteria) {
                 if ($maxValues[$criteria->name] != 0) {
                     $preferenceValue += $criteria->weight * ($alternative->{$criteria->name} / $maxValues[$criteria->name]);
                 } else {
                     $preferenceValue = 0;
                     break;
                 }
             }
 
             $preferences[$alternative->id] = [
                 'C1' => $c1,
                 'C2' => $c2,
                 'C3' => $c3,
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
            'results' => $results, // Add this line to pass the results to the view
        ]);
      }
}
