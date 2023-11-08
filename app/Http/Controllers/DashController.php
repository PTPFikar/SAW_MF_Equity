<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Risks;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $productCount = Products::count();
        $riskFree = Risks::where('id', 1)->value('risk');
        $riskDate = Risks::where('id', 1)->value('updated_at');
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'products_count' => $productCount,
            'risk' => $riskFree,
            'date' => $riskDate,
          ]);
    }
}