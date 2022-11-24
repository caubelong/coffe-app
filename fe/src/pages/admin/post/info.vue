<template>
  <a-page-header
    style="border: 1px solid rgb(235, 237, 240); margin-bottom: 10px"
    title="Quay lại"
    @back="backToPrePage"
  />
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h5 class="title-post">{{ postInfo.title }}</h5>
        <p class="desc-post">{{ postInfo.desc }}</p>
        <div
          class="img-thumbnail d-flex align-items-center justify-content-center border-0 mb-3"
        >
          <img
            class="d-flex align-items-center justify-content-center"
            height="300"
            width="350"
            :src="postInfo.thumbnail"
            :alt="postInfo.title"
          />
        </div>
        <p v-html="postInfo.body"></p>
      </div>
    </div>
  </div>
</template>

<script>
import usePost from "@/composables/admin/usePost";
import { useRoute } from "vue-router";
import { onMounted } from "vue";

export default {
  name: "info-comp",
  setup() {
    const router = useRoute();
    const id = router.params.id;
    const { postInfo, getPost } = usePost();
    onMounted(() => {
      getPost(id);
    });
    const backToPrePage = () => {
      history.back();
    };
    return {
      postInfo,
      backToPrePage,
    };
  },
};
</script>

<style scoped></style>
