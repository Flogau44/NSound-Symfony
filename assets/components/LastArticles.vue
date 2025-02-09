<template>
  <div
    id="slider4"
    class="splide py-4 px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider4-list">
        <!-- Boucle sur les articles pour les afficher -->
        <li
          v-for="article in articles"
          :key="article.slug"
          class="splide__slide"
        >
          <!-- Lien vers le détail de l'article -->
          <router-link
            :to="{ name: 'ArticleDetail', params: { id: article.slug } }"
            class="articleCarousel"
            :title="article.title"
          >
            <!-- Image de l'article -->
            <img
              :src="article.pictureUrl"
              class="imgArticlesCarousel"
              :alt="article.slug"
            />
            <div class="descriptionArticleCarousel">
              <h2 class="titleLastArticle">{{ article.title }}</h2>
              <p class="dateLastArticle">
                <!-- Formate la date de création de l'article -->
                {{ formatDate(article.created_at) }}
              </p>
            </div>
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
  name: "LastArticles",
  data() {
    return {
      articles: [], // Liste des articles
      token: null, // Stocker le token JWT
    };
  },
  async mounted() {
    // Récupérer le token JWT depuis le local storage
    this.token = localStorage.getItem("token");

    const newsUrl = "/news";
    const typesUrl = "/news_categories";

    try {
      // Récupère les articles et les catégories d'articles
      const [newsResponse, typesResponse] = await Promise.all([
        apiClient.get(newsUrl),
        apiClient.get(typesUrl),
      ]);

      const types = typesResponse.data.member;

      this.articles = newsResponse.data.member
        .filter((article) => article.publish) // Filtrer les articles publiés
        .map((article) => {
          const type = types.find((t) => t.news.includes(article["@id"]));
          return {
            ...article,
            type: type.type,
            pictureUrl: `/build/images/${article.picture}`,
          };
        });

      // Filtrer les articles par catégorie "Générale" et "Actualité" si authentifié
      this.articles = this.articles.filter((article) => {
        if (article.type === "Générale") {
          return true;
        }
        if (article.type === "Actualité") {
          return this.token;
        }
        return false;
      });

      // Trier les articles par date de création (du plus récent au plus ancien)
      this.articles.sort(
        (a, b) => new Date(b.created_at) - new Date(a.created_at)
      );

      // Sélectionner les 3 derniers articles
      this.articles = this.articles.slice(0, 9);

      // Initialiser le carrousel Splide
      this.$nextTick(() => {
        new Splide("#slider4", {
          direction: "ltr",
          arrows: false,
          perPage: 4,
          gap: "20px",
          breakpoints: {
            1280: { perPage: 3, gap: "10px" },
            1024: { perPage: 2 },
            640: { perPage: 1 },
          },
        }).mount();
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
  },
};
</script>
