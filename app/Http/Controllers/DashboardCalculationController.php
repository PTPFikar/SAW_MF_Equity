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
        // Validasi input tanggal
        $request->validate([
            'date' => 'required|date|exists:products,date',
        ]);

        // Ambil tanggal yang dipilih dari request
        $selectedDate = $request->input('date');

        // Ambil data bobot dari model Criteria
        $criteriaWeights = Criteria::pluck('weight', 'id');

        // Retrieve all products from the database based on the selected date
        $products = Products::whereDate('date', $selectedDate)->get();

        // Find the maximum or minimum value of C based on attribute type (BENEFIT or COST)
        $maxValues = [];
        $minValues = [];

        foreach ($criteriaWeights as $criteriaId => $weight) {
            $criteriaName = Criteria::find($criteriaId)->criteriaName;
            $values = [];

            foreach ($products as $product) {
                $values[] = $product->$criteriaName;
            }

            if (Criteria::find($criteriaId)->Attribute == 'BENEFIT') {
                $maxValues[$criteriaName] = max($values);
            } elseif (Criteria::find($criteriaId)->Attribute == 'COST') {
                $minValues[$criteriaName] = min($values);
            }
        }


        // Calculate the final score for each product
        foreach ($products as $product) {
            $score = 0;

            foreach ($criteriaWeights as $criteriaId => $weight) {
                $criteriaName = Criteria::find($criteriaId)->criteriaName;
                $value = $product->$criteriaName;

                if (Criteria::find($criteriaId)->Attribute == 'BENEFIT') {
                    $score += ($value / $maxValues[$criteriaName]) * $weight;
                } elseif (Criteria::find($criteriaId)->Attribute == 'COST') {
                    $score += ($minValues[$criteriaName] / $value) * $weight;
                }
            }

            $rank = 1;
            foreach ($products as $product) {
                $results['rank'] = $rank;
                $results[] = $results;
                $rank++;
}

            // Store the result for this product
            $results[] = [
                'ISIN' => $product->ISIN,
                'productName' => $product->productName,
                'C1' => $product->sharpRatio,
                'C2' => $product->AUM,
                'C3' => ($product->deviden == 'YES' ? 1 : 0),
                'result' => $score,
                'rank' => $rank
            ];
        }

        // Sort the results by 'result' in descending order
        usort($results, function ($a, $b) {
            return $b['result'] - $a['result'];
        });

         // Pass the results to the INDEX view
        return view('dashboard.calculation.index', [
            'title' => 'Calculation',
            'results' => $results, // Add this line to pass the results to the view
        ]);
      }
}
