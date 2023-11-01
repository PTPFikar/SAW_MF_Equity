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
                    <span data-feather="settings"></span> Calculate
                </button>
            </div>
        </div>
    </form>
       <!-- Display Data if Available // Raw Data
    RAW data itu data apa adanya dari Tabel Product, untuk yg deviden jika YES = 2 jika NO = 1
    -->
       @if(isset($results))
       <div class="table-responsive col-lg-10 text-center">
           <br>
           <h1 class="h2">Raw Data</h1>
       </div>
       <div class="table-responsive col-lg-10">
           <table class="table table-striped">
               <thead>
                   <tr>
                       <th scope="col" class="text-center">ISIN</th>
                       <th scope="col" class="text-center">Product Name</th>
                       <th scope="col" class="text-center">C1</th>
                       <th scope="col" class="text-center">C2</th>
                       <th scope="col" class="text-center">C3</th>
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
                   </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
       @endif
    <!-- Display Data if Available // Normalization 
    Normalisasi itu adalah nilai product yang dibagi dengan nilai MaxValue per kriteria karena BENEFIT semua
    -->
    @if(isset($results))
    <div class="table-responsive col-lg-10 text-center">
        <br>
        <h1 class="h2">Normalization Data</h1>
    </div>
    <div class="table-responsive col-lg-10">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ISIN</th>
                    <th scope="col" class="text-center">Product Name</th>
                    <th scope="col" class="text-center">C1</th>
                    <th scope="col" class="text-center">C2</th>
                    <th scope="col" class="text-center">C3</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <!-- Display Preferences Data // Preferences -->
    @if(isset($results))
    <div class="table-responsive col-lg-10 text-center">
        <br>
        <h1 class="h2">Preferences Data</h1>
    </div>
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
            <button type="submit" class="btn btn-warning mb-3">
                <span data-feather="download"></span> Download
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
