<template>
  <div
    class="container-fluid"
    style="margin: 0; padding: 0; background-color: #0c713d"
  >
    <div class="row text-white" style="margin: 0">
      <div
        class="col-1 d-flex d-sm-none justify-content-center align-items-center"
      >
        <span @click="showDrawer()">
          <MenuOutlined></MenuOutlined>
        </span>
      </div>
      <div
        class="col-10 col-sm-9 d-flex justify-content-center justify-content-sm-start align-items-center"
      >
        <img
          width="34"
          height="32"
          src="https://avatars.githubusercontent.com/u/6128107?s=280&v=4"
          alt=""
        />
        <span class="d-sm-flex">Trang Admin</span>
      </div>
      <div
        class="col-sm-3 d-none d-sm-flex justify-content-sm-end align-items-center"
      >
        <a-dropdown :trigger="['click']">
          <a class="ant-dropdown-link" style="color: #fff" @click.prevent>
            {{ userLoginInfo?.email }}
          </a>
          <template #overlay>
            <a-menu>
              <a-menu-item key="0">
                <a href="http://www.alipay.com/">Thông tin tài khoản</a>
              </a-menu-item>
              <a-menu-item key="1">
                <span @click="destroyToken">Log out</span>
              </a-menu-item>
            </a-menu>
          </template>
        </a-dropdown>
      </div>
      <div
        class="col-1 d-sm-none d-flex justify-content-center align-items-center"
      >
        <span @click="showDrawerUser()">
          <UserOutlined></UserOutlined>
        </span>
      </div>
    </div>
  </div>
  <!--  menu is mobile-->
  <!--  menu quan ly-->
  <a-drawer
    v-model:visible="visible"
    title="Danh mục quản lý"
    placement="left"
    width="300"
  >
    <TheNavBar @pushPage="closeMenu"></TheNavBar>
  </a-drawer>
  <!--  menu quan ly tai khoan -->
  <a-drawer
    @click="closeMenu"
    v-model:visible="visible_user"
    title="Danh mục quản lý"
    placement="right"
    width="300"
  >
    <p>
      <a href="">{{ userLoginInfo.name }}</a>
    </p>
    <p @click="destroyToken">Logout</p>
  </a-drawer>
</template>
<script>
import { defineComponent, ref } from "vue";
import { MenuOutlined, UserOutlined } from "@ant-design/icons-vue";
import TheNavBar from "@/components/admin/TheNavBar";
import { useToken } from "@/store/getUserToken";
export default defineComponent({
  components: {
    TheNavBar,
    MenuOutlined,
    UserOutlined,
  },
  // props: {
  //   user: {
  //     type: {},
  //     default: {},
  //   },
  // },
  setup() {
    const visible = ref(false);
    const visible_user = ref(false);
    const getUserCurrent = useToken();
    const { destroyToken } = getUserCurrent;
    const userLoginInfo = JSON.parse(localStorage.getItem("user"));
    const showDrawer = () => {
      visible.value = true;
    };
    const showDrawerUser = () => {
      visible_user.value = true;
    };
    const closeMenu = () => {
      if (visible.value) {
        visible.value = false;
      }
    };
    return {
      visible,
      showDrawer,
      showDrawerUser,
      visible_user,
      closeMenu,
      destroyToken,
      userLoginInfo,
    };
  },
});
</script>

<style scoped></style>
