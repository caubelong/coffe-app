import { getUrlApi } from "@/store/getUrlApi";
import axios from "axios";
import { ref } from "vue";
export default function usePost() {
  const url = getUrlApi().$state.apiUrl;
  const posts = ref([]);
  const postInfo = ref([]);
  const isPending = ref(false);
  const errors = ref(null);
  const getPosts = async () => {
    try {
      const res = await axios.get(url + "admin/posts");
      posts.value = await res.data.data;
    } catch (err) {
      console.log(err);
    }
  };
  const getPost = async (id) => {
    try {
      const res = await axios.get(url + `admin/posts/${id}`);
      postInfo.value = await res.data.data;
    } catch (err) {
      console.log(err);
    }
  };
  const storePost = async (data) => {
    errors.value = null;
    isPending.value = true;
    const config = {
      header: {
        "Content-type": "application/json; charset=UTF-8",
      },
    };
    const newPost = new FormData();
    newPost.append("title", data?.title);
    newPost.append("desc", data?.desc);
    newPost.append("body", data?.body);
    newPost.append("thumbnail", data?.thumbnail);
    newPost.append("status", data?.status);
    try {
      const res = await axios.post(url + "admin/posts", newPost);
    } catch (err) {
      console.log(err);
    } finally {
      isPending.value = false;
    }
  };
  const updatePost = async (id) => {
    errors.value = null;
    isPending.value = true;
    const config = {
      header: {
        "Content-type": "application/json; charset=UTF-8",
      },
    };
    const postUpdate = new FormData();
    postUpdate.set("title", postInfo.value?.title);
    postUpdate.set("desc", postInfo.value?.desc);
    postUpdate.set("body", postInfo.value?.body);
    postUpdate.set("thumbnail", postInfo.value?.thumbnail);
    postUpdate.set("status", postInfo.value?.status);
    postUpdate.append("_method", "PUT");
    try {
      const res = await axios.post(
        url + `admin/posts/${id}`,
        postUpdate,
        config
      );
    } catch (err) {
      console.log(err);
    } finally {
      isPending.value = false;
    }
  };
  const removePost = async (id) => {
    const res = await axios.delete(url + `admin/posts/${id}`);
    console.log(res);
  };
  return {
    posts,
    postInfo,
    getPosts,
    getPost,
    storePost,
    updatePost,
    removePost,
  };
}
