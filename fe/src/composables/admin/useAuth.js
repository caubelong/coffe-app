import { getUrlApi } from "@/store/getUrlApi";
import axios from "axios";
import { ref } from "vue";
export default function useAuth() {
  const errors = ref(null);
  const isPending = ref(false);
  const url = getUrlApi().$state.apiUrl;
  const login = async (data) => {
    errors.value = null;
    isPending.value = true;
    try {
      const res = await axios.post(url + "auth/login", data);
      await localStorage.setItem("login", "succsess");
      console.log(res.data.user);
      await localStorage.setItem("user", JSON.stringify(res.data.user));
      if (!res) throw new Error("Login false");
    } catch (err) {
      errors.value = err.response.data.message;
    } finally {
      isPending.value = false;
    }
  };
  return {
    login,
    errors,
    isPending,
  };
}
