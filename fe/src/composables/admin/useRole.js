import { ref } from "vue";
import axios from "axios";
import { getUrlApi } from "@/store/getUrlApi";
import { useToken } from "@/store/getUserToken";
export default function useRoles() {
  const url = getUrlApi().$state.apiUrl;
  const roles = ref([]);
  const role = ref([]);
  const errors = ref(null);
  const isPending = ref(false);
  const getUserToken = useToken();
  const { headers } = getUserToken;
  //get role
  const getRoles = async () => {
    errors.value = null;
    try {
      const res = await axios.get(url + "admin/roles", {
        headers: headers,
      });
      roles.value = await res.data;
    } catch (e) {
      console.log(e);
    }
  };
  //get role is id
  const getRole = async (id) => {
    errors.value = null;
    try {
      const res = await axios.get(url + `admin/roles/${id}`, {
        headers: headers,
      });
      role.value = await res.data;
    } catch (e) {
      console.log(e);
    }
  };
  //add role
  const storeRole = async (data) => {
    isPending.value = true;
    errors.value = null;
    try {
      const res = await axios.post(url + "admin/roles", data, {
        headers: headers,
      });
      if (!res) throw new Error("Could not create a new role");
      return res;
    } catch (error) {
      errors.value = error.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  //update
  const updateRole = async (id) => {
    errors.value = null;
    isPending.value = true;
    try {
      const res = await axios.put(url + `admin/roles/${id}`, role.value, {
        headers: headers,
      });
      if (!res) throw new Error("Could not update role ");
    } catch (error) {
      errors.value = error.response.data.errors;
    } finally {
      isPending.value = false;
    }
  };
  //destroy
  const removeRole = async (id) => {
    await axios.delete(url + "admin/roles/" + id, {
      headers: headers,
    });
  };
  return {
    getRoles,
    getRole,
    storeRole,
    updateRole,
    removeRole,
    roles,
    role,
    isPending,
    errors,
  };
}
