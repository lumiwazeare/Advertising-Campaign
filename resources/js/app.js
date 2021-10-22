import { createApp } from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import App from './App.vue'
import router from "./route";

createApp(App).use(router).mount("#app");

require('./bootstrap');
