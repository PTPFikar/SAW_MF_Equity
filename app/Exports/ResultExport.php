<?php

namespace App\Exports;

use App\Models\Products;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResultExport implements FromCollection, WithHeadings
{
    private $results;

    public function headings(): array
    {
        return [
            'ISIN',
            'Product Name',
            'C1',
            'C2',
            'C3',
            'Result Total',
            'Rank',
        ];
    }

    public function collection()
    {
        // Mengambil data produk (alternatif) dari model Product
        $input = $request->all();
        $date = $input['date'];
        $alternatives = Products::where('date', $date)->get();

       // Mengambil data kriteria dari model Criteria
       $criterias = Criteria::all();

       // Maksimum nilai untuk tiap kriteria
       $maxValues = [];

       foreach ($criterias as $criteria) {
           // Jika atribut adalah COST, gunakan min() untuk mencari nilai terendah
           if ($criteria->attribute === 'COST') {
               $maxValues[$criteria->name] = $alternatives->min($criteria->name);
           } else {
               // Jika atribut adalah BENEFIT, gunakan max() untuk mencari nilai tertinggi
               $maxValues[$criteria->name] = $alternatives->max($criteria->name);
           }
       }

       // Hitung nilai preferensi
       $preferences = [];

       foreach ($alternatives as $alternative) {
           $preferenceValue = 0;

           // Hitung 'C1', 'C2', dan 'C3' berdasarkan kriteria dan alternatif
           $c1 = $alternative->sharpRatio;
           $c2 = $alternative->AUM;
           $c3 = $alternative->deviden;
           
           foreach ($criterias as $criteria) {
               if ($maxValues[$criteria->name] != 0) {
                   // Jika atribut adalah COST, gunakan min() untuk mencari nilai terendah
                   if ($criteria->attribute === 'COST') {
                       $preferenceValue += $criteria->weight * ($maxValues[$criteria->name] / $alternative->{$criteria->name});
                   } else {
                       // Jika atribut adalah BENEFIT, gunakan max() untuk mencari nilai tertinggi
                       $preferenceValue += $criteria->weight * ($alternative->{$criteria->name} / $maxValues[$criteria->name]);
                   }
               } else {
                   $preferenceValue = 0;
                   break;
               }
           }

           $preferences[$alternative->id] = [
               'C1' => $c1,
               'C2' => $c2,
               'C3' => $c3,
               'ResultTotal' => $preferenceValue,
           ];
       }

       $alternatives = $alternatives->map(function ($alternative) use ($preferences) {
           $alternative->c1 = $preferences[$alternative->id]['C1'];
           $alternative->c2 = $preferences[$alternative->id]['C2'];
           $alternative->c3 = $preferences[$alternative->id]['C3'];
           $alternative->preferenceValue = $preferences[$alternative->id]['ResultTotal'];
           return $alternative;
       })->sortByDesc('preferenceValue');

       $results = [];
       $rank = 1;

       foreach ($alternatives as $alternative) {
           $results[] = [
               'ID' => $alternative->id,
               'ISIN' => $alternative->ISIN,
               'productName' => $alternative->productName,
               'C1' => $alternative->c1,
               'C2' => $alternative->c2,
               'C3' => $alternative->c3,
               'Result' => $alternative->preferenceValue,
               'Rank' => $rank,
           ];

           $rank++;
       }
       return $results;
    }
}
