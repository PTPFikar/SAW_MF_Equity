<?php

namespace App\Http\Requests\Products;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProductsUpdateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $id = $this->route('products')->id;

    return [
      'sharpRatio'  => 'required',
      'AUM'         => 'required',
      'deviden'     => 'required',
    ];
  }
}
