<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-4 flex flex-row justify-center">
        <h1 class="uppercase">— Me connecter —</h1>
      </div>
      <div class="w-full md:w-[400px] mx-auto text-xl text-darkblue">
        <div class="p-6">
          <form @submit.prevent="login" class="flex flex-col gap-y-6">
            <div>
              <label for="email">E-mail<span class="text-red">*</span></label>
              <input
                type="email"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                v-model="email"
                required
              />
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
            </div>
            <div class="my-6">
              <button
                type="submit"
                class="h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700"
              >
                Me connecter
              </button>
            </div>
          </form>
          <div class="flex flex-col gap-y-10">
            <div>
              <a
                href="#"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page mot de passe oublié du site 'Nation Sound'"
              >
                Mot de passe oublié
              </a>
            </div>
            <div class="flex flex-row gap-x-4">
              <div>Pas encore inscrit(e)?</div>
              <div>
                <router-link
                  :to="{ name: 'RegisterForm' }"
                  class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                  title="Vers la page d'inscription du site 'Nation Sound'"
                >
                  M'inscrire
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginForm",
  data() {
    return {
      email: "",
      password: "",
      showPassword: false,
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("/api/login", {
          email: this.email,
          password: this.password,
        });
        console.log("Connexion réussie", response.data);
        localStorage.setItem("token", response.data.token);
        // Rediriger l'utilisateur ou mettre à jour l'état de l'application
      } catch (error) {
        console.error("Erreur lors de la connexion", error);
      }
    },
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
  },
};
</script>
