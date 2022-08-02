import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: () => import("../views/Points.vue")
  },
  {
    path: "/Home",
    name: "Home",
    component: () => import("../views/Points.vue")
  },
  {
    path: "/AddPoint",
    name: "AddPoint",
    component: () => import("../views/AddPoint.vue")
  },
  {
    path: "/EditPoint/:pointId",
    name: "EditPoint",
    component: () => import("../views/EditPoint.vue")
  },

];

const router = new VueRouter({
  routes
});

export default router;