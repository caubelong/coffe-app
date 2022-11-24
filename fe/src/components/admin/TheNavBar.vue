<template>
  <div style="width: 100%">
    <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      mode="inline"
    >
      <a-menu-item
        @click="$emit('pushPage')"
        v-for="(route, index) in listRouter"
        :key="index"
      >
        <router-link :to="{ name: route.name }">
          <span>{{ route.meta.name_show }}</span>
        </router-link>
      </a-menu-item>
    </a-menu>
  </div>
</template>

<script>
import { computed } from "vue";
//import {ref} from "vue";
import admin from "@/router/admin";
import { useStoreMenu } from "@/store/store-nav-menu";
import { storeToRefs } from "pinia";
export default {
  name: "TheNavBar",
  emits: ["pushPage"],
  setup() {
    const listRouter = computed(() => {
      return [...admin[0].children].filter(
        (router) => router?.meta?.name_show && router?.meta?.name_show !== ""
      );
    });
    // const state = reactive({
    //   selectedKeys: ["1"],
    //   openKeys: ["sub1"],
    // });
    //cach viet khac cua ..toReft la su dung reactive theo object r ...toReft de theo doi
    // const selectedKeys=ref([])
    // const openKeys=ref([])
    //khi thay doi route link thi se doi mau phan route dang hien thi tren menu va noi dung cung thay doi theo
    const storeMenu = useStoreMenu();
    //const { selectedKeys, openKeys } = storeMenu;
    return {
      //...toRefs(state),
      ...storeToRefs(storeMenu),
      listRouter,
      // selectedKeys,
      // openKeys,
    };
  },
};
</script>

<style scoped></style>
