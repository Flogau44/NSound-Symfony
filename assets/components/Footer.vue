<script>
export default {
  name: "Footer",
};
</script>
<template>
  <footer class="px-2 pt-2 bg-darkblue text-white w-full max-h-full">
    <div
      class="flex flex-col items-center space-y-4 md:grid md:grid-cols-3 md:gap-x-6 md:justify-items-center"
    >
      <!-- Logo Nation Sound -->
      <div class="flex flex-col">
        <img src="../images/logo.png" class="w-64" />
      </div>
      <!-- Réseaux sociaux -->
      <div class="flex flex-col space-y-6 items-center">
        <div class="flex flex-col items-center space-y-2">
          <div>
            <h1 class="text-white">Restons connectés</h1>
          </div>
          <div>
            <p class="text-xl">Suivez-nous sur nos réseaux sociaux !</p>
          </div>
        </div>
        <div class="flex flex-row space-x-3">
          <a href="#" title="Vers la page facebook">
            <i
              class="fab fa-facebook text-white fa-2xl transition duration-0 hover:duration-1000 hover:text-lightblue"
            ></i>
          </a>
          <a href="#" title="Vers la page instagramm">
            <i
              class="fab fa-instagramm text-white fa-2xl transition duration-0 hover:duration-1000 hover:text-lightblue"
            ></i>
          </a>
          <a href="#" title="Vers la page twitter">
            <i
              class="fab fa-twitter text-white fa-2xl transition duration-0 hover:duration-1000 hover:text-lightblue"
            ></i>
          </a>
          <a href="#" title="Vers la page youtube">
            <i
              class="fab fa-youtube text-white fa-2xl transition duration-0 hover:duration-1000 hover:text-lightblue"
            ></i>
          </a>
          <a href="#" title="Vers la page snapchat">
            <i
              class="fab fa-snapchat text-white fa-2xl transition duration-0 hover:duration-1000 hover:text-lightblue"
            ></i>
          </a>
          <a href="#" title="Vers la page linkedin">
            <i
              class="fab fa-linkedin text-white transition duration-0 hover:duration-1000 fa-2xl hover:text-lightblue"
            ></i>
          </a>
        </div>
      </div>
      <!-- Contact et infos -->
      <div>
        <ul
          class="text-2xl font-semibold flex flex-col items-center space-y-2 md:items-start"
        >
          <li>
            <router-link
              :to="{ name: 'Contact' }"
              class="transition duration-0 hover:text-lightblue hover:duration-1000"
              title="Vers la page contact du site 'Nation Sound'"
              >Contact</router-link
            >
          </li>
          <li>
            <router-link
              :to="{ name: 'Mentions_legales' }"
              class="transition duration-0 hover:text-lightblue hover:duration-1000"
              title="Vers la page des mentions légales du site 'Nation Sound'"
              >Mentions légales</router-link
            >
          </li>
          <li>
            <router-link
              :to="{ name: 'Faq' }"
              class="transition duration-0 hover:text-lightblue hover:duration-1000"
              title="Vers la page F.A.Q. du site 'Nation Sound'"
              >F.A.Q.</router-link
            >
          </li>
          <li>
            <router-link
              :to="{ name: 'Partenaires' }"
              class="transition duration-0 hover:text-lightblue hover:duration-1000"
              title="Vers la page des partenaires du site 'Nation Sound'"
              >Partenaires</router-link
            >
          </li>
        </ul>
      </div>
    </div>
    <div class="py-2 flex flex-col justify-center items-center md:flex-row">
      <div>
        Copyright &copy; 2024 Live Envents -

        <span class="text-lightblue font-semibold">N</span>ation
        <span class="text-lightblue font-semibold">S</span>ound -
      </div>
      <div>Tous droits réservés</div>
    </div>
  </footer>
</template>
