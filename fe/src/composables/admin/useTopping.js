import { ref } from "vue";
import axios from "axios";
import { getUrlApi } from "@/store/getUrlApi";
export default function useTopping() {
  const url = getUrlApi().$state.apiUrl;
  const toppings = ref([]);
  const topping = ref([]);
  const errors = ref(null);
  const isPending = ref(false);
  const getToppings = async () => {
    try {
      const res = await axios.get(url + "admin/toppings");
      toppings.value = await res.data.data;
    } catch (e) {
      console.log(e);
    }
  };
  const getTopping = async (id) => {
    try {
      const res = await axios.get(url + `admin/toppings/${id}`);
      topping.value = await res.data;
    } catch (e) {
      console.log(e);
    }
  };
  const storeTopping = async (data) => {
    errors.value = "";
    isPending.value = true;
    try {
      const res = await axios.post(url + "admin/toppings/", data);
      if (!res) throw new Error("Could not save topping");
    } catch (err) {
      errors.value = err.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const updateTopping = async (id) => {
    errors.value = null;
    isPending.value = true;
    try {
      const res = await axios.put(url + `admin/toppings/${id}`, topping.value);
      if (!res) throw new Error("Could not update topping");
    } catch (error) {
      errors.value = error.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const removeTopping = async (id) => {
    await axios.delete(url + `admin/toppings/${id}`);
  };
  return {
    toppings,
    topping,
    getToppings,
    getTopping,
    storeTopping,
    updateTopping,
    removeTopping,
    errors,
    isPending,
  };
}
