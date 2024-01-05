<?php

namespace App\Http\Controllers;

use App\Http\Requests\Criteria\CriteriaStoreRequest;
use Illuminate\Validation\ValidationException;
use App\Models\Criteria;
use Illuminate\Http\Request;

class AdminCriteriaController extends Controller
{
  public function index()
  {
    $this->authorize('viewAny', Criteria::class);

    return view('dashboard.criteria.index', [
      'title'     => 'Criterias',
      'objects' => Criteria::all()
    ]);
  }

  // Create Criteria
  public function create()
  {
    $this->authorize('create', Criteria::class);

    return view('dashboard.criteria.create', [
      'title' => 'Add Criterias',
    ]);
  }

  // Req Add Criteria
  public function store(CriteriaStoreRequest $request)
  {
    $this->authorize('create', Criteria::class);

    $validate = $request->validated();

    // Check total weight
    $totalWeight = Criteria::sum('weight') + $validate['weight'];

    if ($totalWeight > 100) {
      throw ValidationException::withMessages(['weight' => 'Total weight cannot exceed 100.']);
    }

    Criteria::create($validate);

    return redirect('/dashboard/criterias')
      ->with('success', 'The New Criteria Has Been Added!');
  }

  // Edit Criteria
  public function edit($id)
  {
    $this->authorize('update', Criteria::class);
    $criteria = Criteria::select('*')->where('id', $id)->first();

    return view('dashboard.criteria.edit', [
      'title'    => "Edit $criteria->id",
      'object' => $criteria
    ]);
  }

  // Req Update Criteria
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'attribute'  => 'required',
      'weight'     => '|numeric|min:0|max:100',
     ]);

    $criteria = Criteria::find($id);
    
    // Calculate total weight excluding the current criteria
    $totalWeight = Criteria::where('id', '<>', $id)->sum('weight') + $request->input('weight');

    if ($totalWeight > 100) {
        throw ValidationException::withMessages(['weight' => 'Total weight cannot exceed 100.']);
    }

     $criteria->name = $request->name;
     $criteria->criteriaName = $request->criteriaName;
     $criteria->attribute = $request->attribute;
     $criteria->weight = $request->weight;
     $criteria->save();

    return redirect('/dashboard/criterias')
      ->with('success', 'The Selected Criteria Has Been Updated!');
  }

  // Delete Criteria
  public function destroy($id)
  {
    $this->authorize('delete', Criteria::class);
    $criteria = Criteria::find($id);
    $criteria->delete();

    return redirect('/dashboard/criterias')
      ->with('success', 'The Selected Criteria Has Been Deleted!');
  }
}