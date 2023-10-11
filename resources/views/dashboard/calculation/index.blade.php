@extends('layouts.main')

@section('content')
  <style>
    .badge:hover {
      color: #fff !important;
      text-decoration: none;
    }

    .bg-success:hover {
      background: #2f9164 !important;
    }

    .bg-danger:hover {
      background: #e84a59 !important;
    }
  </style>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Calculation SAW</h1>
  </div>
  <div class="table-responsive col-lg-2">
    <label for="date" class="form-label">Select Date</label>
    <input type="date" class="form-control" id="date" name="date" required>
  </div>
  <button type="button" class="btn btn-primary mb-3 lg-2" data-bs-toggle="calculate" data-bs-target="#calculate">
    <span data-feather="check-square"></span>
    Calculate
  </button>
  <div class="table-responsive col-lg-10">
   
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">ISIN</th>
          <th scope="col" class="text-center">Product Name</th>
          <th scope="col" class="text-center">C1</th>
          <th scope="col" class="text-center">C2</th>
          <th scope="col" class="text-center">C3</th>
          <th scope="col" class="text-center">Result Total</th>
          <th scope="col" class="text-center">Rank</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($result as $result)
            <tr>
                <td>{{$result->ISIN}}</td>
                <td>{{$result->productName}}</td>
                <td>{{$result->criteria_first_value}}</td>
                <td>{{$result->criteria_second_value}}</td>
                <td>{{$result->criteria_third_value}}</td>
                <td>{{$result->criteria_result}}</td>
                <td>{{$result->criteria_rank}}</td>
                <td>{{$result->date}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
    <div class="table-responsive col-lg-10">
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="download" data-bs-target="#download">
        <span data-feather="download"></span>
        Download Excel
      </button>
  </div>
@endsection