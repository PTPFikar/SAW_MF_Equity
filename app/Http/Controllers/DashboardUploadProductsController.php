<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Jobs\ItemCSVUploadJob;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Ramsey\Uuid\Type\Decimal;

class DashboardUploadProductsController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('date', 'asc')->orderBy('productName', 'asc')->paginate(10);
        $title = 'Upload Products';
        return view('dashboard.uploadproducts.index', compact('products','title'));
    }

    public function upload_csv_file(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);
    
        $file = $request->file('file');

        $csv = Reader::createFromPath($file->getPathname(), 'r'); 
        $csv->setHeaderOffset(0);
    
        foreach ($csv as $row) {
            $isin = $row['ISIN'];
            $productName = $row['Product Name'];
            $expectReturn = floatval($row['Expect Return 1 Year']);
            $standarDeviasi = floatval($row['Standar Deviasi']);
            $aum = floatval($row['Asset Under Management (AUM)']);
            $dividend = $row['Deviden'];
            $date = $row['Date'];

            //Check products
            $product = Products::Where('date', $date)->Where('isin', $isin)->first();
            if (!$product) {
                $product = new Products();
                $product->ISIN = $isin;
                $product->productName = $productName;
                if ($standarDeviasi != 0) {
                    $product->sharpRatio = $expectReturn / $standarDeviasi;
                } else {
                    $product->sharpRatio = 0;
                }
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 2 : 1;
                if (!empty($date)) {
                    $product->date = $date;
                }
                $product->save();
            } else {
                if ($standarDeviasi != 0) {
                    $product->sharpRatio = $expectReturn / $standarDeviasi;
                } else {
                    $product->sharpRatio = 0;
                }
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 2 : 1;
                if (!empty($date)) {
                    $product->date = $date;
                }
                $product->save();
            }

        }
        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }
}
