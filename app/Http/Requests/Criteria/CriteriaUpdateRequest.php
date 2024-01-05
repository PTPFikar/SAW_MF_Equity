<?php

namespace App\Http\Requests\Criteria;

use Illuminate\Foundation\Http\FormRequest;

class CriteriaUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name'          => 'required',
      'criteriaName'  => 'required',
      'attribute'     => 'required',
      'weight'        => 'required|numeric|min:0|max:100',
    ];
  }
}