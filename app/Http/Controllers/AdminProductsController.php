<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Models\Risks;
use Maatwebsite\Excel\Facades\Excel;

class AdminProductsController extends Controller
{
  public function index()
  {
    $this->authorize('viewAny', Products::class);

    return view('dashboard.products.index', [
      'title' => 'Products',
      'objects' => Products::orderBy('date', 'asc')->orderBy('productName', 'asc')->paginate(10)
    ]);
  }

  // Edit Data Products
  public function edit($id)
  {
    $this->authorize('update', Products::class);
    $products = Products::select('*')->where('id', $id)->first();
    $risk = Risks::find(1);

    return view('dashboard.products.edit', [
      'title'  => "Edit $products->id",
      'object' => $products,
      'risk' => $risk ? $risk->risk : 0.5500,
    ]);
  }

  // Req Update Data Products
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'sharpeRatio'  => 'required',
      'AUM'         => 'required',
      'deviden'     => 'required',
     ]);

     $products = Products::find($id);
     $products->ISIN = $request->ISIN;
     $products->productName = $request->productName;
     $products->expectReturn = $request->expectReturn;
     $products->standardDeviation = $request->standardDeviation;
     $products->sharpeRatio = $request->sharpeRatio;
     $products->AUM = $request->AUM;
     $products->deviden = $request->deviden;
     $products->date = $request->date;
     $products->save();

    return redirect('/dashboard/products')
      ->with('success', 'The Selected Products Object Has Been Updated!');
  }

  // Delete Data Products
  public function destroy($id)
  {
    $this->authorize('delete', Products::class);
    $products = Products::find($id);
    $products->delete();

    return redirect('/dashboard/products')
      ->with('success', 'The Selected Products Object Has Been Deleted!');
  }

  public function export_excel(Request $request)
  {
      return Excel::download(new ProductsExport($request), 'products.xlsx');
  }
}
