import { createStore } from "vuex";
import Cookies from "js-cookie";

// Création du magasin Vuex
export default createStore({
  // État initial du magasin
  state: {
    // Vérifie si l'utilisateur est authentifié en lisant les cookies
    auth: Cookies.get("auth") === "true",
  },
  // Mutations pour modifier l'état du magasin
  mutations: {
    // Mutation pour définir l'état d'authentification
    setAuth(state, auth) {
      state.auth = auth;
      // Met à jour l'état d'authentification dans les cookies
      Cookies.set("auth", auth);
    },
  },
  // Actions pour effectuer des opérations asynchrones
  actions: {
    // Action pour connecter l'utilisateur
    login({ commit }, auth) {
      // Appelle la mutation setAuth pour mettre à jour l'état
      commit("setAuth", auth);
    },
    // Action pour déconnecter l'utilisateur
    logout({ commit }) {
      // Appelle la mutation setAuth pour mettre à jour l'état
      commit("setAuth", false);
      // Supprime les tokens des cookies
      Cookies.remove("token");
      Cookies.remove("refresh_token");
    },
  },
  // Getters pour accéder à l'état du magasin
  getters: {
    // Getter pour vérifier si l'utilisateur est authentifié
    isAuthenticated: (state) => state.auth,
  },
});
