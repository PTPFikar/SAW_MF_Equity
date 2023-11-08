@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Products</h1>
  </div>

  <div class="table-responsive col-lg-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">ISIN</th>
          <th scope="col" class="text-center">Product Name</th>
          <th scope="col" class="text-center">Expect Return 1 Year</th>
          <th scope="col" class="text-center">Standard Deviation 1 Year</th>
          <th scope="col" class="text-center">Sharpe Ratio</th>
          <th scope="col" class="text-center">AUM</th>
          <th scope="col" class="text-center">Deviden</th>
          <th scope="col" class="text-center">Date</th>
        </tr>
      </thead>
      <tbody>
        @if ($objects->count())
          @foreach ($objects as $object)
            <tr>
              {{-- $loop->iteraion => The number / Order of the loop --}}
              <td class="text-center">{{ $loop->iteration }}</td>
              <td class="text-center">{{ $object->ISIN }}</td>
              <td class>{{ $object->productName }}</td>
              <td class="text-center">{{ $object->expectReturn }}</td>
              <td class="text-center">{{ $object->standardDeviation }}</td>
              <td class="text-center">{{ $object->sharpeRatio }}</td>
              <td class="text-center">{{ $object->AUM }}</td>
              <td class="text-center">{{ $object->deviden == 2 ? 'YES': 'NO' }}</td>
              <td class="text-center">{{ $object->date }}</td>
              <td class="text-center">
                <a href="{{route('product.edit', $object->id)}}" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
                <form action="{{route('product.delete', $object->id)}}" method="POST" class="d-inline">
                  @method('DELETE')
                  @csrf

                  <span role="button" class="text-decoration-none text-danger btnDelete" data-object="products">
                    <span data-feather="x-circle"></span>
                  </span>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="7" class="text-danger text-center p-3">
              <h4>You Haven't Create Any Products Objects Yet</h4>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
    <b><i><font size="2">*Nilai Deviden "YES" bukan berarti akan selalu mendapatkan keuntungan</font></i></b>
    <br>
    {{ $objects->links() }}
      <a href="products/export_excel">
        <button type="submit" class="btn btn-warning mb-3">
          <span data-feather="download"></span> Download
        </button>
      </a>
  </div>
@endsection