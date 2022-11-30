import axios from "axios";
import { getUrlApi } from "@/store/getUrlApi";
import { ref } from "vue";
export default function useProduct() {
  const url = getUrlApi().$state.apiUrl;
  const products = ref([]);
  const product = ref([]);
  const errors = ref(null);
  const isPending = ref(false);
  const getProducts = async () => {
    try {
      const res = await axios.get(url + "admin/products");
      products.value = await res.data.data;
    } catch (e) {
      console.log(e);
    }
  };
  const getProduct = async (id) => {
    try {
      const res = await axios.get(url + `admin/products/${id}`);
      product.value = await res.data.data;
    } catch (e) {
      console.log(e);
    }
  };
  const storeProduct = async (data) => {
    errors.value = null;
    isPending.value = true;
    const config = {
      header: {
        "Content-type": "application/json; charset=UTF-8",
      },
    };
    const newProduct = new FormData();
    newProduct.append("name", data?.name);
    newProduct.append("cate_id", data?.cate_id);
    newProduct.append("price", data?.price);
    newProduct.append("discount", data?.discount);
    newProduct.append("desc", data?.desc);
    newProduct.append("thumbnail", data?.thumbnail);
    newProduct.append("status", data?.status);
    try {
      const res = await axios.post(url + "admin/products", newProduct);
      if (!res) throw new Error("Could not save product ");
    } catch (err) {
      console.log(err.response.data);
      errors.value = err.response.data.errors;
      console.log(errors.value);
    } finally {
      isPending.value = false;
    }
  };
  const updateProduct = async (id) => {
    const config = {
      header: {
        "Content-type": "application/json; charset=UTF-8",
      },
    };
    const updapteProduct = new FormData();
    updapteProduct.set("name", product.value?.name);
    updapteProduct.set("cate_id", product.value?.cate_id);
    updapteProduct.set("price", product.value?.price);
    updapteProduct.set("discount", product.value?.discount);
    updapteProduct.set("desc", product.value?.desc);
    updapteProduct.set("thumbnail", product.value?.thumbnail);
    updapteProduct.set("status", product.value?.status);
    updapteProduct.append("_method", "PUT");
    try {
      const res = await axios.post(
        url + `admin/products/${id}`,
        updapteProduct
      );
    } catch (err) {
      errors.value = err.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const removeProduct = async (id) => {
    await axios.delete(url + `admin/products/${id}`);
  };
  return {
    products,
    product,
    getProducts,
    getProduct,
    storeProduct,
    removeProduct,
    updateProduct,
    errors,
    isPending,
  };
}
