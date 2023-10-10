<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DB;
use App\Http\Requests\Products\ProductsUpdateRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
  public function index()
  {
    $this->authorize('viewAny', Products::class);

    return view('dashboard.products.index', [
      'title' => 'Products',
      'objects' => Products::all()
    ]);
  }

  public function edit(Products $products)
  {
    $this->authorize('update', Products::class);

    return view('dashboard.products.edit', [
      'title'  => "Edit $products->id",
      'object' => $products
    ]);
  }

  public function update($id, Request $request)
  {
    $this->validate($request,[
      'sharpRatio'  => 'required',
      'AUM'         => 'required',
      'deviden'     => 'required',
     ]);
  
     $products = Products::find($id);
     $products->sharpRatio = $request->sharpRatio;
     $products->AUM = $request->AUM;
     $products->deviden = $request->deviden;
     $products->save();

    return redirect('/dashboard/products')
      ->with('success', 'The selected Products object has been updated!');
  }

  public function destroy(Products $products)
  {
    $this->authorize('delete', Products::class);

    Products::destroy($products->id);

    return redirect('/dashboard/products')
      ->with('success', 'The selected Products object has been deleted!');
  }
}
