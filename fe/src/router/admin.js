import Admin from "@/layouts/admin";
import NotFound from "@/pages/NotFound";
const admin = [
  {
    path: "/admin",
    component: Admin,
    meta: {
      auth: true,
    },
    children: [
      {
        path: "category",
        name: "admin-category",
        meta: {
          name_show: "Danh mục sản phẩm",
        },
        component: () => import("../pages/admin/category"),
      },
      {
        path: "product",
        name: "admin-product",
        meta: {
          name_show: "Sản phẩm",
        },
        component: () => import("../pages/admin/product"),
      },
      {
        path: "product/create",
        name: "admin-product-create",
        component: () => import("../pages/admin/product/create.vue"),
      },
      {
        path: "product/update/:id",
        name: "admin-product-update",
        component: () => import("../pages/admin/product/edit.vue"),
      },
      {
        path: "topping",
        name: "admin-topping",
        meta: {
          name_show: "Topping",
        },
        component: () => import("../pages/admin/topping"),
      },
      {
        path: "/topping/create",
        name: "admin-topping-create",
        component: () => import("../pages/admin/topping/create.vue"),
      },
      {
        path: "topping/update/:id",
        name: "admin-topping-edit",
        component: () => import("../pages/admin/topping/edit.vue"),
      },
      //post
      {
        path: "post",
        name: "admin-post",
        meta: {
          name_show: "Bài viết",
        },
        component: () => import("../pages/admin/post"),
      },
      {
        path: "post/create/",
        name: "admin-post-create",
        component: () => import("../pages/admin/post/create.vue"),
      },
      {
        path: "post/edit/:id",
        name: "admin-post-update",
        component: () => import("../pages/admin/post/edit.vue"),
      },
      {
        path: "post/info-post/:id",
        name: "admin-post-info",
        component: () => import("../pages/admin/post/info.vue"),
      },
      //user
      {
        path: "user",
        name: "admin-user",
        meta: {
          name_show: "Tài khoản",
        },
        component: () => import("../pages/admin/user"),
      },
      {
        path: "user/create",
        name: "admin-user-create",
        component: () => import("../pages/admin/user/create"),
      },
      {
        path: "user/update/:id",
        name: "admin-user-update",
        component: () => import("../pages/admin/user/update"),
      },
      //role
      {
        path: "role",
        name: "admin-role",
        meta: {
          name_show: "Role",
        },
        component: () => import("../pages/admin/role"),
      },
      {
        path: "order",
        name: "admin-order",
        meta: {
          name_show: "Order",
        },
        component: () => import("../pages/admin/order"),
      },
    ],
  },
  { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
  {
    path: "/login",
    name: "login",
    component: () => import("../pages/admin/authentication/login.vue"),
  },
];
export default admin;
