<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Risks;
use App\Jobs\ItemCSVUploadJob;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

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
        
        // Check File Type
        if (!$file->isValid()) {
            return redirect()->back()->with('failed', 'The Uploaded File is Not a CSV or TXT File');
        }

        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);

        $errors = []; 

        foreach ($csv as $row) {
            if (
                !isset($row['ISIN']) ||
                !isset($row['Product Name']) ||
                !isset($row['Expect Return 1 Year']) ||
                !isset($row['Standard Deviation 1 Year']) ||
                !isset($row['Asset Under Management (AUM)']) ||
                !isset($row['Deviden']) ||
                !isset($row['Date'])
            ) {
                $errors[] = 'Column Name Does Not Match';
                break;
            }

            $isin = $row['ISIN'];
            $productName = $row['Product Name'];
            $expectReturn = floatval($row['Expect Return 1 Year']);
            $standardDeviation = floatval($row['Standard Deviation 1 Year']);
            $aum = floatval($row['Asset Under Management (AUM)']);
            $dividend = $row['Deviden'];
            $date = $row['Date'];

            // Check if Required Fields are Empty
            if (empty($isin) || empty($productName) || empty($date)) {
                $errors[] = 'Missing Required Field For a Product';
                break;
            }

            // Check if Date is Incorrect Date Format
            if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date) || strtotime($date) === false) {
                $errors[] = 'Incorrect Date Format. Must Be YYYY-MM-DD';
                break;
            }

            // Check if expectReturn is Not Number
            if ($expectReturn == 0) {
                $errors[] = 'Expect Return Must Input a Number and Cannot Be Zero or Blank';
                break;
            }

            // Check if standarDeviasi is Not Number
            if ($standardDeviation == 0) {
                $errors[] = 'Standar Deviasi Must Input a Number and Cannot Be Zero or Blank';
                break;
            }

            // Check if aum is Not Zero
            if ($aum == 0) {
                $errors[] = 'AUM Must Input a Number and Cannot Be Zero or Blank';
                break;
            }            

            // Check if 'dividend' Value Not Valid
            if ($dividend !== 'YES' && $dividend !== 'NO') {
                $errors[] = 'Invalid Value For Deviden. It Should Be YES or NO';
                break;
            }

            // Check Products
            $product = Products::where('date', $date)->where('isin', $isin)->first();
            $risk = Risks::find(1); 

            if (!$product) {
                $product = new Products();
                $product->ISIN = $isin;
                $product->productName = $productName;
                $product->expectReturn = $expectReturn;
                $product->standardDeviation = $standardDeviation;
                $product->sharpeRatio = ($standardDeviation != 0) ? ($expectReturn-$risk->risk) / $standardDeviation : 0;
                $product->AUM = $aum;
                $product->deviden = ($dividend === 'YES') ? 2 : 1;
                $product->date = $date;
                $product->save();
            } else {
                $product->expectReturn = $expectReturn;
                $product->standardDeviation = $standardDeviation;
                $product->sharpeRatio = ($standardDeviation != 0) ? ($expectReturn-$risk->risk) / $standardDeviation : 0;
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
        return redirect()->back()->with('success', 'CSV Data Imported Successfully.');
    }

}
