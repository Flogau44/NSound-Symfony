<template>
  <div
    id="slider4"
    class="splide py-4 px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider4-list">
        <li v-for="article in articles" :key="article.id" class="splide__slide">
          <router-link
            :to="{ name: 'ArticleDetail', params: { id: article.id } }"
            class="articleCarousel"
            :title="article.title"
          >
            <img
              :src="article.pictureUrl"
              class="imgArticlesCarousel"
              :alt="article.slug"
            />
            <div class="descriptionArticleCarousel">
              <h2 class="titleLastArticle">{{ article.title }}</h2>
              <p class="dateLastArticle">
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
      articles: [],
    };
  },
  async mounted() {
    const newsUrl = "/news";
    const typesUrl = "/news_categories";

    try {
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
            pictureUrl: `http://127.0.0.1:8000/build/images/${article.picture}`,
          };
        });

      // Filtrer les articles par catégorie "Générale" et "Actualité"
      this.articles = this.articles.filter(
        (article) => article.type === "Générale" || article.type === "Actualité"
      );

      // Trier les articles par date de création (du plus récent au plus ancien)
      this.articles.sort(
        (a, b) => new Date(b.created_at) - new Date(a.created_at)
      );

      // Sélectionner les 3 derniers articles
      this.articles = this.articles.slice(0, 9);

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
    formatDate(maDate) {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    },
  },
};
</script>
