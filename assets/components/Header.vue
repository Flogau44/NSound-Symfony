<template>
  <header
    class="ud-header bg-darkblue text-white top-0 left-0 z-50 w-full h-20 flex flex-row justify-center lg:justify-start lg:pl-12 lg:h-28"
  >
    <div class="flex flex-row items-center justify-around lg:justify-start">
      <!-- Menu Mobile -->
      <nav class="navbar-mobile lg:hidden">
        <!-- Hamburger -->
        <i
          id="hamburgerNonactive"
          class="fa-bars fas fa-2xl absolute left-3 z-999 text-white cursor-pointer w-7"
        ></i>
        <i
          id="hamburgerActive"
          class="fa-times fas fa-2xl absolute left-3 z-999 text-white cursor-pointer w-7"
        ></i>
        <div
          class="modal hidden absolute top-0 left-0 z-100 bg-darkblue h-screen w-full text-4xl font-semibold items-center animate-slideinleft"
        >
          <div
            class="navbar-mobile-list h-screen flex flex-col items-center justify-start pt-16 space-y-5"
          >
            <router-link
              :to="{ name: 'Home' }"
              class="uppercase transition duration-0 text-white hover:text-lightblue hover:duration-500"
              title="Vers la page d'accueil du site 'Nation Sound'"
              >Accueil</router-link
            >
            <router-link
              :to="{ name: 'Informations' }"
              class="uppercase transition duration-0 text-white hover:text-lightblue hover:duration-500"
              title="Vers la page d'informations du site 'Nation Sound'"
              >Informations</router-link
            >
            <router-link
              :to="{ name: 'Programmation' }"
              class="uppercase transition duration-0 text-white hover:text-lightblue hover:duration-500"
              title="Vers la page programmation du site 'Nation Sound'"
              >Programmation</router-link
            >
            <router-link
              :to="{ name: 'Billetterie' }"
              class="uppercase transition duration-0 text-white hover:text-lightblue hover:duration-500"
              title="Vers la page billetterie du site 'Nation Sound'"
              >Billetterie</router-link
            >
            <router-link
              :to="{ name: 'Infos_pratiques' }"
              class="uppercase transition duration-0 text-white hover:text-lightblue min-w-[170px] hover:duration-500"
              title="Vers la page d'infos pratiques du site 'Nation Sound'"
              >Infos pratiques</router-link
            >
            <router-link
              :to="{ name: 'Partenaires' }"
              class="uppercase transition duration-0 text-white hover:text-lightblue hover:duration-500"
              title="Vers la page des partenaires du site 'Nation Sound'"
              >Partenaires</router-link
            >
          </div>
        </div>
      </nav>
      <!-- Logo -->
      <div class="lg:pr-6 flex flex-col items-center">
        <router-link :to="{ name: 'Home' }" title="Page d'accueil">
          <img
            src="../images/logo.png"
            id="logo"
            class="w-20 md:w-28"
            alt="logo"
          />
        </router-link>
        <p class="hidden text-xl font-semibold lg:flex">
          <span class="text-lightblue font-bold">10.11.12</span
          ><span id="logoTitle">&nbsp;JUILLET</span>
        </p>
      </div>
      <!-- Menu desktop -->
      <nav
        class="navbar-desktop hidden lg:text-xl lg:font-semibold lg:flex lg:flex-row lg:space-x-5"
      >
        <router-link
          :to="{ name: 'Home' }"
          class="uppercase transition duration-0 hover:text-lightblue hover:duration-500"
          title="Vers la page d'accueil du site 'Nation Sound'"
          >Accueil</router-link
        >
        <router-link
          :to="{ name: 'Informations' }"
          class="uppercase transition duration-0 hover:text-lightblue hover:duration-500"
          title="Vers la page d'informations du site 'Nation Sound'"
          >Informations</router-link
        >
        <router-link
          :to="{ name: 'Programmation' }"
          class="uppercase transition duration-0 hover:text-lightblue hover:duration-500"
          title="Vers la page programmation du site 'Nation Sound'"
          >Programmation</router-link
        >
        <router-link
          :to="{ name: 'Billetterie' }"
          class="uppercase transition duration-0 hover:text-lightblue hover:duration-500"
          title="Vers la page billetterie du site 'Nation Sound'"
          >Billetterie</router-link
        >
        <router-link
          :to="{ name: 'Infos_pratiques' }"
          class="uppercase transition duration-0 hover:text-lightblue min-w-[170px] hover:duration-500"
          title="Vers la page d'infos pratiques du site 'Nation Sound'"
          >Infos pratiques</router-link
        >
        <router-link
          :to="{ name: 'Partenaires' }"
          class="uppercase transition duration-0 hover:text-lightblue hover:duration-500"
          title="Vers la page des partenaires du site 'Nation Sound'"
          >Partenaires</router-link
        >
      </nav>
    </div>
    <div class="absolute top-8 lg:top-10 right-5 z-50">
      <div>
        <router-link class="user" v-if="!auth" :to="{ name: 'LoginForm' }">
          <i
            v-if="!auth"
            class="fa-regular fa-user fa-xl transition duration-0 text-white"
          ></i>
        </router-link>
        <div class="user" v-if="auth">
          <div class="relative cursor-pointer" @click="toggleDropdown">
            <i class="fa-solid fa-circle fa-2xl text-white"></i>
            <div
              class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-darkblue font-bold text-2xl"
            >
              {{ firstLetter }}
            </div>
          </div>
          <div
            v-if="dropdownOpen"
            class="absolute top-7 right-0 py-1 z-50 w-52 flex flex-col bg-white rounded-md shadow-lg"
          >
            <div
              class="p-4 flex flex-row justify-start items-center space-x-2 border-b-2 border-blue-100"
            >
              <div class="relative">
                <i class="fa-solid fa-circle fa-2xl text-darkblue"></i>
                <div
                  class="absolute z-60 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white font-bold text-2xl"
                >
                  {{ firstLetter }}
                </div>
              </div>
              <div class="flex flex-col">
                <div class="text-blue text-base">Connecté en tant que</div>
                <div class="text-blue text-base">{{ email }}</div>
              </div>
            </div>
            <div
              @click="logout"
              class="cursor-pointer w-full p-4 flex flex-row justify-start items-center space-x-2"
            >
              <div>
                <i class="fa-solid fa-right-from-bracket text-darkblue"></i>
              </div>
              <div class="text-lg text-darkblue font-bold">Se déconnecter</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { ref, watch, onMounted, computed } from "vue";
