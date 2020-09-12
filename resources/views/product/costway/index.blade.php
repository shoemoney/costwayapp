@extends('layouts.master')

@section('title', 'Track Product')

@section('scripts')
  @parent
  <script src="{{ mix('js/products/track_products.js') }}"></script>
@endsection

@include('layouts.app.nav')

@section('content')
<div class="flex flex-col w-0 flex-1 overflow-hidden" id="track_products">
    <track-cost-way-product></track-cost-way-product>
</div>
@endsection
