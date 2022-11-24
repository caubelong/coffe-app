<template>
  <div class="container" id="main-wrap">
    <h4 class="story__header-title mt-5 mb-3 text-uppercase">Câu chuyện</h4>
    <span class="mt-7"
      ><tt class="text-desc"
        >Câu chuyện Cộng bắt đầu vào năm 2007. Cửa hàng đầu tiên là một tiệm
        giải khát nhỏ trên con phố cà phê lâu đời tại Hà Nội – phố Triệu Việt
        Vương.</tt
      ></span
    >
    <div id="main-story">
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img1.jpg')"
        alt="story-1"
      />
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img2.jpg')"
        alt="story-1"
      />
      <h5 class="message-text">
        <tt>Tư liệu: Sinh hoạt cà phê tại Cộng xưa</tt>
      </h5>
      <p class="text-description mb-3">
        <tt>
          Cộng đơn giản được lấy cảm hứng từ chữ cái đầu tiên trong câu Quốc
          hiệu: CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</tt
        >
      </p>
      <p class="text-description">
        <tt>
          Sứ mệnh của chúng tôi là khơi dậy trí tưởng tượng và mang đến cho
          khách hàng những trải nghiệm cảm xúc khác biệt về Việt Nam. Chúng tôi
          đang không ngừng sáng tạo với mục tiêu là tiến xa hơn để mang Cộng đến
          với thế giới; lan toả và truyền cảm hứng bằng trái tim của mỗi thành
          viên.</tt
        >
      </p>
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img3.jpg')"
        alt="story-1"
      />
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img4.jpg')"
        alt="story-1"
      />
      <h5 class="message-text">
        <tt
          >Cảm ơn bạn đã đồng hành cùng chúng tôi trên bước đường phát triển đến
          Cộng nay</tt
        >
      </h5>
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img5.jpg')"
        alt="story-1"
      />
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img6.jpg')"
        alt="story-1"
      />
      <img
        class="main__story-img mb-3"
        :src="require('../../dist/story_img7.jpg')"
        alt="story-1"
      />
    </div>
  </div>
</template>
<script>
export default {
  name: "info-comp",
};
</script>

<style scoped>
@media (max-width: 575.98px) {
  .main__story-img {
    height: 300px;
  }
}
@media (min-width: 1400px) {
  .main__story-img {
    height: 100%;
  }
}
.message-text {
  text-align: center;
  font-size: 14px;
  margin-bottom: 10px;
}
.main__story-img {
  width: 100%;
}
.text-description {
  font-size: 15px;
}
#main-story {
  margin-top: 20px;
}
.text-desc {
  font-size: 15px;
}
.story__header-title {
  font-weight: 800;
  font-size: 25px;
  margin-top: 25px;
  color: #555555;
}
</style>
