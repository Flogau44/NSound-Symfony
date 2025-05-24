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
            class="fa-regular fa-user fa-xl transition duration-0 text-white hover:text-lightblue hover:duration-500"
          ></i>
        </router-link>
        <div class="user" v-if="auth">
          <i
            class="fa-regular fa-user fa-xl transition duration-0 text-white hover:text-lightblue hover:duration-500 cursor-pointer"
            @click="toggleDropdown"
          ></i>
          <div
            v-if="dropdownOpen"
            class="absolute top-8 right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
          >
            <div
              @click="logout"
              class="cursor-pointer w-full flex flex-row justify-start items-center space-x-2 px-4 py-2"
            >
              <div>
                <i class="fa-solid fa-right-from-bracket text-darkblue"></i>
              </div>
              <div
                class="uppercase text-lg text-darkblue font-bold hover:text-lightblue"
              >
                Logout
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { ref, watch, onMounted } from "vue";
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

    // Vérifie l'état d'authentification au montage du composant
    onMounted(() => {
      auth.value = store.getters.isAuthenticated;
    });

    // Utilise watch pour surveiller les changements d'état
    watch(
      () => store.getters.isAuthenticated,
      (newVal) => {
        auth.value = newVal;
      }
    );

    const toggleDropdown = () => {
      dropdownOpen.value = !dropdownOpen.value;
    };

    const logout = async () => {
      try {
        await apiClient.post("/logout");
        store.dispatch("logout");
        auth.value = store.getters.isAuthenticated;
        dropdownOpen.value = false; // S'assurer que le dropdown est fermé après la déconnexion
        console.log("Déconnexion réussie");
      } catch (error) {
        console.error("Erreur lors de la déconnexion :", error);
      }
    };

    return {
      auth,
      dropdownOpen,
      toggleDropdown,
      logout,
    };
  },
  mounted() {
    // Menu Mobile

    // Je sélectionne et je stocke l'icône hamburger non active (fa-bars)
    const hamburgerNonactive = document.querySelector(
      ".navbar-mobile #hamburgerNonactive"
    );
    // Je sélectionne et je stocke l'icône hamburger active (fa-times)
    const hamburgerActive = document.querySelector(
      ".navbar-mobile #hamburgerActive"
    );
    // Je sélectionne et je stocke l'élément DIV menu global
    const modal = document.querySelector(".modal");
    // Je sélectionne et je stocke les liens du menu
    const modalLinks = document.querySelectorAll(".navbar-mobile-list a");
    // Je sélectionne et je stocke le logo
    const logoElement = document.getElementById("logo");
    // Je sélectionne et je stocke le titre du logo
    const logoTitle = document.getElementById("logoTitle");
    // Je sélectionne et je stocke l'icône User
    const logoUser = document.querySelector(".user i");

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

    // Changer la couleur du menu au scroll
    window.onscroll = () => {
      // Je sélectionne et je stocke la barre du menu
      const ud_header = document.querySelector(".ud-header");
      // Je stocke le menu en fixed
      const fixed = ud_header.offsetTop;

      // Fonction pour ajouter et retirer les événements de hover
      function addHoverEvent() {
        logoUser.addEventListener("mouseover", handleHover);
        logoUser.addEventListener("mouseout", handleHoverOut);
      }

      function removeHoverEvent() {
        logoUser.removeEventListener("mouseover", handleHover);
        logoUser.removeEventListener("mouseout", handleHoverOut);
      }

      if (window.scrollY > fixed) {
        ud_header.classList.remove("bg-darkblue");
        ud_header.classList.add("sticky");
        ud_header.classList.add("blueMenu");
        logoElement.src = logoScrolledPath;
        logoTitle.style.color = "#0b162c";
        hamburgerNonactive.style.color = "#0b162c";
        logoUser.style.color = "#0b162c";
        addHoverEvent();
      } else {
        ud_header.classList.add("bg-darkblue");
        ud_header.classList.remove("sticky");
        ud_header.classList.remove("blueMenu");
        logoElement.src = logoPath;
        logoTitle.style.color = "#ffffff";
        hamburgerNonactive.style.color = "#ffffff";
        logoUser.style.color = "#ffffff";
        removeHoverEvent();
      }

      function handleHover() {
        logoUser.style.color = "#5FC2BA"; // Couleur de hover
      }

      function handleHoverOut() {
        logoUser.style.color = window.scrollY > fixed ? "#0b162c" : "#ffffff"; // Couleur de base en fonction de l'état du menu
      }
    };
  },
};
</script>
