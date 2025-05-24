<template>
  <!-- Template principale -->
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
          <h1>Sign In</h1>
        </div>
      </div>
      <div class="w-full md:w-[600px] mx-auto text-xl text-darkblue">
        <div class="border rounded m-6 p-6 shadow-md">
          <p class="text-blue pb-4">
            Enter your email below to login to your account.
          </p>
          <!-- Formulaire de connexion -->
          <form
            @submit.prevent="login"
            class="flex flex-col gap-y-6"
            novalidate
          >
            <!-- Message d'erreur -->
            <div
              v-if="errorMessage"
              class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
              role="alert"
            >
              <strong class="font-bold"
                ><i class="fa-solid fa-circle-xmark"></i>
                {{ errorMessage }}</strong
              >
            </div>
            <!-- Champ pour l'adresse e-mail -->
            <div>
              <label for="email" class="block font-medium text-blue"
                >Email<span class="text-red">*</span></label
              >
              <input
                type="email"
                list="email-list"
                class="block border p-2 w-full rounded"
                :class="data.email ? 'bg-blue-100' : 'bg-white'"
                placeholder="your@email.com"
                v-model="data.email"
                required
                @focus="populateEmailList"
                @input="validateEmail"
                autocomplete="off"
                ref="emailInput"
              />
              <datalist id="email-list">
                <option
                  v-for="email in emailList"
                  :key="email"
                  :value="email"
                ></option>
              </datalist>
              <div v-if="emailError" class="text-red mt-1">
                {{ emailError }}
              </div>
            </div>
            <!-- Champ pour le mot de passe -->
            <div>
              <label for="password" class="block font-medium text-blue"
                >Password<span class="text-red">*</span></label
              >
              <div class="relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  class="block border p-2 w-full rounded"
                  :class="data.password ? 'bg-blue-100' : 'bg-white'"
                  placeholder="Enter your password"
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
                :disabled="!isEmailValid"
              >
                Sign In
              </button>
            </div>
          </form>
          <!-- Lien vers l'inscription -->
          <div class="flex flex-row justify-center gap-x-4">
            <div class="text-blue">Don't have an account ?</div>
            <div>
              <router-link
                :to="{ name: 'RegisterForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page d'inscription du site 'Nation Sound'"
                >Sign Up</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import { reactive, ref, computed } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import apiClient from "../../axios";
import Cookies from "js-cookie"; // Importation de js-cookie

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
    const errorMessage = ref("");
    const emailError = ref("");
    const emailList = ref([]);

    // Fonction de connexion
    const login = async () => {
      const restUrl = "/login";
      try {
        const response = await apiClient.post(restUrl, {
          email: data.email,
          password: data.password,
        });
        const result = await response.data;
        if (response.status === 200) {
          console.log("Connexion réussie", result);
          Cookies.set("token", result.token); // Stocke le token dans les cookies
          Cookies.set("refresh_token", result.refresh_token); // Stocke le refresh token dans les cookies
          store.dispatch("login", true);
          storeEmail(data.email);
          router.push("/");
        } else {
          setErrorMessage("Votre e-mail ou votre mot de passe est invalide.");
          console.error("Erreur lors de la connexion", result);
        }
      } catch (error) {
        setErrorMessage("Votre e-mail ou votre mot de passe est invalide.");
        console.error("Erreur lors de la connexion", error);
      }
    };

    // Fonction pour basculer la visibilité du mot de passe
    const togglePasswordVisibility = () => {
      showPassword.value = !showPassword.value;
    };

    // Définir le message d'erreur
    const setErrorMessage = (message) => {
      errorMessage.value = message;
    };

    // Effacer le message d'erreur
    const clearErrorMessage = () => {
      errorMessage.value = "";
      emailError.value = "";
    };

    // Valider l'adresse e-mail
    const validateEmail = () => {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(data.email)) {
        emailError.value = "Veuillez entrer une adresse e-mail valide.";
      } else {
        emailError.value = "";
      }
    };

    // Stocker l'adresse e-mail
    const storeEmail = (email) => {
      let emails = JSON.parse(Cookies.get("emails") || "[]");
      if (!emails.includes(email)) {
        emails.push(email);
        Cookies.set("emails", JSON.stringify(emails));
      }
    };

    // Remplir la liste des adresses e-mail
    const populateEmailList = () => {
      emailList.value = JSON.parse(Cookies.get("emails") || "[]");
    };

    return {
      data,
      showPassword,
      errorMessage,
      emailError,
      emailList,
      login,
      togglePasswordVisibility,
      clearErrorMessage,
      validateEmail,
      storeEmail,
      populateEmailList,
      isEmailValid: computed(() => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(data.email);
      }),
    };
  },
};
</script>