import { useStore } from "vuex";
import apiClient from "../axios";

// Importer les chemins des images générées par Webpack avec hachage
const logoPath = require("../images/logo.png");
const logoScrolledPath = require("../images/logo_1.png");

export default {
  name: "Header",
  setup() {
    const store = useStore();
    const auth = ref(store.getters.isAuthenticated);
    const dropdownOpen = ref(false); // S'assurer que le dropdown est initialisé à false
    const userEmail = ref(""); // Stockage de l'email

    // Vérifie l'état d'authentification au montage du composant
    onMounted(() => {
      auth.value = store.getters.isAuthenticated;
      userEmail.value = store.getters.userEmail || ""; // Vérification sécurisée
    });

    // Surveille les changements de l'état d'authentification et de l'email
    watch(
      () => store.getters.userEmail,
      (newVal) => {
        userEmail.value = newVal || "";
      }
    );

    // Extraction de l'email
    const email = computed(() => {
      return userEmail.value;
    });

    // Extraction de la première lettre de l'email
    const firstLetter = computed(() => {
      return userEmail.value ? userEmail.value.charAt(0).toUpperCase() : "U";
    });

    const toggleDropdown = () => {
      dropdownOpen.value = !dropdownOpen.value;
    };

    const logout = async () => {
      try {
        await apiClient.post("/logout");
        store.dispatch("logout");
        auth.value = store.getters.isAuthenticated;
        dropdownOpen.value = false;

        // Redirection vers la page d'accueil après la déconnexion
        window.location.href = "/";
      } catch (error) {
        console.error("Erreur lors de la déconnexion :", error);
      }
    };

    return {
      auth,
      email,
      firstLetter,
      dropdownOpen,
      toggleDropdown,
      logout,
    };
  },

  mounted() {
    // Je sélectionne et je stocke les éléments du DOM
    const hamburgerNonactive = document.querySelector(
      ".navbar-mobile #hamburgerNonactive"
    );
    const hamburgerActive = document.querySelector(
      ".navbar-mobile #hamburgerActive"
    );
    const modal = document.querySelector(".modal");
    const modalLinks = document.querySelectorAll(".navbar-mobile-list a");
    const logoElement = document.getElementById("logo");
    const logoTitle = document.getElementById("logoTitle");
    const logoUser = document.querySelector(".user i");
    const userName = document.querySelector(".user .relative div");

    // Ouvrir le menu quand on clique sur l'hamburger non active (fa-bars)
    hamburgerNonactive.addEventListener("click", () => {
      modal.classList.remove("hidden");
      hamburgerNonactive.style.display = "none";
      hamburgerActive.style.display = "flex";
    });

    // Fermer le menu quand on clique sur l'hamburger active (fa-times)
    hamburgerActive.addEventListener("click", () => {
      modal.classList.add("hidden");
      hamburgerNonactive.style.display = "flex";
      hamburgerActive.style.display = "none";
    });

    // Fermer le menu quand on clique sur un lien du menu
    modalLinks.forEach((link) => {
      link.addEventListener("click", () => {
        modal.classList.add("hidden");
        hamburgerNonactive.style.display = "flex";
        hamburgerActive.style.display = "none";
      });
    });

    // Fonction pour changer la couleur au hover
    function handleHover() {
      if (logoUser) {
        logoUser.style.color = "#5FC2BA"; // Couleur de hover
      }
    }

    function handleHoverOut() {
      if (logoUser) {
        const ud_header = document.querySelector(".ud-header");
        logoUser.style.color =
          window.scrollY > ud_header.offsetTop ? "#0b162c" : "#ffffff"; // Couleur de base
      }
    }

    // Ajouter les événements de hover
    function addHoverEvent() {
      if (logoUser) {
        logoUser.addEventListener("mouseover", handleHover);
        logoUser.addEventListener("mouseout", handleHoverOut);
      }
    }

    // Retirer les événements de hover
    function removeHoverEvent() {
      if (logoUser) {
        logoUser.removeEventListener("mouseover", handleHover);
        logoUser.removeEventListener("mouseout", handleHoverOut);
      }
    }

    // Changer la couleur du menu au scroll
    window.onscroll = () => {
      const ud_header = document.querySelector(".ud-header");
      const fixed = ud_header.offsetTop;

      if (window.scrollY > fixed) {
        ud_header.classList.remove("bg-darkblue");
        ud_header.classList.add("sticky", "blueMenu");
        logoElement.src = logoScrolledPath;
        logoTitle.style.color = "#0b162c";
        hamburgerNonactive.style.color = "#0b162c";

        if (logoUser) logoUser.style.color = "#0b162c";
        if (userName) userName.style.color = "#ffffff";

        addHoverEvent();
      } else {
        ud_header.classList.add("bg-darkblue");
        ud_header.classList.remove("sticky", "blueMenu");
        logoElement.src = logoPath;
        logoTitle.style.color = "#ffffff";
        hamburgerNonactive.style.color = "#ffffff";

        if (logoUser) logoUser.style.color = "#ffffff";
        if (userName) userName.style.color = "#0b162c";

        removeHoverEvent();
      }
    };
  },
};
</script>
