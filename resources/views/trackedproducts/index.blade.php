@extends('layouts.master')

@section('title', 'Tracked Products')

@section('scripts')
  @parent
  <script src="{{ mix('js/products/track_products.js') }}"></script>
@endsection

@include('layouts.app.nav')

@section('content')
<div class="flex flex-col w-0 flex-1 overflow-hidden" id="track_products">
    <tracked-products 
      :get-products="{{ $products }}" 
      :in-stock-count="{{ $totalInStock }}"  
      :out-of-stock-count="{{ $totaloutOfStock }}"
      :total-tracked="{{ $totalTracked }}"
    ></tracked-products>
</div>
@endsection