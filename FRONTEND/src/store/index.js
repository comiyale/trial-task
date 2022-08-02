import Vue from "vue";
import Vuex from "vuex";

//Load Vuex
Vue.use(Vuex);


// Url store
const urlCommons = {
  state: {
    baseUrl: "http://localhost:8000/apiv1/",

    getPointsUrl: "getPoints",
    getPointUrl: "getPoint",
    deletePointsUrl: "deletePoint",
    createPointUrl: "createPoint",
    updatePointUrl: "updatePoint",

  },
  getter: {
    baseUrl: state => {
      return state.baseUrl;
    }
  },
  setter: {},
  mutations: {}
};

// Main store
export default new Vuex.Store({
  actions: {},
  modules: {
    urlStore: urlCommons
  }
});