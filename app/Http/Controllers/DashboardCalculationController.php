<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Criteria;

class DashboardCriteriaComparisonController extends Controller
{
  public function calculateSAW()
    {
        // Ambil data bobot dari model Criteria
        $criteriaWeights = Criteria::pluck('weight')->toArray();

        // Ambil data nama kriteria dari model Criteria
        $criteriaNames = Criteria::pluck('name')->toArray();

        // Retrieve all products from the database
        $products = Products::all();

        $results = [];

        foreach ($products as $product) {
            $score = 0;

            // Calculate the SAW score for each product
            for ($i = 0; $i < count($criteriaNames); $i++) {
                $criteriaName = $criteriaNames[$i];
                $weight = $criteriaWeights[$i];
                $value = $product->$criteriaName;

                // Adjust the deviden value if necessary
                if ($criteriaName === 'deviden' && $value === 'YES') {
                    $value = 1;
                } elseif ($criteriaName === 'deviden' && $value === 'NO') {
                    $value = 0;
                }

                $score += $weight * $value;
            }

            // Store the result for this product
            $results[] = [
                'product' => $product->name,
                'score' => $score,
            ];
        }

        // Sort the results by score in descending order
        usort($results, function ($a, $b) {
            return $b['score'] - $a['score'];
        });

        return view('saw.result', ['results' => $results]);
    }
}
