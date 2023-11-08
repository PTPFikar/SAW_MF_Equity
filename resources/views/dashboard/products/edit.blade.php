@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data</h1>
  </div>

  <form class="col-lg-8" method="POST" action="{{ route('product.update', $object->id) }}">
    @method('PUT')
    @csrf

    <div class="mb-3">
      <label for="ISIN" class="form-label">ISIN</label>
      <input type="text" class="form-control" id="ISIN" name="ISIN" value="{{ ($object->ISIN) }}">
    </div>

    @error('ISIN')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

    <div class="mb-3">
      <label for="productName" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="productName" name="productName" value="{{ old('name', $object->productName) }}">
    </div>

    @error('productName')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

      <div class="mb-3">
        <label for="expectReturn" class="form-label">Expect Return</label>
        <input type="number" step="0.0001" class="form-control @error('expectReturn') is-invalid @enderror" id="expectReturn" name="expectReturn" value="{{ old('expectReturn', $object->expectReturn) }}" required>
  
    @error('expectReturn')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror    
      
      <div class="mb-3">
        <label for="standardDeviation" class="form-label">Standard Deviation</label>
        <input type="number" step="0.0001" class="form-control @error('standardDeviation') is-invalid @enderror" id="standardDeviation" name="standardDeviation" value="{{ old('standardDeviation', $object->standardDeviation) }}" required>
    
    @error('standardDeviation')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

      <div class="mb-3">
        <label for="risk" class="form-label">Risk Free</label>
        @php
            $riskPercentage = $risk * 100;
        @endphp
        <input type="text" class="form-control" id="risk" name="risk" value="{{ old('risk', number_format($riskPercentage, 2) . '%') }}" readonly>
        
      <div class="mb-3">
        <label for="sharpeRatio" class="form-label">Sharpe Ratio</label>
        <input type="text" class="form-control" id="sharpeRatio" name="sharpeRatio" value="{{ old('sharpeRatio', $object->sharpeRatio) }}" readonly>

      <div class="mb-3">
        <label for="AUM" class="form-label">AUM</label>
        <input type="number" class="form-control @error('AUM') is-invalid @enderror" id="AUM" name="AUM" value="{{ old('AUM', $object->AUM) }}" required>

    @error('AUM')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

      <div class="mb-3">
        <label for="deviden" class="form-label">Deviden</label>
        <select class="form-select @error('deviden') is-invalid @enderror" id="deviden" name="deviden" required>
          <option value="2" {{ old('deviden', $object->deviden) == '2' ? 'selected' : '' }}>YES</option>
          <option value="1" {{ old('deviden', $object->deviden) == '1' ? 'selected' : '' }}>NO</option>
        </select>

    @error('deviden')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $object->date) }}" required>

    @error('date')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    
    </div>
    <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
    <a href="/dashboard/products" class="btn btn-danger mb-3">Cancel</a>
  </form>

  <script>
    // Add JavaScript to calculate the Sharpe Ratio
    document.addEventListener("DOMContentLoaded", function () {
      const expectReturn = document.getElementById("expectReturn");
      const standardDeviation = document.getElementById("standardDeviation");
      const sharpeRatio = document.getElementById("sharpeRatio");
  
      expectReturn.addEventListener("input", calculateSharpeRatio);
      standardDeviation.addEventListener("input", calculateSharpeRatio);
  
      function calculateSharpeRatio() {
        const expectReturnValue = parseFloat(expectReturn.value);
        const standardDeviationValue = parseFloat(standardDeviation.value);
        const risk = parseFloat(document.getElementById("risk").value) / 100;
  
        if (!isNaN(expectReturnValue) && !isNaN(standardDeviationValue) && standardDeviationValue !== 0) {
          const calculatedSharpeRatio = (expectReturnValue-risk) / standardDeviationValue;
          sharpeRatio.value = calculatedSharpeRatio.toFixed(4);
        } else {
          sharpeRatio.value = "";
        }
      }
    });
  </script>
@endsection