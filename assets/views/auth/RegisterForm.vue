<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="flex flex-col items-center space-y-4">
        <div>
          <a href="/">
            <img
              src="../../images/logo_1.png"
              class="w-20 md:w-28"
              alt="logo"
            />
          </a>
        </div>
        <div class="mb-4 flex flex-row justify-center">
          <h1>Sign Up</h1>
        </div>
      </div>
      <div class="w-full md:w-[600px] mx-auto text-xl text-darkblue">
        <div class="border rounded m-6 p-6 shadow-md">
          <p class="text-blue pb-4">
            Enter your information to create an account.
          </p>
          <!-- Formulaire d'inscription -->
          <form
            @submit.prevent="register"
            class="flex flex-col gap-y-6"
            novalidate
          >
            <!-- Champ de saisie pour l'adresse e-mail -->
            <div>
              <label for="email" class="block font-medium text-blue"
                >Email<span class="text-red">*</span></label
              >
              <input
                type="email"
                class="block border p-2 w-full rounded"
                :class="email ? 'bg-blue-100' : 'bg-white'"
                placeholder="your@email.com"
                v-model="email"
                required
                @input="validateEmail"
              />
              <!-- Message d'erreur pour l'adresse e-mail -->
              <p v-if="emailError" class="text-red">{{ emailError }}</p>
            </div>
            <!-- Champ de saisie pour le mot de passe -->
            <div>
              <label for="password" class="block font-medium text-blue"
                >Password<span class="text-red">*</span></label
              >
              <div class="relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  class="block border p-2 w-full rounded"
                  :class="password ? 'bg-blue-100' : 'bg-white'"
                  placeholder="Enter your password"
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
                class="w-full h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700"
              >
                Sign Up
              </button>
            </div>
          </form>
          <!-- Liens supplémentaires pour se connecter -->
          <div class="flex flex-row justify-center gap-x-4">
            <div class="text-blue">Already have an account ?</div>
            <div>
              <router-link
                :to="{ name: 'LoginForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page de connexion du site 'Nation Sound'"
              >
                Sign In
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import apiClient from "../../axios"; // Importation du client API pour effectuer les requêtes HTTP
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
          "The password must contain at least 12 characters.";
        return;
      }
      try {
        // Envoi de la requête POST à l'API d'inscription
        const response = await apiClient.post("/register", {
          email: this.email,
          password: this.password,
        });
        console.log("Successful registration", response.data);
        // Redirection vers la page de connexion après inscription réussie
        this.router.push("/login");
      } catch (error) {
        // Affichage du message d'erreur en cas d'erreur lors de l'inscription
        console.error("Registration error", error);
        this.emailError = "An error occurred during registration.";
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
          "The password must contain at least 12 characters, one upper case, one lower case, one number and one special character.";
      } else {
        this.passwordError = "";
      }
    },
    // Méthode pour valider l'adresse e-mail
    validateEmail() {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(this.email)) {
        this.emailError = "Please enter a valid e-mail address.";
      } else {
        this.emailError = "";
      }
    },
  },
};
</script>
