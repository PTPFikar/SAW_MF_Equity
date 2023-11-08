@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Risk Free</h1>
  </div>
  <div class="table-responsive col-lg-10">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">Risk Free (%)</th>
        </tr>
      </thead>
      <tbody>
        @if ($objects->count())
          @foreach ($objects as $object)
            <tr>
              <td class="text-center">{{ number_format($object->risk * 100, 2) }}%</td>
              <td class="text-center">
                <a href="{{ route('risk.edit', $object->id) }}" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
    <b><i><font size="2">*Risk Free digunakan dalam perhitungan sharpe ratio</font></i></b><br>
  </div>
@endsection
