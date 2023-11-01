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
        // Get Data Products From Model Products
        $alternatives = Products::where('date', $date)->get();
        
        // Get Data Crierias From Model Criteria
        $criterias = Criteria::all();

        // Max Value Each Criteria
        $maxValues = [];

        foreach ($criterias as $criteria) {
            // If Attribute is COST = minValues Each Criteria
            if ($criteria->attribute === 'COST') {
                $maxValues[$criteria->name] = $alternatives->min($criteria->name);
            } else {
                // If Attribute is BENEFIT = maxValues Each Criteria
                $maxValues[$criteria->name] = $alternatives->max($criteria->name);
            }
        }

        // Calculate The Preference Value
        $preferences = [];

        foreach ($alternatives as $alternative) {
            $preferenceValue = 0;

            foreach ($criterias as $criteria) {
                if ($maxValues[$criteria->name] != 0) {
                    // If Attribute is COST = minValues Each Criteria
                    if ($criteria->attribute === 'COST') {
                        $preferenceValue += $criteria->weight * ($maxValues[$criteria->name] / $alternative->{$criteria->name});
                    } else {
                        // If Attribute is BENEFIT = maxValues Each Criteria
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

        // Sort Alternatives by Rank
        $alternatives = $alternatives->map(function ($alternative) use ($preferences) {
            $alternative->c1 = $preferences[$alternative->id]['C1'];
            $alternative->c2 = $preferences[$alternative->id]['C2'];
            $alternative->c3 = $preferences[$alternative->id]['C3'];
            $alternative->preferenceValue = $preferences[$alternative->id]['ResultTotal'];
            return $alternative;
        })->sortByDesc('preferenceValue');

        // Calculate The Rank and Store The Result Into an Array
        $results = [];
        $normalization = [];
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
        $data = [
            'result' => $results,
            'maxvalues' => $maxValues,
            'preference' => $preferences,
        ];
    
        return $data;
    }
    
    public function calculate(Request $request)
{
    $input = $request->all();
    $date = $input['date'];
    $calculationData = $this->calculateSAW($date);

    if (empty($calculationData['result'])) {
        return back()->with('failed', 'Tidak Ada Data');
    }

    return view('dashboard.calculation.index', [
        'title' => 'Calculation',
        'results' => $calculationData['result'],
        'date' => $date,
        'maxvalues' => $calculationData['maxvalues'],
        'preference' => $calculationData['preference'],
    ]);
}

    public function export_excel($date)
    {
        $results = $this->calculateSAW($date);
    
        // Convert Array To a Collection
        $resultsCollection =  collect($results);
        return Excel::download(new ResultExport($resultsCollection), 'result.xlsx');
    }
}
