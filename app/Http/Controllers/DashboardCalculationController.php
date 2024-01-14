<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Criteria;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use App\Exports\ResultExport;
use Maatwebsite\Excel\Facades\Excel;
use Alert;

class DashboardCalculationController extends Controller
{
    public function index()
    {
        return view('dashboard.calculation.index', [
            'title' => 'Calculation',
        ]);
    }
    
    public function calculateSAW($date)
    {
        // Get data products from Model Products
        $alternatives = Products::where('date', $date)->get();

        // Get data crierias from Model Criteria
        $criterias = Criteria::all();

        // Max Value each Criteria
        $maxValues = [];
        $minValues = [];

        foreach ($criterias as $criteria) {
            // If attribute is COST = minValues each Criteria
            if ($criteria->attribute === 'COST') {
                $minValues[$criteria->name] = $alternatives->min($criteria->name);
            } else {
                // If attribute is BENEFIT = maxValues each Criteria
                $maxValues[$criteria->name] = $alternatives->max($criteria->name);
            }
        }

         // Calculate the preference value
         $preferences = [];

         foreach ($alternatives as $alternative) {
             $preferenceValue = 0;
 
             $preferences[$alternative->id] = [
                 'ResultTotal' => $preferenceValue,
             ];
 
             $index = 1; 
             // Dynamically generate keys based on criterion names
             foreach ($criterias as $criteria) {
                 $key = 'C' . $index;
         
                 // Check the criteria type and use minValues or maxValues accordingly
                 $valueToUse = $criteria->attribute === 'COST' ? $minValues[$criteria->name] : $maxValues[$criteria->name];
         
                 // Check if the key exists in $maxValues array
                 $preferences[$alternative->id][$key] = isset($valueToUse) && $criteria->attribute === 'BENEFIT'
                     ? ($alternative->{$criteria->name} / $valueToUse) * $criteria->weight
                     : ($valueToUse / $alternative->{$criteria->name})  * $criteria->weight; // or any default value you prefer
         
                 $index++;
             }
         }
 
         // Sort alternatives by rank
         $alternatives = $alternatives->map(function ($alternative) use ($preferences) {
             $alternative->preferenceValue = $preferences[$alternative->id]['ResultTotal'];
             return $alternative;
         })->sortByDesc('preferenceValue');
 
         // Calculate the rank and store the result into an array
         $results = [];
         $rank = 1;
 
         foreach ($alternatives as $alternative) {
             $resultItem = [
                 'ID' => $alternative->id,
                 'ISIN' => $alternative->ISIN,
                 'productName' => $alternative->productName,
                 'Result' => $alternative->preferenceValue,
                 'Rank' => $rank,
             ];
             $index = 1; 
 
             // Dynamically generate keys based on criterion names
             foreach ($criterias as $criteria) {
                 $key = 'C' . $index;
                 $resultItem[$key] = $alternative->{$key};
 
                 $index++;
             }
 
             $results[] = $resultItem;
             $rank++;
         }
 
         return ['maxValues' => $maxValues, 'minValues' => $minValues, 'criterias' => $criterias, 'results' => $results];
     }
    
    
       
    public function calculate(Request $request) {
        $input = $request->all();
        $date = $input['date'];
        $calculationResult = $this->calculateSAW($date);
    
        if (empty($calculationResult['results'])) {
            return back()->with('failed', 'Data Not Found');
        }
    
        $maxValues = $calculationResult['maxValues'];
        $minValues = $calculationResult['minValues'];
        $criterias = $calculationResult['criterias'];
        $results = $calculationResult['results'];
  
        // Raw Data or Alternatif
        $rawData = Products::where('date', $date)->get();
        $rawDataWithDetails = [];
        
        foreach ($rawData as $alternative) {
            $rawDataWithDetails[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
            ];

            $index = 1; 
            
            // Dynamically generate keys based on criterion names
            foreach ($criterias as $criteria) {
                $key = 'C' . $index;
                $rawDataWithDetails[$alternative->id][$key] = $alternative->{$criteria->name};
                $index++;
            }
        }
    
        // Normalization Data
        $normalizedData = [];

        foreach ($rawData as $alternative) {
            $normalizedData[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
            ];

            $index = 1; 

            // Dynamically generate keys based on criterion names
            foreach ($criterias as $criteria) {
                $key = 'C' . $index;

                // Check the criteria type and use minValues or maxValues accordingly
                $valueToUse = $criteria->attribute == 'BENEFIT' ? $maxValues[$criteria->name] : $minValues[$criteria->name];
                // dd($valueToUse);
                // Check if the key exists in $maxValues array
                $normalizedData[$alternative->id][$key] = isset($valueToUse) && $criteria->attribute == 'BENEFIT'
                    ? $alternative->{$criteria->name} / $valueToUse
                    : $valueToUse / $alternative->{$criteria->name}; // or any default value you prefer
                $index++;
            }
        }
    
        // Preferences Data
        $weightedData = [];
        $index = 1;
        foreach ($rawData as $alternative) {
            $weightedData[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
            ];
            $sum = 0;
            // Dynamically generate keys based on criterion names
            foreach ($criterias as $criteria) {
                $key = 'C' . $index;
        
                $valueToUse = $criteria->attribute == 'BENEFIT' ? $maxValues[$criteria->name] : $minValues[$criteria->name];
        
                // Check if the key exists in $normalizedData array
                if (isset($valueToUse) && $valueToUse != 0) {
                    // Calculate the weighted value based on the criteria type
                    $weightedData[$alternative->id][$key] = isset($normalizedData[$alternative->id][$key])
                        ? $normalizedData[$alternative->id][$key] * $criteria->weight
                        : 0; 
                        // or any default value you prefer
                } else {
                    // Set default value or handle the case where the key does not exist
                    $weightedData[$alternative->id][$key] = 0;
                }
                $sum += $weightedData[$alternative->id][$key];
                $index++;
            }
            $weightedData[$alternative->id]['sumResult'] = $sum;

            // Reset index for the next alternative
            $index = 1;
        }
        // Sort $weightedData based on 'sum' in descending order
        usort($weightedData, function ($a, $b) {
            return $b['sumResult'] <=> $a['sumResult'];
        });

        // Add 'rank' to each entry
        $rank = 1;
        foreach ($weightedData as &$entry) {
            $entry['rank'] = $rank;
            $rank++;
        }
        
        return view('dashboard.calculation.index', [
            'title' => 'Calculation',
            'results' => $results,
            'date' => $date,
            'criterias' => $criterias,
            'rawData' => $rawDataWithDetails,
            'normalizedData' => $normalizedData,
            'weightedData' => $weightedData,
        ]);
    }

    public function export_excel($date)
    {
        $results = $this->calculateSAW($date);
        $results["maxValues"] = [];
        $results["criterias"] = [];

        // Convert array to a collection
        $resultsCollection =  collect($results);
        return Excel::download(new ResultExport($resultsCollection), 'result.xlsx');
    }
}
