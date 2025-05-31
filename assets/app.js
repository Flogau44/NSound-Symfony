import { createApp } from "vue";
import "./styles/app.css";
import App from "./App.vue";
import router from "./router/index.js";
import apiClient from "./axios.js";
import store from "./store/store.js";
import toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);
app.config.globalProperties.$axios = apiClient;
app.use(store);
app.use(router);
app.use(toast);
app.mount("#app");
