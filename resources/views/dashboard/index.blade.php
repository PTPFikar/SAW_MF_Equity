@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome Back, {{ auth()->user()->name }}!</h1>
  </div>
  <div class="row">
    <div class="col-lg-4"> 
      <div class="card-data products">
        <div class="row">
          <div class="col-6"><i class="bi bi-database-check"></i></div>
          <div class="col-6 d-flex flex-column justify-content-center align-items-end">
            <div class="card-desc">Products</div>
            <div class="card-count">{{ $products_count }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4"> 
      <div class="card-data risks">
        <div class="row">
          <div class="col-6"><i class="bi bi-calculator"></i></div>
          <div class="col-6 d-flex flex-column justify-content-center align-items-end">
            <div class="card-desc">Risk Free</div>
            <div class="card-count">{{ number_format($risk * 100, 2) }}%</div>
            <div class="card-date">{{ $date }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
