import { defineStore } from "pinia";
export const getUrlApi = defineStore("urlApi", {
  state: () => {
    return {
      apiUrl: "http://127.0.0.1:8082/api/",
    };
  },
});
