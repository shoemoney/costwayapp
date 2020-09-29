<template>
<div>
    <button type="button" @click='this.$parent.$modal.show("track-product-modal")' class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
        <svg class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        <span>Track Product</span>
    </button>
    <modal
    name="track-product-modal" 
    :width="1100"
    :height="600"
    transition="pop-out"
    class="flex justify-center absolute"
  >
    <div>
      <track-cost-way-product></track-cost-way-product>
    </div>
  </modal>
</div>

</template>

<script>
import TrackCostWayProduct from '../views/TrackCostWayProduct.vue'

export default {
  components: {
      TrackCostWayProduct
  }
};
</script>
