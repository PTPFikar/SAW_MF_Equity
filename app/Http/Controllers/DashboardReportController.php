<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Criteria;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardReportController extends Controller
{
    public function index()
    {
        return view('dashboard.report.index', [
            'title' => 'Report',
        ]);
    }

    public function reportSAW($date)
    {
        // Get data products from Model Products
        $alternatives = Products::where('date', $date)->get();
        
        // Get data crierias from Model Criteria
        $criterias = Criteria::all();

        // Max Value each Criteria
        $maxValues = [];

        foreach ($criterias as $criteria) {
            // If atribut is COST = minValues each Criteria
            if ($criteria->attribute === 'COST') {
                $maxValues[$criteria->name] = $alternatives->min($criteria->name);
            } else {
                // If atribut is BENEFIT = maxValues each Criteria
                $maxValues[$criteria->name] = $alternatives->max($criteria->name);
            }
        }

        // Calculate the preference value
        $preferences = [];

        foreach ($alternatives as $alternative) {
            $preferenceValue = 0;

            foreach ($criterias as $criteria) {
                if ($maxValues[$criteria->name] != 0) {
                    // If atribut is COST = minValues each Criteria
                    if ($criteria->attribute === 'COST') {
                        $preferenceValue += $criteria->weight * ($maxValues[$criteria->name] / $alternative->{$criteria->name});
                    } else {
                        // If atribut is BENEFIT = maxValues each Criteria
                        $preferenceValue += $criteria->weight * ($alternative->{$criteria->name} / $maxValues[$criteria->name]);
                    }
                } else {
                    $preferenceValue = 0;
                    break;
                }
            }

            $preferences[$alternative->id] = [
                'C1' => ($alternative->sharpeRatio / $maxValues['sharpeRatio']) * $criterias->where('name', 'sharpeRatio')->first()->weight,
                'C2' => ($alternative->AUM / $maxValues['AUM']) * $criterias->where('name', 'AUM')->first()->weight,
                'C3' => ($alternative->deviden / $maxValues['deviden']) * $criterias->where('name', 'deviden')->first()->weight,
                'ResultTotal' => $preferenceValue,
            ];
        }

        // Sort alternatives by rank
        $alternatives = $alternatives->map(function ($alternative) use ($preferences) {
            $alternative->c1 = $preferences[$alternative->id]['C1'];
            $alternative->c2 = $preferences[$alternative->id]['C2'];
            $alternative->c3 = $preferences[$alternative->id]['C3'];
            $alternative->preferenceValue = $preferences[$alternative->id]['ResultTotal'];
            return $alternative;
        })->sortByDesc('preferenceValue');

        // Calculate the rank and store the result into an array
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
        // return $results;
        return ['maxValues' => $maxValues, 'criterias' => $criterias, 'results' => $results];

    }
    
    public function report(Request $request) {
        $input = $request->all();
        $date = $input['date'];
        $reportResult = $this->reportSAW($date);
    
        if (empty($reportResult['results'])) {
            return back()->with('failed', 'Data Not Found');
        }
    
        $maxValues = $reportResult['maxValues'];
        $criterias = $reportResult['criterias'];
        $results = $reportResult['results'];
    
        // Raw Data or Alternatif
        $rawData = Products::where('date', $date)->get();
        $rawDataWithDetails = [];

        foreach ($rawData as $alternative) {
            $rawDataWithDetails[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'expectReturn' => $alternative->expectReturn,
                'C1' => $alternative->sharpeRatio,
                'C2' => $alternative->AUM,
                'C3' => $alternative->deviden,
            ];
        }

        // Normalization Data
        $normalizedData = [];
        foreach ($rawData as $alternative) {
            $normalizedData[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'C1' => $alternative->sharpeRatio / $maxValues['sharpeRatio'],
                'C2' => $alternative->AUM / $maxValues['AUM'],
                'C3' => $alternative->deviden / $maxValues['deviden'],
            ];
        }

        // Preferences Data
        $weightedData = [];
        foreach ($rawData as $alternative) {
            $weightedData[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'expectReturn' => $alternative->expectReturn,
                'C1' => $normalizedData[$alternative->id]['C1'] * $criterias->where('name', 'sharpeRatio')->first()->weight,
                'C2' => $normalizedData[$alternative->id]['C2'] * $criterias->where('name', 'AUM')->first()->weight,
                'C3' => $normalizedData[$alternative->id]['C3'] * $criterias->where('name', 'deviden')->first()->weight,
            ];
        }

        return view('dashboard.report.index', [
            'title' => 'Report',
            'results' => $results,
            'date' => $date,
            'rawData' => $rawDataWithDetails,
            'normalizedData' => $normalizedData,
            'weightedData' => $weightedData,
        ]);
    }
    

    public function export_excel($date)
    {
        
        

        $reportResult = $this->reportSAW($date);
    
        if (empty($reportResult['results'])) {
            return back()->with('failed', 'Data Not Found');
        }
    
        $maxValues = $reportResult['maxValues'];
        $criterias = $reportResult['criterias'];
        $results = $reportResult['results'];
        $reportCollection =  collect($results);
        // Raw Data or Alternatif
        $rawData = Products::where('date', $date)->get();
        $rawDataWithDetails = [];

        foreach ($rawData as $alternative) {
            $rawDataWithDetails[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'expectReturn' => $alternative->expectReturn,
                'C1' => $alternative->sharpeRatio,
                'C2' => $alternative->AUM,
                'C3' => $alternative->deviden,
            ];
        }

        // Normalization Data
        $normalizedData = [];
        foreach ($rawData as $alternative) {
            $normalizedData[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'C1' => $alternative->sharpeRatio / $maxValues['sharpeRatio'],
                'C2' => $alternative->AUM / $maxValues['AUM'],
                'C3' => $alternative->deviden / $maxValues['deviden'],
            ];
        }

        // Preferences Data
        $weightedData = [];
        foreach ($rawData as $alternative) {
            $weightedData[$alternative->id] = [
                'ID' => $alternative->id,
                'ISIN' => $alternative->ISIN,
                'productName' => $alternative->productName,
                'expectReturn' => $alternative->expectReturn,
                'C1' => $normalizedData[$alternative->id]['C1'] * $criterias->where('name', 'sharpeRatio')->first()->weight,
                'C2' => $normalizedData[$alternative->id]['C2'] * $criterias->where('name', 'AUM')->first()->weight,
                'C3' => $normalizedData[$alternative->id]['C3'] * $criterias->where('name', 'deviden')->first()->weight,
            ];
        }
        // dd($rawDataWithDetails);
        return Excel::download(new ReportExport($reportCollection, $rawData), 'report.xlsx');
    }
}
