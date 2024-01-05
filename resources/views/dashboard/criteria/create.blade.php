@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Criteria</h1>
  </div>

  <form class="col-lg-8" method="POST" action="{{ route('criteria.store') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" pattern="[a-zA-Z0-9]+" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus required>
      <small class="text-muted">Alphanumeric characters only (no spaces).</small>

      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="criteriaName" class="form-label">Criteria Name</label>
      <input type="text" class="form-control @error('criteriaName') is-invalid @enderror" id="criteriaName" name="criteriaName" value="{{ old('criteriaName') }}" autofocus required>
      
      @error('criteriaName')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="attribute" class="form-label">Attribute</label>
      <select class="form-select @error("attribute") is-invalid @enderror" id="attribute" name="attribute" required>
        <option value="" disabled selected>Choose One</option>
        <option value="BENEFIT" {{ old('attribute') === 'BENEFIT' ?  'selected' : '' }}>BENEFIT</option>
        <option value="COST" {{ old('attribute') === 'COST' ?  'selected' : '' }}>COST</option>
      </select>

      @error('attribute')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="weight" class="form-label">Weight</label>
      <input type="number" pattern="\d+" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight') }}" required>
      <small class="text-muted">Only integer values allowed.</small>
    </div>

    @error('weight')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

    <button type="submit" class="btn btn-primary mb-3">Save</button>
    <a href="{{ route('criteria.index') }}" class="btn btn-danger mb-3">Cancel</a>
  </form>
@endsection
