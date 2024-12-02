<template>
  <div
    v-if="hasRecentAlertes"
    id="slider2"
    class="splide px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider2-list">
        <li
          v-for="alert in recentAlertes"
          :key="alert.id"
          class="splide__slide"
        >
          <router-link
            :to="{ name: 'ArticleDetail', params: { id: alert.id } }"
            class="alerteCarousel"
            :title="alert.title"
          >
            <div class="descriptionAlerteCarousel">
              <h2 class="titleAlertes">{{ alert.title }}</h2>
              <p class="dateAlertes">
                Info du
                {{ formatDate(alert.created_at) }}
              </p>
            </div>
            <div
              class="contentAlerte"
              v-html="truncateContent(alert.content)"
            ></div>
          </router-link>
        </li>
      </ul>
    </div>
    <div class="splide__pagination -bottom-7"></div>
  </div>
</template>

<script>
import apiClient from "../axios";

export default {
  name: "news",
  data() {
    return {
      alertes: [],
      recentAlertes: [],
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

      this.$nextTick(() => {
        if (this.hasRecentAlertes) {
          new Splide("#slider2", {
            direction: "ltr",
            arrows: false,
            perPage: 1,
          }).mount();
        }
      });
    } catch (error) {
      console.log("Erreur lors de la récupération des articles :", error);
    }
  },
  methods: {
    formatDate(maDate) {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    },
    truncateContent(content) {
      const maxLength = 255; // Limite de caractères à afficher
      if (content.length > maxLength) {
        return content.substring(0, maxLength) + "...";
      }
      return content;
    },
    isRecent(date) {
      const alertDate = new Date(date);
      const currentDate = new Date();
      const diffTime = Math.abs(currentDate - alertDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      return diffDays <= 3; // nombre de jour de visibilité de l'alerte
    },
  },
};
</script>
