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
            <div>
              <label for="password" class="block font-medium text-blue"
                >Password *</label
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
                class="w-full h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700"
              >
                S'inscrire
              </button>
            </div>
          </form>
          <!-- Liens supplémentaires pour se connecter -->
          <div class="flex flex-row justify-center gap-x-4">
            <div class="text-blue">Vous avez déjà un compte ?</div>
            <div>
              <router-link
                :to="{ name: 'LoginForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page de connexion du site 'Nation Sound'"
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
import { useToast } from "vue-toastification"; // 🔥 Import des toasts

export default {
  name: "RegisterForm",
  setup() {
    const router = useRouter();
    const toast = useToast(); // 🔥 Initialisation des toasts

    return { router, toast };
  },
  data() {
    return {
      firstname: "",
      lastname: "",
      email: "",
      password: "",
      showPassword: false,
    };
  },
  methods: {
    async register() {
      const toast = useToast(); // Définition correcte de `toast`

      if (!this.validatePassword()) {
        toast.error(
          "The password must contain at least 12 characters, one uppercase letter, one lowercase letter, one number, and one special character.",
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

        toast.success("Registration successful!", { timeout: 3000 });

        // Ajout d'un délai avant la redirection
        setTimeout(() => {
          this.router.push("/login");
        }, 3500);
      } catch (error) {
        toast.error("An error occurred during registration.", {
          timeout: 5000,
        });
      }
    },
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    validatePassword() {
      const strongPasswordPattern =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
      return strongPasswordPattern.test(this.password);
    },
  },
};
</script>
