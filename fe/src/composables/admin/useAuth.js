import { getUrlApi } from "@/store/getUrlApi";
import axios from "axios";
import { ref } from "vue";
import { useToken } from "@/store/getUserToken";
export default function useAuth() {
  const user = ref([]);
  const errors = ref(null);
  const isPending = ref(false);
  const url = getUrlApi().$state.apiUrl;
  const getUserCurrent = useToken();
  const { getCurrentUser } = getUserCurrent;
  const login = async (data) => {
    errors.value = null;
    isPending.value = true;
    try {
      const res = await axios.post(url + "auth/login", data);
      await localStorage.setItem("token", res.data.token);
      await getCurrentUser();
      if (!res) throw new Error("Login false");
    } catch (err) {
      errors.value = err;
    } finally {
      isPending.value = false;
    }
  };
  return {
    user,
    login,
    errors,
    isPending,
  };
}
