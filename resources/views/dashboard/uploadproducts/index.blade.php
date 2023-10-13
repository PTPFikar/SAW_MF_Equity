@extends('layouts.main')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upload Products</h1>
  </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
         + Upload File
         </button>
         <a href="{{ asset('assets/example/Data_Product.csv') }}" download>
            <button type="submit" class="btn btn-warning mb-3">
            Download Sample
            </button>
         </a>

  <div class="row">     
      @if (session('success'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           {{ session('success') }}
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
      @endif
      
       <table class="table">
           <thead>
               <tr>
               <th scope="col">ISIN</th>
               <th scope="col">Product Name</th>
               <th scope="col">Sharp Ratio</th>
               <th scope="col">AUM</th>
               <th scope="col">Deviden</th>
               <th scope="col">Date</th>
               </tr>
           </thead>
           <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->ISIN}}</td>
                    <td>{{$product->productName}}</td>
                    <td>{{$product->sharpRatio}}</td>
                    <td>{{$product->AUM}}</td>
                    <td>{{$product->deviden == 2 ? 'YES': 'NO'}}</td>
                    <td>{{$product->date}}</td>
                </tr>
            @endforeach
           </tbody>
       </table>
       {{ $products->links() }}
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
           <form action="{{ route('upload_csv') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="input-group mb-3">
                   <input type="file" name="file" class="form-control">
                   <button class="btn btn-primary" type="submit">Submit</button>
               </div>
           </form>
       </div>
   </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection
