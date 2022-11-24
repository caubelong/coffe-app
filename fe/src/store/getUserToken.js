import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";
import router from "@/router";
export const useToken = defineStore("Token", () => {
  const token = ref(null);
  const currentUser = ref(null);
  const getToken = () => {
    token.value = localStorage.getItem("token");
    return `Bearer ${token.value}`;
  };
  let headers = {
    Authorization: getToken(),
  };
  const getCurrentUser = async () => {
    if (!headers) {
      getToken();
      headers = {
        Authorization: getToken(),
      };
    }
    if (localStorage.getItem("token")) {
      const res = await axios.get("http://127.0.0.1:8082/api/" + "user", {
        headers: headers,
      });
      currentUser.value = await res.data;
      localStorage.setItem("user", JSON.stringify(currentUser.value));
    }
  };
  const destroyToken = async () => {
    await axios.get("http://127.0.0.1:8082/api/auth/logout", {
      headers: headers,
    });
    await localStorage.removeItem("token");
    await localStorage.removeItem("user");
    if (!localStorage.getItem("token")) {
      headers = null;
      await router.push({ name: "login" });
      console.log("log out success");
    }
  };
  return {
    getCurrentUser,
    currentUser,
    destroyToken,
    token,
    getToken,
    headers,
  };
});
