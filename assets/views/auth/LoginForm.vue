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
          <!-- Lien vers l'inscription -->
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
import { useToast } from "vue-toastification"; // Import des toasts

export default {
  name: "LoginForm",
  setup() {
    const data = reactive({
      email: "",
      password: "",
    });
    const router = useRouter();
    const store = useStore();
    const showPassword = ref(false);
    const toast = useToast(); // Initialisation des toasts

    // Fonction de connexion avec gestion des notifications
    const login = async () => {
      const restUrl = "/login";
      try {
        const response = await apiClient.post(restUrl, {
          email: data.email,
          password: data.password,
        });
        const result = response.data;

        if (response.status === 200) {
          Cookies.set("token", result.token);
          Cookies.set("refresh_token", result.refresh_token);
          store.dispatch("login", { email: data.email });

          toast.success("Connexion réussie !", { timeout: 3000 }); // Toast de succès
          router.push("/");
        }
      } catch (error) {
        toast.error(
          "Erreur de connexion. Vérifiez votre email et mot de passe.",
          { timeout: 5000 }
        ); // Toast d'erreur
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
