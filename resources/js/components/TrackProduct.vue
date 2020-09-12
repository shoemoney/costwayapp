<template>
  <button
    @click="trackProduct"
    class="border-b-4 text-white border-indigo-600 bg-indigo-800 p-1 mt-2 active:border-indigo-700 hover:border-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 px-4"
  >Track Product</button>
</template>

<script>
  export default {
    props: {
      productDetails: Object
    },
    methods: {
      trackProduct() {
        axios
          .post("import/product", {
            identifier: this.productDetails.identifier,
            title: this.productDetails.name,
            description: this.productDetails.description,
            price: this.productDetails.price,
            category_id: this.productDetails.meta.categories.id,
            images: this.productDetails.meta.images[0].url,
            quantity: 10,
            sku: "sku1",
            shipping_cost: this.productDetails.meta.shippingInfo.shipping_cost,
            store: this.productDetails.meta.sellerInfo.store
          })
          .then(() => {
            this.$toasted.show("Product tracked!", {
              theme: "bubble",
              position: "bottom-center",
              duration: 1500
            });
          });
      }
    }
  };
</script>
