import { createRouter, createWebHistory } from "vue-router";
import admin from "@/router/admin";
import user from "@/router/user";

const routes = [...admin, ...user];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
//kiem tra xem nguoi dung dang nhap chua, neu chua dang nhap thi dua ve trang login
// router.beforeEach((to, from, next) => {
//   const loggedIn = localStorage.getItem("token");
//
//   if (to.matched.some((record) => record.meta.auth) && !loggedIn) {
//     next("/login");
//     return;
//   }
//   next();
// });

export default router;
