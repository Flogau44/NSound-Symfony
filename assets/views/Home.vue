<template>
  <main class="max-h-full mt-0 pt-0">
    <!--Section Caroussel-->
    <Carousel />
    <!--Section liste des concerts-->
    <section
      class="w-full py-10 flex flex-col items-center gap-y-4 bg-darkblue"
    >
      <div class="py-4 w-full flex flex-row justify-center">
        <h2 class="uppercase text-lightblue">— Programmation —</h2>
      </div>
      <ProgrammationArtist />
      <button
        type="button"
        class="intersect:animate-fade intersect:animate-duration-1000 intersect:animate-delay-500 h-10 px-5 text-darkblue text-xl font-bold bg-lightblue-900 ring-darkblue rounded-md hover:text-white hover:bg-blue-900 outline-none hover:ring hover:ring-darkblue transition-colors duration-700 animate-fadeinup js-show-on-scroll3"
      >
        <router-link :to="{ name: 'Programmation' }"
          >Découvrez la programmation</router-link
        >
      </button>
    </section>
    <!--Section billetterie-->
    <section class="py-8 flex flex-col items-center space-y-4">
      <h2 class="uppercase js-show-on-scroll-2">— Billetterie —</h2>
      <p class="uppercase text-base font-medium md:text-xl">
        Billet 1 jour · Forfait 3 Jours
      </p>
      <img src="../images/ticket.png" alt="ticket" />
      <button
        type="button"
        class="intersect:animate-fade intersect:animate-duration-1000 intersect:animate-delay-500 h-10 px-5 text-darkblue text-xl font-bold bg-lightblue-900 ring-darkblue rounded-md hover:text-white hover:bg-blue-900 outline-none hover:ring hover:ring-darkblue transition-colors duration-700 animate-fadeinup js-show-on-scroll3"
      >
        <router-link :to="{ name: 'Billetterie' }"
          >Voir la billetterie</router-link
        >
      </button>
    </section>
    <!--Section plan du festival-->
    <section
      class="py-10 px-4 md:px-16 flex flex-col justify-center items-center text-base bg-darkblue md:text-xl"
    >
      <div class="py-4 w-full flex flex-row justify-center">
        <h2 class="uppercase text-lightblue">— Dernières Actualités —</h2>
      </div>
      <LastArticles />
    </section>
    <section class="py-10 px-4 flex flex-col text-base md:px-16 md:text-xl">
      <h2 class="uppercase flex justify-center">— Plan du festival —</h2>
      <Map />
    </section>
  </main>
</template>

<script>
import Carousel from "../components/Carousel.vue";
import ProgrammationArtist from "../components/ProgrammationArtist.vue";
import Map from "../components/Map.vue";
import LastArticles from "../components/LastArticles.vue";

export default {
  name: "Home",
  components: {
    Carousel,
    ProgrammationArtist,
    LastArticles,
    Map,
  },
  mounted() {},
};
</script>
