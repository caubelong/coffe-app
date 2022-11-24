<template>
  <header class="container" id="header">
    <div class="row">
      <div
        class="col-1 d-flex d-sm-none justify-content-center align-items-center"
      >
        <span @click="showDrawer" style="padding-left: -10px">
          <MenuOutlined></MenuOutlined>
        </span>
      </div>
      <div class="col-11 col-sm-5 d-flex mt-3">
        <router-link :to="{ name: 'home-page' }">
          <h3 class="logo-text">Coffe App</h3>
        </router-link>
      </div>
      <div class="d-none d-sm-flex col-sm-7 mt-3">
        <ul class="d-sm-flex list-menu" id="list-menu">
          <router-link :to="{ name: 'home-info' }" class="item-menu-link"
            ><li class="list-menu-item">Câu truyện</li></router-link
          >
          <router-link
            :to="{ name: 'home-menu' }"
            v-if="$route.path"
            class="item-menu-link"
            ><li class="list-menu-item">Menu</li></router-link
          >
          <router-link :to="{ name: 'home-post' }" class="item-menu-link"
            ><li class="list-menu-item">Bảng tin</li></router-link
          >
          <router-link :to="{ name: 'home-contact' }" class="item-menu-link"
            ><li class="list-menu-item">Liên hệ</li></router-link
          >
        </ul>
      </div>
    </div>
  </header>
  <!--  menu mobile-->
  <a-drawer
    v-model:visible="visible"
    class="custom-class"
    placement="left"
    width="300"
  >
    <router-link
      @click="closeMenu"
      :to="{ name: 'home-info' }"
      class="item-menu-link"
      ><p class="list-menu-item">Câu truyện</p></router-link
    >
    <router-link
      @click="closeMenu"
      :to="{ name: 'home-post' }"
      class="item-menu-link"
      ><p class="list-menu-item">Bảng tin</p></router-link
    >
    <router-link
      @click="closeMenu"
      :to="{ name: 'home-menu' }"
      class="item-menu-link"
      ><p class="list-menu-item">Thực đơn</p></router-link
    >
    <router-link
      @click="closeMenu"
      :to="{ name: 'home-contact' }"
      class="item-menu-link"
      ><p class="list-menu-item">liên hệ</p></router-link
    >
  </a-drawer>
</template>

<script>
import { MenuOutlined } from "@ant-design/icons-vue";
import { ref } from "vue";

export default {
  name: "header-comp",
  components: {
    MenuOutlined,
  },
  setup() {
    const visible = ref(false);
    const showDrawer = () => {
      visible.value = true;
    };
    const closeMenu = () => {
      if (visible.value) {
        visible.value = false;
      }
    };
    return {
      visible,
      showDrawer,
      closeMenu,
    };
  },
};
</script>

<style scoped>
.list-menu-item {
  list-style: none;
  margin-left: 30px;
  font-size: 20px;
  text-transform: uppercase;
}
.item-menu-link {
  color: #000000;
}
.item-menu-link:hover {
  color: #ea8025;
}
.router-link-active {
  color: #ea8025;
}
</style>
