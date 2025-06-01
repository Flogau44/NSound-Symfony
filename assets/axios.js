import axios from "axios";

// Crée une instance d'axios avec une configuration par défaut
const apiClient = axios.create({
  baseURL: "http://127.0.0.1:8000/api", // Définir l'URL de base pour toutes les requêtes API
  headers: {
    "Content-Type": "application/json", // Définir le type de contenu par défaut pour les requêtes
  },
});

// Fonction pour rafraîchir le token
const refreshToken = async () => {
  try {
    const response = await axios.post(
      "http://127.0.0.1:8000/api/token/refresh",
      {
        refresh_token: localStorage.getItem("refresh_token"), // Récupère le refresh token depuis le stockage local
      }
    );
    localStorage.setItem("token", response.data.token); // Stocke le nouveau token dans le stockage local
    console.log("New token:", response.data.token); // Vérifie le nouveau token
    return response.data.token; // Retourne le nouveau token
  } catch (error) {
    console.error("Unable to refresh token", error); // Affiche une erreur si le rafraîchissement échoue
    throw error; // Relance l'erreur pour la gestion ultérieure
  }
};

// Ajoute un intercepteur pour inclure le token d'authentification dans les en-têtes de toutes les requêtes
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem("token"); // Récupère le token d'authentification depuis le stockage local
  if (token) {
    config.headers["Authorization"] = `Bearer ${token}`; // Ajoute le token d'authentification aux en-têtes de la requête
  }
  return config; // Retourne la configuration de la requête modifiée
});

// Ajoute un intercepteur pour gérer les erreurs d'authentification
apiClient.interceptors.response.use(
  (response) => response, // Retourne la réponse si elle est réussie
  async (error) => {
    const originalRequest = error.config; // Sauvegarde la requête originale
    if (error.response.status === 401 && !originalRequest._retry) {
      // Vérifie si l'erreur est due à une authentification échouée et si la requête n'a pas déjà été réessayée
      originalRequest._retry = true; // Marque la requête comme réessayée
      try {
        const newToken = await refreshToken(); // Tente de rafraîchir le token
        localStorage.setItem("token", newToken); // Met à jour le token dans le local storage
        apiClient.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${newToken}`; // Met à jour le token d'authentification par défaut
        originalRequest.headers["Authorization"] = `Bearer ${newToken}`; // Met à jour le token d'authentification pour la requête originale
        return apiClient(originalRequest); // Réessaie la requête originale avec le nouveau token
      } catch (err) {
        // Affiche un message d'erreur à l'utilisateur sans le déconnecter
        console.error("Unable to refresh token, please login again.", err);
        return Promise.reject(err); // Rejette l'erreur pour la gestion ultérieure
      }
    }
    return Promise.reject(error); // Rejette l'erreur si elle ne peut pas être résolue
  }
);

export default apiClient; // Exporte l'instance
