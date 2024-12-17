import { createStore } from "vuex";

export default createStore({
  state: {
    auth: localStorage.getItem("auth") === "true",
  },
  mutations: {
    setAuth(state, auth) {
      state.auth = auth;
      localStorage.setItem("auth", auth);
    },
  },
  actions: {
    login({ commit }, auth) {
      commit("setAuth", auth);
    },
    logout({ commit }) {
      commit("setAuth", false);
      localStorage.removeItem("token");
      localStorage.removeItem("refresh_token");
    },
  },
  getters: {
    isAuthenticated: (state) => state.auth,
  },
});
