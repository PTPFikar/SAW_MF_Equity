<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  use HasFactory;

  protected $fillable = [
    'criteria_first_value',
    'criteria_second_value',
    'criteria_third_value',
    'criteria_result',
    'criteria_rank',
  ];
}
