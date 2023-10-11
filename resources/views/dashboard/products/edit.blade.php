@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data</h1>
  </div>

  <form class="col-lg-8" method="POST" action="/dashboard/products/edit/{{ $object->id }}">
    @method('POST')
    @csrf

    <div class="mb-3">
      <label for="ISIN" class="form-label">ISIN</label>
      <input type="text" class="form-control" id="ISIN" name="ISIN" value="{{ ($object->ISIN) }}" required>
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $object->productName) }}" required>
    </div>

    <div class="mb-3">
      <label for="sharpRatio" class="form-label">Sharp Ratio</label>
      <input type="number" step="0.0001" class="form-control @error('sharpRatio') is-invalid @enderror" id="sharpRatio" name="sharpRatio" value="{{ old('sharpRatio', $object->sharpRatio) }}" required>

      @error('sharpRatio')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="AUM" class="form-label">AUM</label>
      <input type="number" class="form-control @error('AUM') is-invalid @enderror" id="AUM" name="AUM" value="{{ old('AUM', $object->AUM) }}" required>

      @error('address')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="deviden" class="form-label">Deviden</label>
      <select class="form-select @error("deviden") is-invalid @enderror" id="deviden" name="deviden" required>
        <option value="" disabled selected>Choose One</option>
        <option value="1" {{ old('deviden', $object->deviden) === '1' ?  'selected' : '' }}>YES</option>
        <option value="0" {{ old('deviden', $object->deviden) === '0' ?  'selected' : '' }}>NO</option>
      </select>

      @error('deviden')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
    <a href="/dashboard/products" class="btn btn-danger mb-3">Cancel</a>
  </form>
@endsection