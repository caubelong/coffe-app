<template>
  <h1>index order</h1>
</template>

<script>
import { useStoreMenu } from "@/store/store-nav-menu";

export default {
  name: "index-order",
  setup() {
    const storeMenu = useStoreMenu();
    storeMenu.onSelectedKeys(["admin-order"]);
  },
};
</script>

<style scoped></style>
