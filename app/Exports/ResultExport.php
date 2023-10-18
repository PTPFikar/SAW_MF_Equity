<?php

namespace App\Exports;

use App\Models\Products;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResultExport implements FromCollection, WithHeadings
{
    protected $results;
 
    // Head Column in Excel
    public function __construct($results)
    {
        $this->results = $results;
    }
    public function headings(): array
    {
        return [
            'ID',
            'ISIN',
            'Product Name',
            'C1',
            'C2',
            'C3',
            'Result Total',
            'Rank',
        ];
    }

    // Result Export
    public function collection()
    {
        return $this->results;
    }
}
