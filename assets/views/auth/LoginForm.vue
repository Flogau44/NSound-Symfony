<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="flex flex-col items-center space-y-4">
        <!-- Logo du site avec lien vers la page d'accueil -->
        <div>
          <a href="/">
            <img
              src="../../images/logo_1.png"
              class="w-20 md:w-28"
              alt="logo"
            />
          </a>
        </div>
        <!-- Titre de la page de connexion -->
        <div class="mb-4 flex flex-row justify-center">
          <h1>Se connecter</h1>
        </div>
      </div>

      <div class="w-full md:w-[600px] mx-auto text-xl text-darkblue">
        <div class="border rounded m-6 p-6 shadow-md">
          <p class="text-blue pb-4">
            Saisissez votre adresse électronique ci-dessous pour vous connecter
            à votre compte.
          </p>

          <!-- Formulaire de connexion -->
          <form @submit.prevent="login" class="flex flex-col gap-y-6">
            <!-- Champ pour l'adresse e-mail -->
            <div>
              <label for="email" class="block font-medium text-blue"
                >Email *</label
              >
              <input
                type="email"
                class="block border p-2 w-full rounded"
                :class="data.email ? 'bg-blue-100' : 'bg-white'"
                placeholder="votre@email.com"
                v-model="data.email"
                name="email"
                required
              />
            </div>

            <!-- Champ pour le mot de passe -->
            <div>
              <label for="password" class="block font-medium text-blue"
                >Password *</label
              >
              <div class="relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  class="block border p-2 w-full rounded"
                  :class="data.password ? 'bg-blue-100' : 'bg-white'"
                  placeholder="Votre mot de passe"
                  v-model="data.password"
                  required
                />
                <!-- Icône pour afficher/cacher le mot de passe -->
                <span
                  class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                  @click="togglePasswordVisibility"
                >
                  <i
                    :class="
                      showPassword
                        ? 'fa-regular fa-eye-slash'
                        : 'fa-regular fa-eye'
                    "
                  ></i>
                </span>
              </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="my-6">
              <button
                type="submit"
                class="w-full h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700 cursor-pointer"
              >
                Se connecter
              </button>
            </div>
          </form>

          <!-- Lien vers la page d'inscription -->
          <div class="flex flex-row justify-center gap-x-4">
            <div class="text-blue">Vous n'avez pas de compte ?</div>
            <div>
              <router-link
                :to="{ name: 'RegisterForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
              >
                S'inscrire
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import apiClient from "../../axios";
import Cookies from "js-cookie";
import { useToast } from "vue-toastification";

export default {
  name: "LoginForm",
  setup() {
    // Déclaration des variables réactives
    const data = reactive({
      email: "", // Stocke l'e-mail de l'utilisateur
      password: "", // Stocke le mot de passe de l'utilisateur
    });

    const router = useRouter(); // Permet la navigation entre les pages
    const store = useStore(); // Permet de gérer l'état global avec Vuex
    const showPassword = ref(false); // Gère la visibilité du mot de passe
    const toast = useToast(); // Initialisation des notifications toast

    // Fonction de connexion avec gestion des erreurs
    const login = async () => {
      const restUrl = "/login"; // URL de l'API pour la connexion

      try {
        const response = await apiClient.post(restUrl, {
          email: data.email,
          password: data.password,
        });
        const result = response.data;

        // Si la réponse est OK, connexion réussie
        if (response.status === 200) {
          // Stocker les tokens dans les cookies
          Cookies.set("token", result.token);
          Cookies.set("refresh_token", result.refresh_token);
          store.dispatch("login", { email: data.email }); // Met à jour l'état Vuex

          toast.success("Connexion réussie !", { timeout: 3000 }); // Affiche un toast de succès
          router.push("/"); // Redirige vers la page d'accueil
        }
      } catch (error) {
        // En cas d'erreur, affiche un message
        toast.error(
          "Erreur de connexion. Vérifiez votre email et mot de passe.",
          {
            timeout: 5000,
          }
        );
      }
    };

    // Fonction pour basculer la visibilité du mot de passe
    const togglePasswordVisibility = () => {
      showPassword.value = !showPassword.value;
    };

    return {
      data,
      showPassword,
      login,
      togglePasswordVisibility,
    };
  },
};
</script>
