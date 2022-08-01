import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: () => import("../views/Notes.vue")
  },
  {
    path: "/Home",
    name: "Home",
    component: () => import("../views/Notes.vue")
  },
  {
    path: "/AddNote",
    name: "AddNote",
    component: () => import("../views/AddNote.vue")
  },
  {
    path: "/AddTag",
    name: "AddTag",
    component: () => import("../views/AddTag.vue")
  }
];

const router = new VueRouter({
  routes
});

export default router;