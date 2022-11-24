<template>
  <div class="example" v-if="isPendding">
    <a-spin />
  </div>
  <div class="container mt-4" id="main-wrap">
    <div class="row" v-for="(post, index) in posts" :key="index">
      <div class="col-12 col-lg-9">
        <div class="post-item">
          <router-link
            class="d-lg-flex mb-3"
            :to="{ name: 'home-post-detail', params: { id: post.id } }"
          >
            <img
              class="post-related-thumbnail"
              :src="post.thumbnail"
              :alt="post.title"
            />
            <div class="post-infomation">
              <h5 class="post-title-related">{{ post.title }}</h5>
              <p class="post-desc">{{ post.desc }}</p>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted } from "vue";
import useMenu from "@/composables/user/useMenu";
export default {
  name: "post-comp",
  setup() {
    const { getPost, posts, isPendding } = useMenu();
    onMounted(getPost);
    return {
      isPendding,
      posts,
    };
  },
};
</script>

<style scoped>
.example {
  text-align: center;
  border-radius: 4px;
  margin-bottom: 20px;
  padding: 30px 50px;
  margin: 20px 0;
}
@media (min-width: 1400px) {
  .post-related-thumbnail {
    width: 200px;
    height: 150px;
  }
  .post-title-related {
    font-size: 16px;
    margin-left: 10px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;
    overflow: hidden;
  }
  .post-desc {
    margin-left: 10px;
  }
}

@media (min-width: 576px) and (max-width: 1400px) {
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
}
.post-title-related {
  text-transform: uppercase;
}
.post-title-related,
.post-desc {
  color: #555555;
}
.post-title-related:hover {
  color: #4b6727;
}
</style>
