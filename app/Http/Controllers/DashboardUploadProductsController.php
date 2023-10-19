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

        // Cek tipe file
        if (!$file->isValid()) {
            return back()->with('failed', 'File yang diunggah bukan berkas CSV atau teks.');
        }

        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);

        $errors = []; // Inisialisasi sebagai array kosong

        foreach ($csv as $row) {
            if (
                !isset($row['ISIN']) ||
                !isset($row['Product Name']) ||
                !isset($row['Expect Return 1 Year']) ||
                !isset($row['Standar Deviasi']) ||
                !isset($row['Asset Under Management (AUM)']) ||
                !isset($row['Deviden']) ||
                !isset($row['Date'])
            ) {
                $errors[] = 'Data tidak sesuai: Struktur data dalam CSV tidak sesuai dengan yang diharapkan.';
                break;
            }

            $isin = $row['ISIN'];
            $productName = $row['Product Name'];
            $expectReturn = floatval($row['Expect Return 1 Year']);
            $standarDeviasi = floatval($row['Standar Deviasi']);
            $aum = floatval($row['Asset Under Management (AUM)']);
            $dividend = $row['Deviden'];
            $date = $row['Date'];

            // Check if required fields are empty
            if (empty($isin) || empty($productName) || empty($date)) {
                $errors[] = 'Missing required field for a product.';
                break;
            }

            // Check if standarDeviasi is not zero
            if ($standarDeviasi == 0) {
                $errors[] = 'Standar Deviasi should not be zero.';
                break;
            }

            // Check if 'dividend' value is valid
            if ($dividend !== 'YES' && $dividend !== 'NO') {
                $errors[] = 'Invalid value for Deviden. It should be "YES" or "NO.';
                break;
            }

            // Check products
            $product = Products::where('date', $date)->where('isin', $isin)->first();

            if (!$product) {
                $product = new Products();
                $product->ISIN = $isin;
                $product->productName = $productName;
                $product->sharpRatio = ($standarDeviasi != 0) ? $expectReturn / $standarDeviasi : 0;
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 2 : 1;
                $product->date = $date;
                $product->save();
            } else {
                $product->sharpRatio = ($standarDeviasi != 0) ? $expectReturn / $standarDeviasi : 0;
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 2 : 1;
                $product->date = $date;
                $product->save();
            }
        }

        if (count($errors) > 0) {
            $errorMessage = implode(' ', $errors);
            return back()->with('failed', $errorMessage);
        }
        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }

}
