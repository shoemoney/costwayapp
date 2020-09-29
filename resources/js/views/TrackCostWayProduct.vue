<template>
  <div class="flex overflow-hidden bg-cool-gray-100">
      <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
        <div class="mt-2 mx-6">
          <div
            class="bg-white shadow overflow-hidden sm:rounded-lg m-auto w-full "
          >
            <div class="w-full flex rounded-md shadow-sm">
            <span class="p-3 inline-flex items-center px-3 rounded-none border-solid border-l-2  border-t-2 border-r-0  border-b-2 border-gray-600 text-gray-500 sm:text-sm">
              https://costway.co.uk/
            </span>
            <input 
              id="search" 
              class="flex-1 form-input block w-full min-w-0 border-solid rounded-none border-l-0  border-t-2 border-r-2 border-b-2  border-gray-600 sm:text-sm sm:leading-5"
              v-model="productSlug"
              v-on:keyup="productDetails"
              placeholder="2500w-oil-filled-electric-timer-thermostat-11-fin-heater">
          </div>

            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Product Information</h3>
               <button v-if="!_.isEmpty(product)" type="button" @click="trackProduct" class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                <svg class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Track</span>
              </button>
              <p
                class="mt-1 max-w-2xl text-sm leading-5 text-gray-500"
              v-text="product.productSlug"></p>
            </div>
            <div class="px-4 py-5 sm:p-0">
              <dl>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                  <dt class="text-sm leading-5 font-medium text-gray-500">Title</dt>
                  <dd
                    class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                  ><span v-text="product.title"></span></dd>
                </div>
                <div
                  class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                >
                  <dt class="text-sm leading-5 font-medium text-gray-500">Condition</dt>
                  <dd
                    class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                  ><span v-text="product.condition"></span></dd>
                </div>
                <div
                  class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                >
                  <dt class="text-sm leading-5 font-medium text-gray-500">Stock</dt>
                  <dd
                    class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                  ><span v-text="product.stock"></span></dd>
                </div>
                <div
                  class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                >
                  <dt class="text-sm leading-5 font-medium text-gray-500">£</dt>
                  <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><span v-text="product.price"></span></dd>
                </div>
                <div
                  class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                >
                  <dt class="text-sm leading-5 font-medium text-gray-500">Description</dt>
                  <dd
                    class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                  ><span v-text="product.description"></span></dd>
                </div>
                <div
                  class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5"
                >
                  <dt class="text-sm leading-5 font-medium text-gray-500">Attachments</dt>
                  <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    <ul class="border border-gray-200 rounded-md">
                      <li
                        class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5"
                        v-for="(image, index) in product.images"
                      >
                        <div class="w-0 flex-1 flex items-center">
                          <svg
                            class="flex-shrink-0 h-5 w-5 text-gray-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                              clip-rule="evenodd"
                            />
                          </svg>
                          <a :href="image" target="_blank">
                            <img :src="image" class="ml-2 flex-1 w-32 truncate"></span>
                          </a>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                          <a :href="image" target="_blank">
                            Download
                          </a>
                        </div>
                      </li>
                    </ul>
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { saveAs } from "file-saver";

export default {
  data() {
    return {
      product: {},
      productSlug: "",
    };
  },
  methods: {
    productDetails() {
      axios.get(`/costway/product/${this.productSlug}`).then(({ data }) => {
        this.product = data;
      });
    },
    downloadImages(images) {
      images.forEach((image) => {
        saveAs(
          image,
          image.replace(
            "https://www.costway.co.uk/media/catalog/product/cache/1/",
            ""
          )
        );
      });
    },
    trackProduct() {
      axios
        .post("/costway/product", {
          identifier: this.productSlug,
          name: this.product.title,
          description: this.product.description,
          price: this.product.price,
          currency: this.product.currency,
          images: this.product.images,
          stock: this.product.stock,
          rating: this.product.rating,
          reviews: this.product.reviews,
        })
        .then((response) => {
          this.$toasted.show("Product tracked.", {
            theme: "bubble",
            position: "bottom-center",
            duration: 1500,
          });
        });
    },
  },
};
</script>
