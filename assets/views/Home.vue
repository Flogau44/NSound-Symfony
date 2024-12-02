<template>
  <main class="max-h-full mt-0 pt-0">
    <!--Section Caroussel-->
    <Carousel />
    <!--Section Liste des alertes-->
    <section
      v-if="hasRecentAlertes"
      class="py-10 px-4 flex flex-col justify-center items-center text-base bg-red md:px-16 md:text-xl"
    >
      <div class="py-4 w-full flex flex-row justify-center">
        <h2 class="uppercase text-white">— informations importantes —</h2>
      </div>
      <Alertes />
    </section>
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
        class="intersect:animate-fade intersect:animate-duration-1000 intersect:animate-delay-500 h-10 px-5 text-darkblue text-xl font-bold bg-lightblue-900 ring-darkblue rounded-md hover:text-white hover:bg-blue-900 outline-none hover:ring hover:ring-darkblue transition-colors durée-700 animate-fadeinup js-show-on-scroll3"
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
        class="intersect:animate-fade intersect:animate-duration-1000 intersect:animate-delay-500 h-10 px-5 text-darkblue text-xl font-bold bg-lightblue-900 ring-darkblue rounded-md hover:text-white hover:bg-blue-900 outline-none hover:ring hover:ring-darkblue transition-colors durée-700 animate-fadeinup js-show-on-scroll3"
      >
        <router-link :to="{ name: 'Billetterie' }"
          >Voir la billetterie</router-link
        >
      </button>
    </section>
    <!--Section Actualités-->
    <section
      class="py-10 px-4 md:px-16 flex flex-col justify-center items-center text-base bg-darkblue md:text-xl"
    >
      <div class="py-4 w-full flex flex-row justify-center">
        <h2 class="uppercase text-lightblue">— Dernières Actualités —</h2>
      </div>
      <LastArticles />
    </section>
    <!--Section plan du festival-->
    <section class="py-10 px-4 flex flex-col text-base md:px-16 md:text-xl">
      <h2 class="uppercase flex justify-center">— Plan du festival —</h2>
      <Map />
    </section>
  </main>
</template>

<script>
import Carousel from "../components/Carousel.vue";
import Alertes from "../components/Alertes.vue";
import ProgrammationArtist from "../components/ProgrammationArtist.vue";
import Map from "../components/Map.vue";
import LastArticles from "../components/LastArticles.vue";
import apiClient from "../axios";

export default {
  name: "Home",
  components: {
    Carousel,
    Alertes,
    ProgrammationArtist,
    LastArticles,
    Map,
  },
  data() {
    return {
      hasRecentAlertes: false,
    };
  },
  async mounted() {
    const alertsUrl = "/news";
    const typesUrl = "/news_categories";

    try {
      const [alertsResponse, typesResponse] = await Promise.all([
        apiClient.get(alertsUrl),
        apiClient.get(typesUrl),
      ]);

      const types = typesResponse.data.member;

      this.alertes = alertsResponse.data.member.map((alert) => {
        const type = types.find((t) => t.news.includes(alert["@id"]));
        return {
          ...alert,
          type: type.type,
        };
      });

      // Filtrer les alertes par catégorie "Urgente" et "Sécurité"
      this.alertes = this.alertes.filter(
        (alert) => alert.type === "Urgente" || alert.type === "Sécurité"
      );

      // Filtrer les alertes récentes
      this.recentAlertes = this.alertes.filter((alert) =>
        this.isRecent(alert.created_at)
      );

      // Vérifier s'il y a des alertes récentes
      this.hasRecentAlertes = this.recentAlertes.length > 0;
    } catch (error) {
      console.log("Erreur lors de la récupération des alertes :", error);
    }
  },
  methods: {
    isRecent(date) {
      const alertDate = new Date(date);
      const currentDate = new Date();
      const diffTime = Math.abs(currentDate - alertDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      return diffDays <= 3;
    },
  },
};
</script>
