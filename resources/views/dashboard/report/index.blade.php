@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Report</h1>
    </div>
    <form method="post" action="{{ route('reportSAW') }}">
        @csrf
        <div class="row">
            <label for="date" class="form-label">Select Date</label>
            <div class="col-lg-2">
                <input type="date" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" required value="{{ $date ?? '' }}">
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-gear"></i> Preview
                </button>
            </div>
        </div>
    </form>
       <!-- Display Data if Available // Raw Data -->
       @if(isset($rawData))
            <div class="table-responsive col-lg-12 text-center">
                <br>
                <h1 class="h2">Report Rank Product</h1>
            </div>
            <div class="table-responsive col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ISIN</th>
                            <th scope="col" class="text-center">Product Name</th>
                            <th scope="col" class="text-center">Expect Return 1 Year</th>
                            <th scope="col" class="text-center">Sharpe Ratio</th>
                            <th scope="col" class="text-center">AUM</th>
                            <th scope="col" class="text-center">Deviden</th>
                            <th scope="col" class="text-center">Result SAW</th>
                            <th scope="col" class="text-center">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                        <tr>
                            <td class="text-center">{{ $result['ISIN'] }}</td>
                            <td>{{ $result['productName'] }}</td>
                            <td class="text-center">{{ $rawData[$result['ID']]['expectReturn'] }}</td>
                            <td class="text-center">{{ $rawData[$result['ID']]['C1'] }}</td>
                            <td class="text-center">{{ $rawData[$result['ID']]['C2'] }}</td>
                            <td class="text-center">{{ $rawData[$result['ID']]['C3'] == 2 ? 'YES': 'NO' }}</td>
                            <td class="text-center">{{ number_format($result['Result'], 2) }}</td>
                            <td class="text-center">{{ $result['Rank'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('report.exports', $date) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning mb-3">
                        <span data-feather="download"></span> Download
                    </button>
                </form>
            </div>
       @endif
</div>
@endsection
