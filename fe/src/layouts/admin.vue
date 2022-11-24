<template>
  <TheHeader></TheHeader>
  <div class="container-fluid mt-3">
    <div class="row">
      <div class="col-sm-2 d-none d-sm-flex">
        <a-list bordered style="width: 100%">
          <the-nav-bar></the-nav-bar>
          <template #header>
            <div>Danh mục quản lý</div>
          </template>
        </a-list>
      </div>
      <div class="col-12 col-sm-10">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import TheNavBar from "@/components/admin/TheNavBar";
import TheHeader from "@/components/admin/TheHeader";
export default {
  name: "admin-comp",
  components: {
    TheNavBar,
    TheHeader,
  },
  setup() {},
};
</script>

<style scoped></style>
