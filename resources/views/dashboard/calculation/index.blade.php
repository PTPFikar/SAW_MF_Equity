@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Calculation SAW</h1>
    </div>
    <form method="post" action="{{ route('calculateSAW') }}">
        @csrf
        <div class="row">
            <label for="date" class="form-label">Select Date</label>
            <div class="col-lg-2">
                <input type="date" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" required
                    value="{{ $date ?? '' }}">
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-gear-fill"></i> Calculate
                </button>
            </div>
        </div>
    </form>
       <!-- Display Data if Available // Raw Data -->
       @if(isset($rawData))
       <div class="table-responsive col-lg-12 text-center">
           <br>
           <h1 class="h2">Matrix Data</h1>
       </div>
       <div class="table-responsive col-lg-12">
           <table class="table table-striped">
               <thead>
                   <tr>
                       <th scope="col" class="text-center">ISIN</th>
                       <th scope="col" class="text-center">Product Name</th>
                       <th scope="col" class="text-center">Sharpe Ratio</th>
                       <th scope="col" class="text-center">AUM</th>
                       <th scope="col" class="text-center">Deviden</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($rawData as $data)
                   <tr>
                       <td class="text-center">{{ $data['ISIN'] }}</td>
                       <td>{{ $data['productName'] }}</td>
                       <td class="text-center">{{ number_format($data['C1'], 4) }}</td>
                       <td class="text-center">{{ number_format($data['C2'], 2) }}</td>
                       <td class="text-center">{{ ($data['C3']) }}</td>
                   </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
       @endif
    <!-- Display Data if Available // Normalization -->
    @if(isset($normalizedData))
    <div class="table-responsive col-lg-12 text-center">
        <br>
        <h1 class="h2">Normalization Data</h1>
    </div>
    <div class="table-responsive col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ISIN</th>
                    <th scope="col" class="text-center">Product Name</th>
                    <th scope="col" class="text-center">Sharpe Ratio</th>
                    <th scope="col" class="text-center">AUM</th>
                    <th scope="col" class="text-center">Deviden</th>
                </tr>
            </thead>
            <tbody>
                @foreach($normalizedData as $n_data)
                <tr>
                    <td class="text-center">{{ $n_data['ISIN'] }}</td>
                    <td>{{ $n_data['productName'] }}</td>
                    <td class="text-center">{{ number_format($n_data['C1'], 4) }}</td>
                    <td class="text-center">{{ number_format($n_data['C2'], 4) }}</td>
                    <td class="text-center">{{ number_format($n_data['C3'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <!-- Display Preferences Data // Preferences -->
    @if(isset($results))
    <div class="table-responsive col-lg-12 text-center">
        <br>
        <h1 class="h2">Preferences Data</h1>
    </div>
    <div class="table-responsive col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ISIN</th>
                    <th scope="col" class="text-center">Product Name</th>
                    <th scope="col" class="text-center">Sharpe Ratio</th>
                    <th scope="col" class="text-center">AUM</th>
                    <th scope="col" class="text-center">Deviden</th>
                    <th scope="col" class="text-center">Result Total</th>
                    <th scope="col" class="text-center">Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weightedData as $result)
                <tr>
                    <td class="text-center">{{ $result['ISIN'] }}</td>
                    <td>{{ $result['productName'] }}</td>
                    <td class="text-center">{{ number_format($result['C1'], 2) }}</td>
                    <td class="text-center">{{ number_format($result['C2'], 2) }}</td>
                    <td class="text-center">{{ number_format($result['C3'], 2) }}</td>
                    <td class="text-center">{{ number_format($result['sumResult'], 2) }}</td>
                    <td class="text-center">{{ $result['rank'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('calculate.exports', $date) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning mb-3">
                <span data-feather="download"></span> Download
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
