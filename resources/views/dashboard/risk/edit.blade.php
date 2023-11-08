@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Risk</h1>
  </div>

  <form class="col-lg-8" method="POST" action="{{ route('risk.update', $object->id) }}">
    @method('PUT')
    @csrf

    <div class="mb-3">
      <label for="risk" class="form-label">Risk Free (%)</label>
      <input type="number" step="0.01" class="form-control @error('risk') is-invalid @enderror" id="risk" name="risk" value="{{ old('risk', $object->risk * 100) }}" required>

      @error('risk')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
    <a href="/dashboard/risks" class="btn btn-danger mb-3">Cancel</a>
  </form>
@endsection
