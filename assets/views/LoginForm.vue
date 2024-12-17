<template>
  <!-- Template principale -->
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-4 flex flex-row justify-center">
        <h1 class="uppercase">— Me connecter —</h1>
      </div>
      <div class="w-full md:w-[400px] mx-auto text-xl text-darkblue">
        <div class="p-6">
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
              <label for="email">E-mail<span class="text-red">*</span></label>
              <input
                type="email"
                list="email-list"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
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
              <label for="password"
                >Mot de passe<span class="text-red">*</span></label
              >
              <div class="relative">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  class="block w-full mt-1 px-2 pr-10 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
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
                class="h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700 cursor-pointer"
                :disabled="!isEmailValid"
              >
                Me connecter
              </button>
            </div>
          </form>
          <!-- Lien vers l'inscription -->
          <div class="flex flex-row gap-x-4">
            <div>Pas encore inscrit(e)?</div>
            <div>
              <router-link
                :to="{ name: 'RegisterForm' }"
                class="text-blue-900 border-blue-900 border-b-2 hover:text-darkblue hover:border-b-2 hover:border-darkblue"
                title="Vers la page d'inscription du site 'Nation Sound'"
                >M'inscrire</router-link
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
import apiClient from "../axios";

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
          localStorage.setItem("token", result.token);
          localStorage.setItem("refresh_token", result.refresh_token); // Stocke le refresh token
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
      let emails = JSON.parse(localStorage.getItem("emails")) || [];
      if (!emails.includes(email)) {
        emails.push(email);
        localStorage.setItem("emails", JSON.stringify(emails));
      }
    };

    // Remplir la liste des adresses e-mail
    const populateEmailList = () => {
      emailList.value = JSON.parse(localStorage.getItem("emails")) || [];
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
