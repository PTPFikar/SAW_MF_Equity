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

        $csv = Reader::createFromPath($file->getPathname(), 'r'); // Use the Reader class
        $csv->setHeaderOffset(0);
    
        foreach ($csv as $row) {
            $isin = $row['ISIN'];
            $productName = $row['Product Name'];
            $expectReturn = floatval($row['Expect Return 1 Year']);
            $standarDeviasi = floatval($row['Standar Deviasi']);
            $aum = floatval($row['Asset Under Management (AUM)']);
            $dividend = $row['Deviden'];
            $date = $row['Date'];
            // dd($expectReturn);

            // Cari data produk berdasarkan "isin" atau "productName"
            $product = Products::where('isin', $isin)->orWhere('productName', $productName)->first();
            if (!$product) {
                // Jika produk belum ada, buat entri baru

                $product = new Products();
                $product->ISIN = $isin;
                $product->productName = $productName;
                if ($standarDeviasi != 0) {
                    $product->sharpRatio = $expectReturn / $standarDeviasi;
                } else {
                    $product->sharpRatio = 0;
                }
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 1 : 0; // Konversi "YES" menjadi "YES" atau "NO"
                if (!empty($date)) {
                    $product->date = $date;
                }
                $product->save();
            } else {
                // Jika produk sudah ada, update nilainya
                // dd($standarDeviasi);

                if ($standarDeviasi != 0) {
                    $product->sharpRatio = $expectReturn / $standarDeviasi;
                } else {
                    $product->sharpRatio = 0;
                }
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 1 : 0;
                if (!empty($date)) {
                    $product->date = $date;
                }
                $product->save();
            }

        }
        $products = Products::all();
        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }
}
