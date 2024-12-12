<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-4 flex flex-row justify-center">
        <h1 class="uppercase">— M'inscrire —</h1>
      </div>
      <div class="w-full md:w-[400px] mx-auto text-xl text-darkblue">
        <div class="p-6">
          <form @submit.prevent="register" class="flex flex-col gap-y-6">
            <div>
              <label for="email">E-mail<span class="text-red">*</span></label>
              <input
                type="email"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                v-model="email"
                required
                @input="validateEmail"
              />
              <p v-if="emailError" class="text-red-500">{{ emailError }}</p>
            </div>
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
              <p v-if="passwordError" class="text-red-500">
                {{ passwordError }}
              </p>
            </div>
            <div class="my-6">
              <button
                type="submit"
                class="h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700"
              >
                M'inscrire
              </button>
            </div>
          </form>
          <div class="flex flex-row gap-x-4">
            <div>Déjà inscrit(e)?</div>
            <div>
              <router-link
                :to="{ name: 'LoginForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page d'inscription du site 'Nation Sound'"
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
import apiClient from "../axios";

export default {
  name: "RegisterForm",
  data() {
    return {
      email: "",
      password: "",
      showPassword: false,
      emailError: "",
      passwordError: "",
    };
  },
  methods: {
    async register() {
      if (this.password.length < 12) {
        this.passwordError =
          "Le mot de passe doit contenir au moins 12 caractères.";
        return;
      }
      try {
        const response = await apiClient.post("/register", {
          email: this.email,
          password: this.password,
        });
        console.log("Inscription réussie", response.data);
      } catch (error) {
        console.error("Erreur lors de l'inscription", error);
      }
    },
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
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
