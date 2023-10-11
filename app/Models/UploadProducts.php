<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class UploadProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'ISIN',
        'productName',
        'expectReturn',
        'standarDeviasi',
        'AUM',
        'deviden',
        'date'
      ];
}