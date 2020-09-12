
<div id="products">
 <main class="flex h-screen">
    <section class="w-full text-sm">
        <div class="flex justify-between">
            <div class="w-1/4 bg-white shadow px-6 bg-gray-200 text-gray-800">
              <search-product :get-products="products" :current-search="currentSearch"></search-product>
              <search-category :get-products="products" :current-search="currentSearch"></search-category>
              <search-store :get-products="products" :current-search="currentSearch"></search-store>

            </div>
            <div class="w-2/6 bg-white shadow px-6">
              <div class="flex flex-wrap mx-2 my-4">
                <div class="flex flex-grow justify-start">
                  <h4>Products</h4>
                </div>
                <div class="flex flex-grow justify-end text-white">
                  <button class="bg-indigo-800 px-4 mr-1"><i class="fas fa-redo-alt"></i></button>
                  <button class="bg-indigo-800 px-4"><i class="fas fa-align-justify"></i></button>
                </div>
              </div>
              <products :get-products="products" :product-search-flag="searchingProducts"></products>
            </div>
            <div class="w-3/5 flex flex-col content-between bg-white shadow  px-6 h-auto bg-gray-200">
            <div class="flex mb-4">
              <div class="w-full h-auto">
                <product-details v-if="!_.isEmpty(product)" :product-details="product"></product-details>
                <sales :product-identifier="product.identifier" :metric-search-flag="searchingProductMetrics" :sales-each-month="salesEachMonth" :sales-each-day="salesEachDay"></sales>
              </div>
            </div>
          </div>
        </div>
    </section>
  </main>
</div>


@section('scripts')
  @parent
  <script src="{{ mix('js/products/products.js') }}"></script>
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet">
<style>
  .active {
    border-bottom-color: #6335c7;
  }
</style>
