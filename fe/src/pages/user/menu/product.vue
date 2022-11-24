<template>
  <div class="row" v-for="(products, index) in menus" :key="index">
    <h4
      class="product-category-title"
      v-for="(category, index) in products[0]"
      :key="index"
      :id="category"
    >
      {{ category.toUpperCase() }}
    </h4>
    <product_item :products_item="products[1]" :key="index"></product_item>
  </div>
</template>
<script>
import product_item from "@/pages/user/menu/product_item";
export default {
  name: "product-wrap",
  components: {
    product_item,
  },
  props: {
    menus: {
      type: Array,
      required: true,
    },
  },
  setup() {
    return {};
  },
};
</script>

<style scoped>
.product-category-title {
  font-weight: 800;
  color: #555;
  margin-bottom: 25px;
  text-transform: capitalize;
}
</style>
