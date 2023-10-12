@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Calculation SAW</h1>
    </div>
    <form method="post" action="{{ route('calculateSAW') }}">
        @csrf
        <div class="table-responsive col-lg-2">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary mb-3 lg-2">
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
                    <td>{{ $result['C1'] }}</td>
                    <td>{{ $result['C2'] }}</td>
                    <td>{{ $result['C3'] }}</td>
                    <td>{{ $result['result'] }}</td>
                    <td>{{ $result['Rank'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection
