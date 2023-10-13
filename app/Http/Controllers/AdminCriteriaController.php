<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class AdminCriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->authorize('viewAny', Criteria::class);

    return view('dashboard.criteria.index', [
      'title'     => 'Criterias',
      'criterias' => Criteria::all()
    ]);
  }
}