import home from "@/layouts/user";
import NotFound from "@/pages/user/NotFound";
const user = [
  {
    path: "/",
    name: "home",
    component: home,
    children: [
      { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
      {
        path: "home",
        name: "home-page",
        component: () => import("../pages/user/index"),
      },
      {
        path: "story",
        name: "story-page",
        component: () => import("../pages/user/info"),
      },
      {
        path: "menu",
        name: "home-menu",
        component: () => import("../pages/user/menu/menu"),
      },
      {
        path: "menu/info/:id",
        name: "home-menu-info",
        component: () => import("../pages/user/menu/info-item"),
      },
      {
        path: "post",
        name: "home-post",
        component: () => import("../pages/user/post/post"),
      },
      {
        path: "post-detail/:id",
        name: "home-post-detail",
        component: () => import("../pages/user/post/detail-post"),
      },
      {
        path: "contact",
        name: "home-contact",
        component: () => import("../pages/user/contact"),
      },
      {
        path: "info",
        name: "home-info",
        component: () => import("../pages/user/info"),
      },
    ],
  },
];
export default user;
