<template>
  <div class="container mt-4" id="main-wrap">
    <a-skeleton active v-if="isPendding" />
    <div class="row" v-else>
      <div class="col-12 col-lg-9">
        <h4 class="post-title mb-5">{{ post.title }}</h4>
        <img class="post-thumbnail" :src="post.thumbnail" :alt="post.title" />
        <p class="post-desc mt-5">{{ post.desc }}</p>
        <p v-html="post.body"></p>
      </div>
      <div class="col-12 col-lg-3 mt-5">
        <p
          style="
            color: #555555;
            font-size: 16px;
            border-bottom: 1px solid #cccccc;
          "
        >
          Đọc thêm
        </p>
        <div
          class="post-related-wrap"
          v-for="(postRelated, index) in postRelated"
          :key="index"
        >
          <router-link
            class="d-lg-flex mb-3"
            :to="{ name: 'home-post-detail', params: { id: postRelated.id } }"
            @click="getPostInfo(postRelated.id)"
          >
            <img
              class="post-related-thumbnail"
              :src="postRelated.thumbnail"
              :alt="postRelated.title"
            />
            <h5 class="post-title-related mb-5">{{ postRelated.title }}</h5>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useRoute } from "vue-router";
import { onMounted } from "vue";
import useMenu from "@/composables/user/useMenu";
export default {
  name: "detail-post",
  setup() {
    const route = useRoute();
    const postId = route.params.id;
    const { getPostInfo, post, postRelated, isPendding } = useMenu();
    onMounted(() => {
      getPostInfo(postId);
    });
    return {
      post,
      postRelated,
      getPostInfo,
      isPendding,
    };
  },
};
</script>

<style scoped>
@media (min-width: 1400px) {
  .post-related-thumbnail {
    width: 100px;
    height: 70px;
  }
  .post-thumbnail {
    width: 100%;
    height: 400px;
  }
  .post-title-related {
    font-size: 13px;
    margin-left: 10px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;
    overflow: hidden;
  }
}

@media (min-width: 576px) and (max-width: 1400px) {
  .post-thumbnail {
    width: 100%;
    height: 400px;
  }
  .post-title-related {
    font-size: 13px;
    margin-left: 10px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;
    overflow: hidden;
  }
  .post-related-thumbnail {
    width: 100%;
    height: 300px;
    margin-bottom: 15px;
  }
}
@media (max-width: 575.98px) {
  .post-related-thumbnail {
    width: 100%;
    height: 300px;
    margin-bottom: 15px;
  }
  .post-thumbnail {
    width: 100%;
    height: 300px;
  }
}
.post-title-related,
.post-title {
  text-transform: uppercase;
}
.post-title-related,
.post-title,
.post-desc {
  color: #555555;
}
.example {
  text-align: center;
  border-radius: 4px;
  margin-bottom: 20px;
  padding: 30px 50px;
  margin: 20px 0;
}
</style>
