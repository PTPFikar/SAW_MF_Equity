<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductsUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'sharpeRatio'  => 'required',
      'AUM'         => 'required',
      'deviden'     => 'required',
    ];
  }
}
