<template>
  <div
    class="col-6 col-lg-4"
    v-for="(product, index) in products_item"
    :key="index"
  >
    <router-link
      :to="{
        name: 'home-menu-info',
        params: { id: product.id },
      }"
    >
      <div class="product-wrapper mb-5">
        <img class="product-img" v-lazy="product.thumbnail" />
        <h2 class="product-name mt-3">{{ product.name }}</h2>
        <span class="product-price">{{ product.price - 0 + "đ" }}</span>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "product_item",
  props: {
    products_item: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style scoped>
@media (max-width: 575.98px) {
  .product-img {
    width: 100%;
    height: 180px;
  }
}
@media (min-width: 576px) and (max-width: 1400px) {
  .product-img {
    width: 100%;
    height: 250px;
  }
}
@media (min-width: 1400px) {
  .product-img {
    width: 100%;
    height: 250px;
  }
}
.product-wrapper {
  position: relative;
}
.product-wrapper::after {
  position: absolute;
  display: block;
  content: "";
  background: #c7c7c7;
  opacity: 0;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 79%;
}
.product-wrapper:hover::after {
  opacity: 0.4;
}
.product-name {
  color: #555555;
  text-transform: uppercase;
  text-align: left;
  font-weight: 800;
  margin-bottom: 5px;
  font-size: 16px;
}
.product-price {
  color: #3c5e2c;
  text-align: left;
  font-weight: bold;
  margin-bottom: 5px;
  font-size: 18px;
}
</style>
