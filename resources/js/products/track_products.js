window.bus = new Vue({});

import TrackedProducts from '../views/TrackedProducts.vue'
import TrackCostWayProduct from '../views/TrackCostWayProduct.vue'

const trackProducts = new Vue({
    components: {
        TrackedProducts,
        TrackCostWayProduct
    },
    el: '#track_products',
    data: {
        product: {},
    },
    mounted() {
        this.getProductDetails;
    },
    computed: {
        getProductDetails() {
            bus.$on('product', (product) => {
                this.product = product;
            });
        },
    },
});
