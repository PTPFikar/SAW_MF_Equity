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
    // old
    // public function calculateSAW($date)
    // {
    //     // Get data products from Model Products
    //     $alternatives = Products::where('date', $date)->get();
        
    //     // Get data crierias from Model Criteria
    //     $criterias = Criteria::all();

    //     // Max Value each Criteria
    //     $maxValues = [];
    //     $minValues = [];

    //     foreach ($criterias as $criteria) {
    //         // If atribut is COST = minValues each Criteria
    //         if ($criteria->attribute === 'COST') {
    //             $minValues[$criteria->name] = $alternatives->min($criteria->name);
    //         } else {
    //             // If atribut is BENEFIT = maxValues each Criteria
    //             $maxValues[$criteria->name] = $alternatives->max($criteria->name);
    //         }
    //     }

    //     // Calculate the preference value
    //     $preferences = [];

    //     foreach ($alternatives as $alternative) {
    //         $preferenceValue = 0;

    //         foreach ($criterias as $criteria) {
    //             if ($maxValues[$criteria->name] != 0 || $minValues[$criteria->name] != 0) {
    //                 // If atribut is COST = minValues each Criteria
    //                 if ($criteria->attribute === 'COST') {
    //                     $preferenceValue += $criteria->weight * ($minValues[$criteria->name] / $alternative->{$criteria->name});
    //                 } else {
    //                     // If atribut is BENEFIT = maxValues each Criteria
    //                     $preferenceValue += $criteria->weight * ($alternative->{$criteria->name} / $maxValues[$criteria->name]);
    //                 }
    //             } else {
    //                 $preferenceValue = 0;
    //                 break;
    //             }
    //         }

    //         $preferences[$alternative->id] = [
    //             'C1' => ($alternative->sharpeRatio / $maxValues['sharpeRatio']) * $criterias->where('name', 'sharpeRatio')->first()->weight,
    //             'C2' => ($alternative->AUM / $maxValues['AUM']) * $criterias->where('name', 'AUM')->first()->weight,
    //             'C3' => ($alternative->deviden / $maxValues['deviden']) * $criterias->where('name', 'deviden')->first()->weight,
    //             'C4' => ($alternative->standardDeviation / $minValues['standardDeviation']) * $criterias->where('name', 'standardDeviation')->first()->weight,
    //             'ResultTotal' => $preferenceValue,
    //         ];
    //     }

    //     // Sort alternatives by rank
    //     $alternatives = $alternatives->map(function ($alternative) use ($preferences) {
    //         $alternative->c1 = $preferences[$alternative->id]['C1'];
    //         $alternative->c2 = $preferences[$alternative->id]['C2'];
    //         $alternative->c3 = $preferences[$alternative->id]['C3'];
    //         $alternative->c4 = $preferences[$alternative->id]['C4'];
    //         $alternative->preferenceValue = $preferences[$alternative->id]['ResultTotal'];
    //         return $alternative;
    //     })->sortByDesc('preferenceValue');

    //     // Calculate the rank and store the result into an array
    //     $results = [];
    //     $rank = 1;

    //     foreach ($alternatives as $alternative) {
    //         $results[] = [
    //             'ID' => $alternative->id,
    //             'ISIN' => $alternative->ISIN,
    //             'productName' => $alternative->productName,
    //             'C1' => $alternative->c1,
    //             'C2' => $alternative->c2,
    //             'C3' => $alternative->c3,
    //             'C4' => $alternative->c4,
    //             'Result' => $alternative->preferenceValue,
    //             'Rank' => $rank,
    //         ];

    //         $rank++;
    //     }
    //     // return $results;
    //     return ['maxValues' => $maxValues,'minValues' => $minValues, 'criterias' => $criterias, 'results' => $results];

    // }
    // end Old

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

            foreach ($criterias as $criteria) {
                if (isset($maxValues[$criteria->name], $minValues[$criteria->name]) &&
                    $maxValues[$criteria->name] != 0 && $minValues[$criteria->name] != 0 &&
                    $alternative->{$criteria->name} != 0
                ) {
                    // If attribute is COST = minValues each Criteria
                    if ($criteria->attribute === 'COST') {
                        $preferenceValue += $criteria->weight * ($minValues[$criteria->name] / $alternative->{$criteria->name});
                    } else {
                        // If attribute is BENEFIT = maxValues each Criteria
                        $preferenceValue += $criteria->weight * ($alternative->{$criteria->name} / $maxValues[$criteria->name]);
                    }
                }
            }

            $preferences[$alternative->id] = [
                'ResultTotal' => $preferenceValue,
            ];
            $index = 1; 
            // Dynamically generate keys based on criterion names
            foreach ($criterias as $criteria) {
                $key = 'C' . $index;

                // Check if the key exists in $maxValues array
                $preferences[$alternative->id][$key] = isset($maxValues[$criteria->name])
                    ? ($alternative->{$criteria->name} / $maxValues[$criteria->name]) * $criteria->weight
                    : 0; // or any default value you prefer
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
    // old calcluate
    // public function calculate(Request $request) {
    //     $input = $request->all();
    //     $date = $input['date'];
    //     $calculationResult = $this->calculateSAW($date);
    
    //     if (empty($calculationResult['results'])) {
    //         return back()->with('failed', 'Data Not Found');
    //     }
    
    //     $maxValues = $calculationResult['maxValues'];
    //     $minValues = $calculationResult['minValues'];
    //     $criterias = $calculationResult['criterias'];
    //     $results = $calculationResult['results'];
    
    //     // Raw Data or Alternatif
    //     $rawData = Products::where('date', $date)->get();
    //     $rawDataWithDetails = [];

    //     foreach ($rawData as $alternative) {
    //         $rawDataWithDetails[$alternative->id] = [
    //             'ID' => $alternative->id,
    //             'ISIN' => $alternative->ISIN,
    //             'productName' => $alternative->productName,
    //             'C1' => $alternative->sharpeRatio,
    //             'C2' => $alternative->AUM,
    //             'C3' => $alternative->deviden,
    //             'C4' => $alternative->standardDeviation,
    //         ];
    //     }

    //     // Normalization Data
    //     $normalizedData = [];
    //     foreach ($rawData as $alternative) {
    //         $normalizedData[$alternative->id] = [
    //             'ID' => $alternative->id,
    //             'ISIN' => $alternative->ISIN,
    //             'productName' => $alternative->productName,
    //             'C1' => $alternative->sharpeRatio / $maxValues['sharpeRatio'],
    //             'C2' => $alternative->AUM / $maxValues['AUM'],
    //             'C3' => $alternative->deviden / $maxValues['deviden'],
    //             'C4' => $alternative->standardDeviation / $minValues['standardDeviation'],
    //         ];
    //     }

    //     // Preferences Data
    //     $weightedData = [];
    //     foreach ($rawData as $alternative) {
    //         $weightedData[$alternative->id] = [
    //             'ID' => $alternative->id,
    //             'ISIN' => $alternative->ISIN,
    //             'productName' => $alternative->productName,
    //             'C1' => $normalizedData[$alternative->id]['C1'] * $criterias->where('name', 'sharpeRatio')->first()->weight,
    //             'C2' => $normalizedData[$alternative->id]['C2'] * $criterias->where('name', 'AUM')->first()->weight,
    //             'C3' => $normalizedData[$alternative->id]['C3'] * $criterias->where('name', 'deviden')->first()->weight,
    //             'C4' => $normalizedData[$alternative->id]['C4'] * $criterias->where('name', 'standardDeviation')->first()->weight,
    //         ];
    //     }

    //     return view('dashboard.calculation.index', [
    //         'title' => 'Calculation',
    //         'results' => $results,
    //         'date' => $date,
    //         'rawData' => $rawDataWithDetails,
    //         'normalizedData' => $normalizedData,
    //         'weightedData' => $weightedData,
    //     ]);
    // }
    // endcalculate

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
                $key = 'C' . ($index);

                // Check if the key exists in $maxValues array
                $normalizedData[$alternative->id][$key] = isset($maxValues[$criteria->name])
                    ? $alternative->{$criteria->name} / $maxValues[$criteria->name]
                    : 0; // or any default value you prefer
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

            // Dynamically generate keys based on criterion names
            foreach ($criterias as $criteria) {
                $key = 'C' . $index;

                // Check if the key exists in $normalizedData array
                $weightedData[$alternative->id][$key] = isset($normalizedData[$alternative->id][$key])
                    ? $normalizedData[$alternative->id][$key] * $criteria->weight
                    : 0; // or any default value you prefer
                $index++;
            }
        }
        // dd($normalizedData);
        return view('dashboard.calculation.index', [
            'title' => 'Calculation',
            'results' => $results,
            'date' => $date,
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
