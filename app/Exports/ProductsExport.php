<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Nette\Utils\Strings;
use PhpParser\Node\Expr\Cast\String_;

class ProductsExport implements FromCollection, WithHeadings
{
    // Head Column in Excel
    public function headings(): array
    {
        return [
            'ISIN',
            'Product Name',
            'Sharp Ratio',
            'AUM',
            'Deviden',
            'Date'
        ];
    }

    // Result Export
    public function collection()
    {
        return Products::select('ISIN', 'productName', 'sharpRatio', 'AUM', 'deviden', 'date')->get();
    }
}
