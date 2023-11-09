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
        $mappedResults = [];

        foreach ($this->results as $result) {
            $id = $result['ID'];
            foreach ($this->rawData as $data) {
        // dd($data);

                if ($data['id'] == $id) {
                    $mappedResults[] = [
                        'ID' => $id,
                        'ISIN' => $result['ISIN'],
                        'Product Name' => $result['productName'],
                        'Expect Return 1 Year' => $data['expectReturn'],
                        'Sharpe Ratio' => $data['sharpeRatio'],
                        'AUM' => $data['AUM'],
                        'Result Total' => number_format($result['Result'], 2),
                        'Rank' => $result['Rank']
                    ];
                }
            }
        }
        // dd($mappedResults);
        return collect($mappedResults);
    }

}
