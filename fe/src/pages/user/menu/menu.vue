<template>
  <div class="container">
    <div class="row mt-5" id="main-wrap">
      <div class="col-3 d-none d-lg-flex h-100" id="list-menu-category">
        <ul>
          <li class="list-category" v-for="(menu, index) in menus" :key="index">
            <span
              v-for="(category, index) in menu[0]"
              :key="index"
              @click="scroll(category)"
            >
              {{ category.toUpperCase() }}
            </span>
          </li>
        </ul>
      </div>
      <div class="col-12 col-lg-9 product-show">
        <div class="product-info-wrap">
          <product :menus="menus"></product>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted } from "vue";
import product from "@/pages/user/menu/product";
import useMenu from "@/composables/user/useMenu";
export default {
  name: "menu-comp",
  components: {
    product,
  },
  setup() {
    const { getMenus, menus } = useMenu();
    onMounted(getMenus);
    const scroll = (id) => {
      document.getElementById(id).scrollIntoView({
        behavior: "smooth",
      });
    };
    return {
      menus,
      scroll,
    };
  },
};
</script>

<style scoped>
@media (min-width: 576px) and (max-width: 1400px) {
  .product-img {
    width: 100%;
    height: 250px;
  }
}
@media (min-width: 1400px) {
  .product-info-wrap {
    border-left: 2px solid #c7c7c7;
    padding-left: 20px;
  }
}
@media (max-width: 575.98px) {
}
#main-wrap {
  position: relative;
}
.list-category {
  list-style: none;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  margin-bottom: 10px;
}
.list-category:hover {
  color: #3c5e2c;
}
#list-menu-category {
  top: 30px;
  position: -webkit-sticky;
  position: sticky;
}
</style>
