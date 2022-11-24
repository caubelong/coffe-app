import { defineStore } from "pinia";
export const useStoreMenu = defineStore("menuId", {
  state: () => ({
    selectedKeys: [],
    openKeys: [],
  }),
  actions: {
    onSelectedKeys(data) {
      this.selectedKeys = data;
    },
    onOpenKey(data) {
      this.openKeys = data;
    },
  },
});
