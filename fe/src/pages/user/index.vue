<template>
  <div class="container-fluid" style="padding: 0">
    <theSlider :sliderPost="postSlider"></theSlider>
  </div>
  <div class="container mt-4 p" id="main-wrap">
    <div class="row mt-4">
      <div class="col-12">
        <div class="story-wrap" @click="redirecStory">
          <img class="story-banner" src="../../dist/cautruyencong.jpg" alt="" />
          <span class="story-text">Câu chuyện của chúng tôi</span>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 col-md-6 banner-main">
        <router-link :to="{ name: 'home-post' }">
          <img class="img-content" src="../../dist/11copy.jpg" alt="" />
          <span class="context-img">Pha chế</span>
        </router-link>
      </div>
      <div class="col-12 col-md-6 banner-main">
        <router-link :to="{ name: 'home-menu' }">
          <img class="img-content" src="../../dist/Thực-đơn-copy.jpg" alt="" />
          <span class="context-img">Thực đơn</span>
        </router-link>
      </div>
    </div>
    <div class="row mt-3">
      <div class="order-wrap">
        <router-link :to="{ name: 'home-menu' }">
          <img class="oder-img" src="../../dist/mmenu.jpg" alt="dat hang" />
          <div class="story-text">
            <span>Đặt mua online</span>
            <p>
              Kết nối với chúng tớ, để có thể đặt online. Chúng tớ luôn luôn sẵn
              sàng phục vụ bạn
            </p>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import theSlider from "@/components/user/theSlider";
import useMenu from "@/composables/user/useMenu";
import { onMounted } from "vue";
import { useRouter } from "vue-router";

export default {
  name: "index-comp",
  components: {
    theSlider,
  },
  setup() {
    const { getPostSlider, postSlider } = useMenu();
    onMounted(getPostSlider);
    const router = useRouter();
    const redirecStory = async () => {
      await setTimeout(() => {
        router.push("/info");
      }, 3000);
    };
    return {
      postSlider,
      redirecStory,
    };
  },
};
</script>

<style scoped>
@media (max-width: 575.98px) {
  .img-content {
    height: 250px;
    margin-bottom: 30px;
    width: 100%;
  }
  #main-wrap {
    padding: 0 10px;
  }
  .story-banner,
  .oder-img {
    height: 300px;
  }
}
@media (min-width: 576px) and (max-width: 1400px) {
  .img-content {
    width: 100%;
    height: 350px;
  }
  .story-banner,
  .oder-img {
    height: 450px;
  }
}
@media (min-width: 1400px) {
  #main-wrap {
    padding: 0 140px;
  }
  .img-content {
    width: 100%;
    height: 350px;
  }
  .story-banner,
  .oder-img {
    height: 450px;
  }
}
/*story */
.story-banner {
  width: 100%;
  position: relative;
}
.banner-main {
  position: relative;
}
.context-img {
  position: absolute;
  background: rgba(255, 241, 208, 0.9);
  padding: 6px 0;
  min-width: 50%;
  display: inline-block;
  text-transform: uppercase;
  color: #555555;
  font-size: 20px;
  text-align: center;
  transform: translate(-50%, -50%);
  z-index: 9;
  top: 50%;
  left: 50%;
  transition: top 0.5ms;
  font-weight: 700;
}
.context-img:hover {
  top: 49%;
}
/*story wrap*/
.story-wrap {
  position: relative;
  cursor: pointer;
}
.story-wrap::after {
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: rgba(255, 241, 208, 0.9);
  display: block;
  content: "";
  position: absolute;
  opacity: 1;
  transition: all 0.7s ease;
}
.story-text {
  display: inline-block;
  text-transform: uppercase;
  color: #555555;
  font-size: 20px;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  z-index: 9;
  font-weight: 700;
  min-width: 40%;
  padding: 10px 0;
}
.story-wrap:hover:after {
  opacity: 0;
}
.story-wrap:hover .story-text {
  background: rgba(255, 241, 208, 0.9);
}
/*order wrap*/
.order-wrap {
  position: relative;
}
.order-wrap .story-text {
  background: rgba(255, 241, 208, 0.9);
  padding: 20px;
}
.order-wrap .story-text span {
  position: relative;
}
.order-wrap .story-text p {
  font-weight: 400;
  font-size: 12px;
}
.oder-img {
  width: 100%;
}
.example {
  text-align: center;
  border-radius: 4px;
  margin-bottom: 20px;
  padding: 30px 50px;
  margin: 20px 0;
}
</style>
