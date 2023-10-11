<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Jobs\ItemCSVUploadJob;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class DashboardUploadProductsController extends Controller
{
    public function index()
    {
        $products = Products::paginate(10);
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
            $expectReturn = $row['Expect Return 1 Year'];
            $standartDeviasi = $row['Standar Deviasi'];
            $aum = $row['Asset Under Management (AUM)'];
            $dividend = $row['Deviden'];
            $date = $row['Date'];
    
            // Cari data produk berdasarkan "isin" atau "productName"
            $product = Products::where('isin', $isin)->orWhere('productName', $productName)->first();
            if (!$product) {
                // Jika produk belum ada, buat entri baru
                $product = new Products();
                $product->ISIN = $isin;
                $product->productName = $productName;
                $product->sharpRatio = $expectReturn / $standartDeviasi;
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 1 : 0; // Konversi "YES" menjadi "YES" atau "NO"
                $product->date = $date;
                $product->save();
            } else {
                // Jika produk sudah ada, update nilainya

                $product->sharpRatio = $expectReturn / $standartDeviasi;
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 1 : 0;
                $product->date = $date;
                $product->save();
            }

        }
        $products = Products::all();
        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }
}
