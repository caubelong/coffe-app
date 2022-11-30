<template>
  <div class="container-fluid" style="border-bottom: 1px solid #c7c7c7">
    <theHeader></theHeader>
  </div>
  <router-view></router-view>
  <footer class="bg-light text-center text-lg-start mt-5">
    <div
      class="text-center p-3 text-white"
      style="background-color: #3c5e2c; height: 150px"
    >
      Công ty TNHH Cộng Cà Phê
      <br />
      Mã số DN: 0106696845 do Sở Kế hoạch và Đầu tư TP. Hà Nội cấp ngày
      21/11/2014
      <br />
      Địa chỉ: Số 101 Hoàng Cầu, phường Ô Chợ Dừa, quận Đống Đa, Hà Nội - Số
      điện thoại:
      <br />
      <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
  </footer>
</template>

<script>
// import { useRouter } from "vue-router";
// import { onMounted } from "vue";
import theHeader from "@/components/user/theHeader";
export default {
  name: "user-comp",
  components: {
    theHeader,
  },
  setup() {
    // const route = useRouter();
    // onMounted(() => {
    //   route.push("/home");
    // });
  },
};
</script>

<style>
@media (max-width: 575.98px) {
  #main-wrap {
    padding: 0 10px;
  }
}
@media (min-width: 1400px) {
  #main-wrap {
    padding: 0 140px;
  }
}
</style>
