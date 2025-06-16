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
        <!-- Titre de la page d'inscription -->
        <div class="mb-4 flex flex-row justify-center">
          <h1>S'inscrire</h1>
        </div>
      </div>

      <div class="w-full md:w-[600px] mx-auto text-xl text-darkblue">
        <div class="border rounded m-6 p-6 shadow-md">
          <p class="text-blue pb-4">
            Saisissez vos informations pour créer un compte.
          </p>

          <!-- Formulaire d'inscription -->
          <form @submit.prevent="register" class="flex flex-col gap-y-6">
            <!-- Champ pour le prénom -->
            <div>
              <label for="firstname" class="block font-medium text-blue"
                >Prénom *</label
              >
              <input
                type="text"
                class="block border p-2 w-full rounded"
                :class="firstname ? 'bg-blue-100' : 'bg-white'"
                placeholder="Jean"
                required
                name="firstname"
                v-model="firstname"
              />
            </div>

            <!-- Champ pour le nom -->
            <div>
              <label for="lastname" class="block font-medium text-blue"
                >Nom *</label
              >
              <input
                type="text"
                class="block border p-2 w-full rounded"
                :class="lastname ? 'bg-blue-100' : 'bg-white'"
                placeholder="Dupont"
                required
                name="lastname"
                v-model="lastname"
              />
            </div>

            <!-- Champ pour l'email -->
            <div>
              <label for="email" class="block font-medium text-blue"
                >Email *</label
              >
              <input
                type="email"
                class="block border p-2 w-full rounded"
                :class="email ? 'bg-blue-100' : 'bg-white'"
                placeholder="votre@email.com"
                v-model="email"
                required
                @input="validateEmail"
              />
            </div>

            <!-- Champ pour le mot de passe -->
            <div>
              <label for="password" class="block font-medium text-blue"
                >Password</label
              >
              <div class="relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  class="block border p-2 w-full rounded"
                  :class="password ? 'bg-blue-100' : 'bg-white'"
                  placeholder="Votre mot de passe"
                  v-model="password"
                  required
                  @input="validatePassword"
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
                S'inscrire
              </button>
            </div>
          </form>

          <!-- Lien vers la page de connexion -->
          <div class="flex flex-row justify-center gap-x-4">
            <div class="text-blue">Vous avez déjà un compte ?</div>
            <div>
              <router-link
                :to="{ name: 'LoginForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
              >
                Se connecter
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import apiClient from "../../axios";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";

export default {
  name: "RegisterForm",
  setup() {
    const router = useRouter(); // Permet la navigation entre les pages
    const toast = useToast(); // Initialisation des notifications toast

    return { router, toast };
  },
  data() {
    return {
      firstname: "", // Stocke le prénom de l'utilisateur
      lastname: "", // Stocke le nom de l'utilisateur
      email: "", // Stocke l'email de l'utilisateur
      password: "", // Stocke le mot de passe de l'utilisateur
      showPassword: false, // Gère la visibilité du mot de passe
    };
  },
  methods: {
    // Fonction pour enregistrer un utilisateur
    async register() {
      const toast = useToast(); // Définition correcte de `toast`

      if (!this.validatePassword()) {
        toast.error(
          "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.",
          { timeout: 5000 }
        );
        return;
      }
      try {
        const response = await apiClient.post("/register", {
          name: `${this.firstname} ${this.lastname}`,
          email: this.email,
          password: this.password,
        });

        toast.success(
          "Inscription réussie ! Utilisez vos identifiants pour vous connecter.",
          { timeout: 3000 }
        );

        // Ajout d'un délai avant la redirection
        setTimeout(() => {
          this.router.push("/login");
        }, 3500);
      } catch (error) {
        toast.error("Une erreur est survenue lors de l'inscription.", {
          timeout: 5000,
        });
      }
    },

    // Fonction pour afficher/cacher le mot de passe
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },

    // Vérification de la complexité du mot de passe
    validatePassword() {
      const strongPasswordPattern =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
      return strongPasswordPattern.test(this.password);
    },
  },
};
</script>
