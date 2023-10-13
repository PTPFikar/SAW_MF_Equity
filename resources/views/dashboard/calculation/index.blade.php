@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Calculation SAW</h1>
    </div>
    <form method="post" action="{{ route('calculateSAW') }}">
        @csrf
        <div class="table-responsive col-lg-2">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="date" name="date" required
            value="{{ $date ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary">
            <span data-feather="check-square"></span>
            Calculate
        </button>
    </form>
    <!-- Display results if available -->
    @if(isset($results))
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
                @foreach($results as $result)
                <tr>
                    <td>{{ $result['ISIN'] }}</td>
                    <td>{{ $result['productName'] }}</td>
                    <td>{{ number_format($result['C1'], 4) }}</td>
                    <td>{{ number_format($result['C2'], 2) }}</td>
                    <td>{{ number_format($result['C3'], 2) }}</td>
                    <td>{{ number_format($result['Result'], 4) }}</td>
                    <td>{{ $result['Rank'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="calculation/export_excel">
            <button type="submit" class="btn btn-success mb-3">
            Download
            </button>
          </a>
    </div>
    @endif
@endsection
