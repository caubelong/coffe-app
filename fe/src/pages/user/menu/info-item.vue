<template>
  <div class="container mt-4" id="main-wrap">
    <div class="example" v-if="isPendding">
      <a-spin />
    </div>
    <div class="row mt-5" v-else>
      <div class="col-12 col-lg-5">
        <a-image
          class="product-img"
          :src="product.thumbnail"
          :alt="product.name"
        />
      </div>
      <div class="col-12 col-lg-7">
        <div class="info-wrap">
          <h4 class="product-name">{{ product.name }}</h4>
          <span class="product-price">{{ product.price - 0 / 1 }}đ</span>
          <p class="product-desc">
            <tt>{{ product.desc }}</tt>
          </p>
        </div>
      </div>
    </div>
    <h4 v-if="productRelatedList" class="product-name mt-5 mb-5">
      Sản phẩm liên quan
    </h4>
    <swiper
      :slidesPerView="2"
      :spaceBetween="30"
      :cssMode="true"
      :navigation="true"
      :keyboard="true"
      :modules="modules"
      :autoplay="autoplay"
      :breakpoints="breakpoints"
      class="mySwiper"
    >
      <swiper-slide
        v-for="(productRelated, index) in productRelatedList"
        :key="index"
      >
        <div
          class="product-related-wrap"
          v-show="productRelatedList.id !== productId"
        >
          <router-link
            :to="{
              name: 'home-menu-info',
              params: { id: productRelated.id },
            }"
            @click="getInfoItem(productRelated.id)"
          >
            <img
              class="product-related-img"
              :src="productRelated.thumbnail"
              :alt="productRelatedList.name"
            />
            <h4 class="product-related-name mt-2">
              {{ productRelated.name }}
            </h4>
            <p class="product-related-price">
              {{ productRelated.price - 0 / 1 }}đ
            </p>
          </router-link>
        </div>
      </swiper-slide>
    </swiper>
  </div>
</template>

<script>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import useMenu from "@/composables/user/useMenu";
import { defineComponent } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
// import required modules
import { Navigation, Keyboard, Autoplay } from "swiper";
export default defineComponent({
  name: "info-item",
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    const { getInfoItem, product, productRelatedList, isPendding } = useMenu();
    const route = useRoute();
    const productId = route.params.id;
    onMounted(() => {
      getInfoItem(productId);
    });
    const breakpoints = {
      1100: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    };
    const autoplay = {
      delay: 2500,
      disableOnInteraction: false,
    };
    return {
      product,
      productRelatedList,
      productId,
      getInfoItem,
      isPendding,
      breakpoints,
      modules: [Navigation, Keyboard, Autoplay],
      autoplay,
    };
  },
});
</script>

<style scoped>
@media (min-width: 576px) and (max-width: 1400px) {
  .product-img {
    width: 100%;
    height: 250px;
  }
  .product-related-img {
    width: 250px;
    height: 250px;
  }
  .product-related-price {
    font-size: 18px;
  }
  .product-related-name {
    font-size: 15px;
  }
}
@media (min-width: 1400px) {
  .product-img {
    width: 100%;
    height: 500px;
  }
  .product-related-img {
    width: 255px;
    height: 250px;
  }
  .product-related-price {
    font-size: 18px;
  }
  .product-related-name {
    font-size: 15px;
  }
}
@media (max-width: 575.98px) {
  .info-wrap {
    margin-top: 15px;
    padding: 0 10px;
  }
  .product-related-img {
    width: 170px;
    height: 200px;
  }
  .product-related-name {
    font-size: 12px;
  }
  .product-related-price {
    font-size: 12px;
  }
}
.product-name,
.product-price,
.product-desc,
.product-related-name,
.product-related-price {
  color: #555555;
}
.product-price {
  font-size: 18px;
}
.product-name,
.product-related-name {
  text-transform: uppercase;
  text-align: left;
  font-weight: 800;
  margin-bottom: 5px;
}
.product-price,
.product-related-price {
  text-align: left;
  font-weight: bold;
  margin-bottom: 5px;
}
.example {
  text-align: center;
  border-radius: 4px;
  margin-bottom: 20px;
  padding: 30px 50px;
  margin: 20px 0;
}
</style>
