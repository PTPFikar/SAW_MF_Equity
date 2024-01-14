<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  use HasFactory;
  
  protected $fillable = [
    'id',
    'ISIN',
    'productName',
    'expectReturn',
    'sharpeRatio',
    'AUM',
    'deviden',
    'standardDeviation',
    'date',
    'created_at',
    'updated_at'
  ];
}
