<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class UploadProducts extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'ISIN',
      'productName',
      'expectReturn',
      'standardDeviation',
      'sharpeRatio',
      'AUM',
      'deviden',
      'date',
      'created_at',
      'updated_at'
      ];
}