<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6 flex flex-col justify-center items-center">
      <div class="mb-6">
        <h1 class="uppercase">— Actualités —</h1>
      </div>
      <!-- Afficher tous les articles -->
      <section id="articles">
        <ArticleItem
          v-for="item in filteredArticles"
          :key="item.slug"
          :item="item"
        />
      </section>
    </section>
  </main>
</template>

<script>
import ArticleItem from "../../components/ArticleItem.vue";
import apiClient from "../../axios";
import Cookies from "js-cookie";

export default {
  name: "informations",
  components: {
    ArticleItem,
  },
  data() {
    return {
      articles: [], // Liste des articles
      token: null, // Stocker le token JWT
    };
  },
  async mounted() {
    // Récupérer le token JWT depuis le local storage
    this.token = Cookies.get("token");

    const newsUrl = "/news";
    const typesUrl = "/news_categories";

    try {
      // Récupérer les articles et les catégories d'articles
      const [newsResponse, typesResponse] = await Promise.all([
        apiClient.get(newsUrl),
        apiClient.get(typesUrl),
      ]);

      const types = typesResponse.data.member;

      // Créez un objet pour mapper les catégories par leur ID
      const categoriesMap = types.reduce((acc, category) => {
        acc[category["@id"]] = category;
        return acc;
      }, {});

      // Ajoutez la gravité et filtrez les articles récents
      this.articles = newsResponse.data.member
        .map((item) => {
          const category = categoriesMap[item.type];
          return {
            ...item,
            pictureUrl: `/build/images/${item.picture}`,
            gravity: category ? parseInt(category.gravity, 10) : null,
            type: category ? category.type : null,
          };
        })
        .filter((item) => {
          // Filtrer les articles récents pour les catégories "Urgente" et "Sécurité"
          if (item.type === "Urgente" || item.type === "Sécurité") {
            return this.isRecent(item.created_at);
          }
          // Toujours afficher les articles des catégories "Générale" et "Actualité" si authentifié
          if (item.type === "Générale" || item.type === "Actualité") {
            return this.token || item.type === "Générale";
          }
          return false;
        })
        .filter((item) => item.publish); // Filtrer les articles publiés

      // Triez les articles par gravité du plus grand au plus petit
      this.articles.sort((a, b) => b.gravity - a.gravity);
    } catch (error) {
      console.log("Erreur lors de la récupération des articles :", error);
    }
  },
  computed: {
    filteredArticles() {
      return this.articles;
    },
  },
  methods: {
    // Vérifie si l'article est récent (moins de 3 jours)
    isRecent(date) {
      const articleDate = new Date(date);
      const currentDate = new Date();
      const diffTime = Math.abs(currentDate - articleDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      return diffDays <= 3;
    },
  },
};
</script>
