@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Criteria</h1>
  </div>

  <form class="col-lg-8" method="POST" action="{{ route('criteria.update', $object->id) }}">
    @method('PUT')
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $object->name) }}" readonly>
    </div>

    @error('criteriaName')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

    <div class="mb-3">
      <label for="criteriaName" class="form-label">Criteria Name</label>
      <input type="text" class="form-control" id="criteriaName" name="criteriaName" value="{{ old('criteriaName', $object->criteriaName) }}" readonly>
    </div>

    @error('criteriaName')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

    <div class="mb-3">
      <label for="attribute" class="form-label">Attribute</label>
      <select class="form-select @error('attribute') is-invalid @enderror" id="attribute" name="attribute" required>
        <option value="BENEFIT" @if(old('attribute', $object->attribute) === 'BENEFIT') selected @endif>BENEFIT</option>
        <option value="COST" @if(old('attribute', $object->attribute) === 'COST') selected @endif>COST</option>
      </select>
    </div>

    @error('attribute')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
      
      <div class="mb-3">
        <label for="weight" class="form-label">Weight</label>
        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $object->weight) }}" required>
      </div>

    @error('weight')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror

    <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
    <a href="/dashboard/criterias" class="btn btn-danger mb-3">Cancel</a>
  </form>
@endsection