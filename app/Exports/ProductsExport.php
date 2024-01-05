<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductsExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'ISIN',
            'Product Name',
            'Expect Return 1 Year',
            'Standard Deviation 1 Year',
            'Sharpe Ratio',
            'AUM',
            'Deviden',
            'Date',
        ];
    }

    public function collection()
    {
        $products = Products::select('ISIN', 'productName', 'expectReturn', 'standardDeviation', 'sharpeRatio', 'AUM', 'deviden', 'date')
            ->orderBy('productName', 'asc')
            ->orderBy('date', 'asc')
            ->get();

        $products->transform(function ($product) {
            $product->deviden = $product->deviden == 2 ? 'YES' : 'NO';
            $product->expectReturn = $product->expectReturn * 100 . '%';
            $product->standardDeviation = $product->standardDeviation * 100 . '%';
            return $product;
        });

        return $products;
    }
}
