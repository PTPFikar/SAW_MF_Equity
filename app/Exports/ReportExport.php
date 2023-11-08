<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection, WithHeadings
{
    protected $results;
    protected $rawData;

    public function __construct($results, $rawData)
    {
        $this->results = $results;
        $this->rawData = $rawData;
    }

    public function headings(): array
    {
        return [
            'ID',
            'ISIN',
            'Product Name',
            'Expect Return 1 Year',
            'Sharpe Ratio',
            'AUM',
            'Result Total',
            'Rank',
        ];
    }

    public function collection()
    {
        return collect($this->results)->map(function ($result) {
            return [
                'ID' => $result['ID'],
                'ISIN' => $result['ISIN'],
                'Product Name' => $result['productName'],
                'Expect Return 1 Year' => $this->rawData[$result['ID']]['expectReturn'],
                'Sharpe Ratio' => $this->rawData[$result['ID']]['C1'],
                'AUM' => $this->rawData[$result['ID']]['C2'],
                'Result Total' => number_format($result['Result'], 2),
                'Rank' => $result['Rank'],
            ];
        });
    }
}
