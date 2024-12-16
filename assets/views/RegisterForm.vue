<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-4 flex flex-row justify-center">
        <h1 class="uppercase">— M'inscrire —</h1>
      </div>
      <div class="w-full md:w-[400px] mx-auto text-xl text-darkblue">
        <div class="p-6">
          <!-- Formulaire d'inscription -->
          <form
            @submit.prevent="register"
            class="flex flex-col gap-y-6"
            novalidate
          >
            <!-- Champ de saisie pour l'adresse e-mail -->
            <div>
              <label for="email">E-mail<span class="text-red">*</span></label>
              <input
                type="email"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                v-model="email"
                required
                @input="validateEmail"
              />
              <!-- Message d'erreur pour l'adresse e-mail -->
              <p v-if="emailError" class="text-red">{{ emailError }}</p>
            </div>
            <!-- Champ de saisie pour le mot de passe -->
            <div>
              <label for="password"
                >Mot de passe<span class="text-red">*</span></label
              >
              <div class="relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  class="block w-full mt-1 px-2 pr-10 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                  v-model="password"
                  required
                  @input="validatePassword"
                />
                <!-- Icône pour afficher/masquer le mot de passe -->
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
              <!-- Message d'erreur pour le mot de passe -->
              <p v-if="passwordError" class="text-red">
                {{ passwordError }}
              </p>
            </div>
            <!-- Bouton de soumission du formulaire -->
            <div class="my-6">
              <button
                type="submit"
                class="h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700"
              >
                M'inscrire
              </button>
            </div>
          </form>
          <!-- Liens supplémentaires pour se connecter -->
          <div class="flex flex-row gap-x-4">
            <div>Déjà inscrit(e)?</div>
            <div>
              <router-link
                :to="{ name: 'LoginForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page de connexion du site 'Nation Sound'"
              >
                Me connecter
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import apiClient from "../axios"; // Importation du client API pour effectuer les requêtes HTTP
import { useRouter } from "vue-router"; // Importation de vue-router pour la redirection

export default {
  name: "RegisterForm", // Nom du composant
  data() {
    return {
      email: "", // Adresse e-mail de l'utilisateur
      password: "", // Mot de passe de l'utilisateur
      showPassword: false, // Indicateur pour afficher/masquer le mot de passe
      emailError: "", // Message d'erreur pour l'adresse e-mail
      passwordError: "", // Message d'erreur pour le mot de passe
    };
  },
  setup() {
    const router = useRouter(); // Utilisation de vue-router pour la redirection
    return { router };
  },
  methods: {
    // Méthode pour gérer la soumission du formulaire d'inscription
    async register() {
      // Validation du mot de passe
      if (this.password.length < 12) {
        this.passwordError =
          "Le mot de passe doit contenir au moins 12 caractères.";
        return;
      }
      try {
        // Envoi de la requête POST à l'API d'inscription
        const response = await apiClient.post("/register", {
          email: this.email,
          password: this.password,
        });
        console.log("Inscription réussie", response.data);
        // Redirection vers la page de connexion après inscription réussie
        this.router.push("/login");
      } catch (error) {
        // Affichage du message d'erreur en cas d'erreur lors de l'inscription
        console.error("Erreur lors de l'inscription", error);
        this.emailError = "Une erreur est survenue lors de l'inscription.";
      }
    },
    // Méthode pour afficher/masquer le mot de passe
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    // Méthode pour valider le mot de passe
    validatePassword() {
      const strongPasswordPattern =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
      if (!strongPasswordPattern.test(this.password)) {
        this.passwordError =
          "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
      } else {
        this.passwordError = "";
      }
    },
    // Méthode pour valider l'adresse e-mail
    validateEmail() {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(this.email)) {
        this.emailError = "Veuillez entrer une adresse e-mail valide.";
      } else {
        this.emailError = "";
      }
    },
  },
};
</script>
