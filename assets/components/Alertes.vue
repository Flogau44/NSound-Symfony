<template>
  <!-- Vérifie s'il y a des alertes récentes -->
  <div
    v-if="hasRecentAlertes"
    id="slider2"
    class="splide px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider2-list">
        <!-- Boucle sur les alertes récentes pour les afficher -->
        <li
          v-for="alert in recentAlertes"
          :key="alert.slug"
          class="splide__slide"
        >
          <!-- Lien vers le détail de l'article -->
          <router-link
            :to="{ name: 'ArticleDetail', params: { id: alert.slug } }"
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
            <!-- Affiche le contenu de l'alerte avec une limite de caractères -->
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
      alertes: [], // Liste des alertes
      recentAlertes: [], // Liste des alertes récentes
      hasRecentAlertes: false, // Indicateur de présence d'alertes récentes
    };
  },
  async mounted() {
    const alertsUrl = "/news";
    const typesUrl = "/news_categories";

    try {
      // Récupère les alertes et les catégories d'alertes
      const [alertsResponse, typesResponse] = await Promise.all([
        apiClient.get(alertsUrl),
        apiClient.get(typesUrl),
      ]);

      const types = typesResponse.data.member;

      // Associe chaque alerte à son type
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

      // Initialise le carrousel Splide si des alertes récentes sont présentes
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
    // Formate la date au format français
    formatDate(maDate) {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    },
    // Tronque le contenu de l'alerte si trop long
    truncateContent(content) {
      const maxLength = 255; // Limite de caractères à afficher
      if (content.length > maxLength) {
        return content.substring(0, maxLength) + "...";
      }
      return content;
    },
    // Vérifie si l'alerte est récente (moins de 3 jours)
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
