<?php

namespace App\Http\Controllers;

use App\Models\Risks;
use Illuminate\Http\Request;

class AdminRiskController extends Controller
{
  public function index()
  {
    $this->authorize('viewAny', Risks::class);

    return view('dashboard.risk.index', [
      'title' => 'risks',
      'objects' => Risks::all()
    ]);
  }

  // Edit Data Risk
  public function edit($id)
  {
    $this->authorize('update', Risks::class);
    $risks = Risks::select('*')->where('id', $id)->first();

    return view('dashboard.risk.edit', [
      'title'  => "Edit $risks->id",
      'object' => $risks
    ]);
  }

  // Req Update Data Risk
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'risk' => 'required|numeric',
    ]);
  
    $riskDecimal = $request->risk / 100;
  
    $risks = Risks::find($id);
    $risks->risk = $riskDecimal;
    $risks->save();

    return redirect('/dashboard/risks')
      ->with('success', 'The Selected Risk Object Has Been Updated!');
  }
}
