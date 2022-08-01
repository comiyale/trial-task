import Vue from 'vue'
import App from './App.vue'
import router from "./router";
import store from "./store";
import SweetAlertIcons from 'vue-sweetalert-icons';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(SweetAlertIcons);
Vue.use(VueSweetalert2);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
