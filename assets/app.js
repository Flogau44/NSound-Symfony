import { createApp } from "vue";
import "./styles/app.css";
import App from "./App.vue";
import router from "./router/index.js";
import apiClient from "./axios.js";

const app = createApp(App);
app.config.globalProperties.$axios = apiClient;
app.use(router);
app.mount("#app");
