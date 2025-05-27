import { createStore } from "vuex";
import Cookies from "js-cookie";

// Création du magasin Vuex
export default createStore({
  // État initial du magasin
  state: {
    // Vérifie si l'utilisateur est authentifié en lisant les cookies
    auth: Cookies.get("auth") === "true",
    // Vérifie si un email est stocké, en récupérant le premier élément du tableau "emails"
    userEmail: Cookies.get("emails")
      ? JSON.parse(Cookies.get("emails"))[0]
      : "", // Assure une valeur par défaut
  },

  // Mutations pour modifier l'état du magasin
  mutations: {
    // Mutation pour définir l'état d'authentification
    setAuth(state, auth) {
      state.auth = auth;
      // Met à jour l'état d'authentification dans les cookies
      Cookies.set("auth", auth);
    },

    // Mutation pour stocker l'email de l'utilisateur
    setUserEmail(state, email) {
      if (email) {
        state.userEmail = email;
        // Stocke l'email sous forme de tableau pour correspondre à la structure actuelle
        Cookies.set("emails", JSON.stringify([email]));
      } else {
        state.userEmail = "";
        // Supprime le cookie si l'email est vide
        Cookies.remove("emails");
      }
    },
  },

  // Actions pour effectuer des opérations asynchrones
  actions: {
    // Action pour connecter l'utilisateur
    login({ commit }, userData) {
      // Vérifie que userData contient bien un email valide avant de le stocker
      if (!userData || typeof userData !== "object" || !userData.email) {
        console.error("Erreur : userData incorrect", userData); // Affiche l'objet pour vérifier
        return;
      }
      // Met à jour l'état d'authentification et stocke l'email de l'utilisateur
      commit("setAuth", true);
      commit("setUserEmail", userData.email);
    },

    // Action pour déconnecter l'utilisateur
    logout({ commit }) {
      // Réinitialise l'état d'authentification et supprime l'email
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
    // Getter pour récupérer l'email de l'utilisateur
    userEmail: (state) => state.userEmail,
  },
});
