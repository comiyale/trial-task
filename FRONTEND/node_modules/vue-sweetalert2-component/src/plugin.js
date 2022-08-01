import SweetAlert from './SweetAlert.vue';

module.exports = {
  install: function (Vue, options) {
    Vue.component('sweet-alert', SweetAlert);
  }
};
