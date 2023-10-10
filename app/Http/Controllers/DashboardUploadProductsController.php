<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Jobs\ItemCSVUploadJob;
use Illuminate\Support\Facades\Storage;

class DashboardUploadProductsController extends Controller
{
    public function index()
    {
        return view('dashboard.uploadproducts.index', [
            'title'     => 'UploadProducts',
            'objects' => Products::all()
          ]);
    }

    public function upload_csv_file(Request $request)
    {
        if( $request->has('csv') ) {

            $csv    = file($request->csv);
            $chunks = array_chunk($csv,1000);
            $header = [];

            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }

                ItemCSVUploadJob::dispatch($data, $header);                
            }

        }
        return "please upload CSV file";
    }
    

}
