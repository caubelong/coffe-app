import axios from "axios";
import { ref } from "vue";
import { getUrlApi } from "@/store/getUrlApi";

export default function useUser() {
  const url = getUrlApi().$state.apiUrl;
  const users = ref([]);
  const user = ref([]);
  const errors = ref(null);
  const isPending = ref(false);
  const getUsers = async () => {
    try {
      const res = await axios.get(url + "admin/users");
      users.value = await res.data.data;
    } catch (e) {
      console.log(e);
    }
  };
  const getUser = async (id) => {
    try {
      const res = await axios.get(url + `admin/users/${id}`);
      user.value = await res.data.data;
    } catch (e) {
      console.log(e);
    }
  };
  const updateUser = async (id) => {
    errors.value = null;
    isPending.value = true;
    try {
      const res = await axios.put(url + `admin/users/${id}`, user.value);
      if (!res) throw new Error("Could not update user");
    } catch (err) {
      errors.value = err.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const storeUser = async (data) => {
    errors.value = null;
    isPending.value = true;
    try {
      const res = await axios.post(url + `admin/users`, data);
      if (!res) throw new Error("Could not create user");
    } catch (err) {
      errors.value = err.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  const destroyUser = async (id) => {
    await axios.delete(url + `admin/users/${id}`);
  };
  return {
    users,
    user,
    getUsers,
    storeUser,
    updateUser,
    getUser,
    destroyUser,
    errors,
    isPending,
  };
}
