@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Calculation SAW</h1>
    </div>
    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif
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
    @if (session('error'))
        <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Display Data if Available -->
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
                    <td class="text-center">{{ $result['ISIN'] }}</td>
                    <td>{{ $result['productName'] }}</td>
                    <td class="text-center">{{ number_format($result['C1'], 2) }}</td>
                    <td class="text-center">{{ number_format($result['C2'], 2) }}</td>
                    <td class="text-center">{{ number_format($result['C3'], 2) }}</td>
                    <td class="text-center">{{ number_format($result['Result'], 2) }}</td>
                    <td class="text-center">{{ $result['Rank'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('calculate.exports', $date) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success mb-3">
            Download
            </button>
        </form>
       
    </div>
    @endif
@endsection