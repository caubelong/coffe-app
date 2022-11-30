import axios from "axios";
import { ref } from "vue";
import { getUrlApi } from "@/store/getUrlApi";
export default function useCategory() {
  const url = getUrlApi().$state.apiUrl;
  const categories = ref([]);
  const category = ref([]);
  const errors = ref(null);
  const isPending = ref(false);
  const getCategories = async () => {
    try {
      const res = await axios.get(url + "admin/categories");
      categories.value = await res.data;
    } catch (e) {
      console.log(e);
    }
  };
  const getCategory = async (id) => {
    try {
      const res = await axios.get(url + `admin/categories/${id}`);
      category.value = res.data;
    } catch (e) {
      console.log(e);
    }
  };
  const storeCategory = async (data) => {
    isPending.value = true;
    errors.value = null;
    try {
      const res = await axios.post(url + "admin/categories", data);
      if (!res) throw new Error("Could not create category");
    } catch (err) {
      errors.value = err.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const updateCategory = async (id) => {
    isPending.value = true;
    errors.value = null;
    try {
      const res = await axios.put(
        url + `admin/categories/${id}`,
        category.value
      );
      if (!res) throw new Error("Could not update category");
    } catch (err) {
      errors.value = err.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const removeCategory = async (id) => {
    try {
      await axios.delete(url + `admin/categories/${id}`);
    } catch (e) {
      console.log(e);
    }
  };
  return {
    categories,
    category,
    getCategories,
    getCategory,
    storeCategory,
    updateCategory,
    removeCategory,
    errors,
    isPending,
  };
}
