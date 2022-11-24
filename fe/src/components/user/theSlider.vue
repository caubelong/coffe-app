<template>
  <swiper
    :cssMode="true"
    :navigation="true"
    :keyboard="true"
    :modules="modules"
    :autoplay="autoplay"
    class="mySwiper"
  >
    <swiper-slide v-for="(slider, index) in sliderPost" :key="index">
      <div class="carousel__item">
        <router-link
          :to="{ name: 'home-post-detail', params: { id: slider.id } }"
          style="width: 100%"
        >
          <img class="slider-img" :src="slider.thumbnail" alt="" />
        </router-link>
        <div class="slider-content">
          <div class="wrapper">
            <h5 class="slider-title">{{ slider.title }}</h5>
            <p class="slider-desc">{{ slider.desc }}</p>
            <router-link
              :to="{ name: 'home-post-detail', params: { id: slider.id } }"
              ><span class="slider-link">Xem thêm</span></router-link
            >
          </div>
        </div>
      </div>
    </swiper-slide>
  </swiper>
</template>
<script>
import { defineComponent } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
// import required modules
import { Navigation, Keyboard, Autoplay } from "swiper";
export default defineComponent({
  components: {
    Swiper,
    SwiperSlide,
  },
  props: {
    sliderPost: {
      type: Array,
      required: true,
    },
  },
  setup() {
    const dataCarousel = [
      {
        name_path: "banner1.jpg",
        title: "nhật ký:cafe đậm đà lịch sử ",
        desc:
          "Tôi muốn tìm chỗ trú thật nhanh nhưng không cho phép mình cẩu thả với điểm đặt chân tới, " +
          "bèn lên google gõ “Cà phê Triệu Việt Vương." +
          "Một loạt địa chỉ hiện ra nhưng ấn tượng nhất vẫn là “Cộng Cà Phê",
      },
      {
        name_path: "banner2.jpg",
        title: "trà sữa",
        desc: "nhóm sản phẩm trà sữa mới toanh từ chúng tớ !",
      },
      {
        name_path: "banner3.jpg",
        title: "đừng lười lao động",
        desc: "Lao động hăng say",
      },
      {
        name_path: "banner4.jpg",
        title:
          "BẠC XỈU C+: RA MẮT CÀ PHÊ HOÀ TAN LẤY CẢM HỨNG TỪ HƯƠNG VỊ BÁN CHẠY NHẤT TẠI CỘNG",
        desc:
          "Cà phê hoà tan vị Bạc xỉu tốt nhất bạn có thể tìm thấy trong khu vực. " +
          'Hãy để Chúng tớ mang trải nghiệm "quán cà phê tại nhà" đến gần hơn với bạn!',
      },
      {
        name_path: "banner5.jpg",
        title:
          'Dùng thìa, bỏ ống, cốc tròn vị: Thưởng thức đồ uống như cách "ngày xưa"',
        desc:
          "Cộng Cà Phê xin phép không phục vụ ống hút kèm theo đồ uống. Cộng xin mời các bạn " +
          'cùng thưởng thức theo cách dùng thìa rất "ngày xưa" để cảm nhận tròn vẹn cảm xúc và hương vị của những đồ uống.',
      },
    ];
    const autoplay = {
      delay: 2500,
      disableOnInteraction: false,
    };
    return {
      dataCarousel,
      modules: [Navigation, Keyboard, Autoplay],
      autoplay,
    };
  },
});
</script>
<style scoped>
.carousel__item {
  min-height: 200px;
  width: 100%;
  color: var(--vc-clr-white);
  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}
.slider-img {
  display: block;
  position: relative;
}
@media (min-width: 1400px) {
  .slider-img {
    width: 100%;
    height: 657px;
  }
}

@media (min-width: 576px) and (max-width: 1400px) {
  .slider-img {
    width: 100%;
    height: 657px;
  }
  .slider-desc {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
  }
}
@media (max-width: 575.98px) {
  .slider-img {
    width: 100%;
    height: 250px;
  }
  .slider-content {
    display: none;
  }
}
.slider-content {
  position: absolute;
  background: rgba(255, 241, 208, 0.9);
  width: 100%;
  height: 170px;
  bottom: 0;
}
.wrapper {
  margin-top: 40px;
}
.slider-title {
  text-transform: uppercase;
  font-weight: 700;
}
.slider-desc {
  width: 50%;
  color: #232323;
  font-size: 15px;
  margin: 0 auto;
  line-height: 21px;
  font-weight: 500;
}
.slider-title {
  color: #555555;
  font-family: "Roboto", sans-serif;
}
.slider-link {
  text-decoration: underline;
  font-size: 12px;
  color: #3c5e2c;
  font-style: italic;
  cursor: pointer;
  position: relative;
  top: 0;
  left: 300px;
  font-weight: 500;
}
/*slider*/
.swiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;

  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
.swiper-button-next {
  color: #000000;
}
</style>
