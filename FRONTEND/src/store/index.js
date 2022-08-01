import Vue from "vue";
import Vuex from "vuex";

//Load Vuex
Vue.use(Vuex);


// Url store
const urlCommons = {
  state: {
    baseUrl: "http://localhost:8000/apiv1/",
    getNotesUrl: "getNotes",
    createTagUrl: "createTag",
    getTagsUrl: "getTags",
    deleteTagUrl: "deleteTag",
    createNoteUrl: "createNote"
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