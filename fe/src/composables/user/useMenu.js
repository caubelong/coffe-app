import axios from "axios";
import { ref } from "vue";
import { getUrlApi } from "@/store/getUrlApi";
export default function useMenu() {
  const url = getUrlApi().$state.apiUrl;
  const menus = ref([]);
  const product = ref([]);
  const errors = ref(null);
  const productRelatedList = ref([]);
  const isPendding = ref(false);
  const postSlider = ref([]);
  const post = ref([]);
  const postRelated = ref([]);
  const posts = ref([]);
  //get list menu
  const getMenus = async () => {
    errors.value = null;
    try {
      const res = await axios.get(url + "user/menu");
      menus.value = await res.data;
    } catch (err) {
      errors.value = err.message;
      console.log(errors.value);
    }
  };
  // get info item
  const getInfoItem = async (id) => {
    errors.value = null;
    isPendding.value = true;
    try {
      const res = await axios.get(url + `user/menu/info/${id}`);
      product.value = await res.data.data;
      const res2 = await axios.get(
        url +
          `user/menu/product-related/${product.value.id}/${product.value.cate_id}`
      );
      productRelatedList.value = res2.data.data;
      console.log(productRelatedList);
      console.log(product.value);
    } catch (err) {
      errors.value = err.message;
    } finally {
      isPendding.value = false;
    }
  };
  // get post show slider
  const getPostSlider = async () => {
    try {
      const res = await axios.get(url + `user/menu/post-slider`);
      postSlider.value = await res.data.data;
    } catch (err) {
      errors.value = err.message;
    }
  };
  // get info post
  const getPostInfo = async (id) => {
    isPendding.value = true;
    errors.value = null;
    try {
      const res = await axios.get(url + `user/menu/post-detail/${id}`);
      post.value = await res.data.data;
      const res2 = await axios.get(url + `user/menu/post-related/${id}`);
      postRelated.value = res2.data.data;
    } catch (err) {
      errors.value = err.message;
    } finally {
      isPendding.value = false;
    }
  };
  const getPost = async () => {
    isPendding.value = true;
    errors.value = null;
    try {
      const res = await axios.get(url + "user/menu/get-post-list");
      posts.value = await res.data.data;
    } catch (err) {
      errors.value = err.message;
    } finally {
      isPendding.value = false;
    }
  };
  return {
    getMenus,
    menus,
    product,
    getInfoItem,
    productRelatedList,
    isPendding,
    getPostSlider,
    postSlider,
    getPostInfo,
    post,
    postRelated,
    posts,
    getPost,
  };
}
